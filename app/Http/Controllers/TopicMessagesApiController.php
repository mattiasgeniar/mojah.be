<?php

namespace App\Http\Controllers;

use App\MailingListMessage;

class TopicMessagesApiController extends Controller
{
    /**
     * Lists the resource.
     *
     * @param $slug
     * @param $topicId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index($slug, $topicId)
    {
        $messages = MailingListMessage::query()
            ->with('author')
            ->where('mailing_list_topic_id', $topicId)
            ->orderByDesc('created_at')
            ->get();

        return $messages;
    }
}
