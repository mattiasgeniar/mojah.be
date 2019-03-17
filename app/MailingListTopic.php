<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailingListTopic extends Model
{
    protected $fillable = ['topic', 'date', 'thread_id', 'mailing_list_list_id', 'mailing_list_author_id'];

    public function messages()
    {
        return $this->hasMany('App\MailingListMessage');
    }
}
