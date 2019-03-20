<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ZBateson\MailMimeParser\MailMimeParser;

class MailingListMessage extends Model
{
    protected $fillable = ['mailing_list_topic_id', 'mailing_list_author_id', 'hash', 'raw', 'content', 'created_at'];

    private $message = null;

    public function setRawMessage($message)
    {
        $this->message = $message;
    }

    public function getBodyText()
    {
        return $this->parse()->getTextContent();
    }

    public function getFromEmail()
    {
        $email = $this->parse()->getHeaderValue('from');

        return preg_replace('/at/', '@', $email, 1);
    }

    public function getFromName()
    {
        // The getPersonName() method from the mime-parser does not correctly parse names
        // User our own parser instead
        if (! $this->parse()->getHeader('from')) {
            return 'Anonymous';
        }

        if (! $rawHeader = $this->parse()->getHeader('from')->getRawValue()) {
            return 'Anonymous';
        }

        $matches = [];
        preg_match('/\(.*\)/', $rawHeader, $matches);

        if (is_array($matches) && array_key_exists(0, $matches)) {
            // Strip the surrounding brackets from the (Name)
            $name = substr(substr($matches[0], 0, strlen($matches[0]) -1), 1);

            if (function_exists('imap_mime_header_decode')) {
                $parsed = imap_mime_header_decode($name);
                return utf8_encode($parsed[0]->text);
            } else {
                return $name;
            }
        }

        return 'Anonymous';
    }

    public function getSubject()
    {
        return $this->parse()->getHeaderValue('subject');
    }

    public function getDate()
    {
        return $this->parse()->getHeaderValue('date');
    }

    private function parse()
    {
        $parser = new MailMimeParser();

        return $parser->parse($this->message);
    }

    public function author()
    {
        return $this->belongsTo('App\MailingListAuthor', 'mailing_list_author_id');
    }
}
