<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailingListTopic extends Model
{
    protected $fillable = ['topic', 'date', 'thread_id', 'mailing_list_list_id', 'mailing_list_author_id', 'created_at'];

    public function messages()
    {
        return $this->hasMany('App\MailingListMessage');
    }

    public function author()
    {
        return $this->belongsTo('App\MailingListAuthor', 'mailing_list_author_id');
    }

    public function list()
    {
        return $this->belongsTo('App\MailingListList', 'mailing_list_list_id');
    }

    public function getTopicUrl()
    {
        return '/mailing-list/'. $this->list->slug .'/'. $this->id;
    }
}
