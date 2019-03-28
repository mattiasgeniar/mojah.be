<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ZBateson\MailMimeParser\MailMimeParser;

class MailingListMessage extends Model
{
    protected $fillable = ['mailing_list_topic_id', 'mailing_list_author_id', 'hash', 'raw', 'content', 'created_at'];

    protected $appends = ['message_body', 'created_at_ago'];

    private $message = null;

    public function topic()
    {
        return $this->belongsTo('App\MailingListTopic', 'mailing_list_topic_id');
    }

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
        // 2 ways to get the e-mail: if there's a Reply-To header, use that
        if ($replyTo = $this->getReplyToRaw()) {
            // The Reply-To has 2 potential flavors:
            // - Reply-To: user@domain.com
            // - Reply-To: John Doe <user@domain.com>

            // Match the 1st case
            if (filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
                return $replyTo;
            }

            // Match the 2nd case
            $matches = [];
            preg_match('/<.*>/', $replyTo, $matches);

            if (array_key_exists(0, $matches) && strlen($matches[0]) > 0) {
                $emailAddress = str_replace(['<', '>'], '', $matches[0]);

                return $emailAddress;
            }
        }

        // Alternatively, fall back to the From-header (which is used in mbox archives)
        $email = $this->parse()->getHeaderValue('From');

        return preg_replace('/at/', '@', $email, 1);
    }

    private function getReplyToRaw()
    {
        $replyTo = $this->parse()->getHeader('Reply-To');

        if ($replyTo) {
            $replyToRaw = $replyTo->getRawValue();

            $pieces = explode(",\r\n", $replyToRaw);

            if (array_key_exists(0, $pieces) && strlen($pieces[0]) > 0) {
                $replyToPiece = $pieces[0];

                return $replyToPiece;
            }
        }

        return false;
    }

    public function getFromName()
    {
        // 2 ways to get the e-mail name: if there's a Reply-To header, use that
        if ($replyTo = $this->getReplyToRaw()) {
            if (strpos($replyTo, '<') !== false) {
                // Split this string: "Peter Todd <pete@petertodd.org>"
                // And extract the first name
                $replyToPieces = explode('<', $replyTo);

                return trim($replyToPieces[0]);
            }
        }

        // Alternatively, parse the From header
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

        // See if there's content like "Firstname Lastname via bitcoin-dev <bitcoin-dev@lists.linuxfoundation.org>"
        if (strpos($rawHeader, ' via bitcoin-')) {
            return trim(substr($rawHeader, 0, strpos($rawHeader, ' via bitcoin-')));
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

    public function getMessageUrl()
    {
        return $this->topic->topic_url .'#'. $this->id;
    }

    public function getMessageTeaser($limit = 85)
    {
        return strlen($this->content) > $limit ? substr($this->content, 0, $limit) . "..." : $this->content;
    }

    public function getMessageBodyAttribute()
    {
        return getMessageBody(e($this->content));
    }

    public function getCreatedAtAgoAttribute()
    {
        return $this->created_at->ago();
    }
}
