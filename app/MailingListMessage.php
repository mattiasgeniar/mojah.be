<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ZBateson\MailMimeParser\MailMimeParser;

class MailingListMessage extends Model
{
    protected $fillable = ['mailing_list_topic_id', 'mailing_list_author_id', 'hash', 'raw', 'content'];

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
        return $this->parse()->getHeaderValue('from');
    }

    public function getFromName()
    {
        return $this->parse()->getHeader('from') ? $this->parse()->getHeader('from')->getPersonName() : '';
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
