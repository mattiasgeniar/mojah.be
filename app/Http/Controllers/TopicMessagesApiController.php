<?php

namespace App\Http\Controllers;

use App\MailingListList;
use App\MailingListMessage;
use Illuminate\Http\Request;

class TopicMessagesApiController extends Controller
{
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
