<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/* Note: this originally came from PEAR's Mail_Mbox class */

class MailingList extends Model
{
    private $filename = null;
    private $resource = null;
    private $index = null;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function open()
    {
        // check if file exists else return pear error
        if (!is_file($this->filename)) {
            dd('Not a file, cannot open: '. $this->filename);
        }

        // opening the file
        $this->resource = fopen($this->filename, 'r');
        if (!is_resource($this->resource)) {
            dd('Cannot open the mbox file: maybe without permission.');
        }

        // process the file and get the messages bytes offsets
        $this->_process();

        return true;
    }

    public function close()
    {
        if (! is_resource($this->resource)) {
            return true;
        }

        if (!fclose($this->resource)) {
            dd('Cannot close the mbox, maybe file is being used (?)');
        }

        return true;
    }

    public function size()
    {
        if ($this->index !== null) {
            return sizeof($this->index);
        } else {
            return 0;
        }
    }

    public function get($message)
    {
        // checking if we have bytes locations for this message
        if (!is_array($this->index[$message])) {
            dd('Message size does not exist');
        }

        // getting bytes locations
        $bytesStart = $this->index[$message][0];
        $bytesEnd   = $this->index[$message][1];

        if (!is_resource($this->resource)) {
            dd('Mbox resource is not valid. Maybe you need to re-open it?');
        }

        // seek to start of message
        if (fseek($this->resource, $bytesStart) == -1) {
            dd('Cannot read message bytes');
        }

        if ($bytesEnd - $bytesStart <= 0) {
            dd('Message byte length is negative');
        }

        // reading and returning message
        // (bytes to read = difference of bytes locations)
        $msg = fread($this->resource, $bytesEnd - $bytesStart);
        return $this->_unescapeMessage($msg);
    }

    public function _process()
    {
        $this->index = array();

        // sanity check
        if (!is_resource($this->resource)) {
            dd('Resource is not valid. Maybe the file has not be opened?');
        }

        // going to start
        if (fseek($this->resource, 0) == -1) {
            dd('Cannot read mbox');
        }

        // current start byte position
        $start = 0;
        // last start byte position
        $laststart = 0;
        // there aren't any message
        $hasmessage = false;

        while ($line = fgets($this->resource, 4096)) {
            // if line start with "From ", it is a new message
            if (0 === strncmp($line, 'From ', 5)) {
                // save last start byte position
                $laststart = $start;

                // new start byte position is the start of the line
                $start = ftell($this->resource) - strlen($line);

                // if it is not the first message add message positions
                if ($start > 0) {
                    $this->index[] = array($laststart, $start - 1);
                } else {
                    // tell that there is really a message on the file
                    $hasmessage = true;
                }
            }
        }

        // if there are just one message, or if it's the last one,
        // add it to messages positions
        if (($start == 0 && $hasmessage === true) || ($start > 0)) {
            $this->index[] = array($start, ftell($this->resource));
        }

        return true;
    }

    private function _escapeMessage($message)
    {
        if (substr($message, -1) == "\n") {
            $message .= "\n";
        } else {
            $message .= "\n\n";
        }
        return preg_replace(
            "/\n([>]*From )/",
            "\n>$1",
            $message
        );
    }

    private function _unescapeMessage($message)
    {
        return preg_replace(
            "/\n>([>]*From )/",
            "\n$1",
            //the -1 drops the last newline
            substr($message, 0, -1)
        );
    }
}
