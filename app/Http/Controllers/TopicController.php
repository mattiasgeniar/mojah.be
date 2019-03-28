<?php

namespace App\Http\Controllers;

use App\MailingListList;
use App\MailingListTopic;

class TopicController extends Controller
{
    /**
     * List the topics.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug)
    {
        $mailingList = MailingListList::where(['slug' => $slug])->firstOrFail();
        $topics = $mailingList->topics()->orderBy('created_at', 'desc')->get();

        return view(
            'topics.index',
            [
                'mailingList' => $mailingList,
                'topics' => $topics,
            ]
        );
    }

    /**
     * Show a specific Topic.
     *
     * @param $slug
     * @param $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug, $topic)
    {
        return view(
            'topics.show',
            [
                'mailingList' => MailingListList::where(['slug' => $slug])->firstOrFail(),
                'topic' => MailingListTopic::findOrFail($topic),
            ]
        );
    }
}
