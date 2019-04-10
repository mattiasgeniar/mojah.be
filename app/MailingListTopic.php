<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class MailingListTopic extends Model implements Feedable
{
    protected $fillable = ['topic', 'date', 'thread_id', 'mailing_list_list_id', 'mailing_list_author_id', 'created_at'];

    protected $appends = ['topic_url', 'created_at_ago', 'messages_api_url'];

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

    public function getTopicUrlAttribute()
    {
        return "/mailing-lists/{$this->list->slug}/{$this->id}";
    }

    public function getMessagesApiUrlAttribute()
    {
        return "/api/v1/mailing-lists/{$this->list->slug}/{$this->id}/messages";
    }

    public function getCreatedAtAgoAttribute()
    {
        return $this->created_at->ago();
    }

    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->topic)
            ->summary($this->messages()->first()->message_teaser)
            ->author($this->author->display_name)
            ->updated($this->updated_at)
            ->link($this->topic_url);
    }

    public static function getFeedItems()
    {
        return static::query()->orderBy('created_at', 'desc')->limit(25)->get();
    }
}
