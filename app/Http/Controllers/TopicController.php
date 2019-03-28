<?php

namespace App\Http\Controllers;

use App\MailingListList;
use App\MailingListTopic;
use App\Repositories\TopicRepository;

class TopicController extends Controller
{
    /**
     * List the topics.
     *
     * @param $slug
     * @param TopicRepository $topicRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug, TopicRepository $topicRepository)
    {
        $mailingList = MailingListList::where(['slug' => $slug])->firstOrFail();

        $topics = $topicRepository->latestTopics($mailingList);

        return view(
            'topic.index',
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
            'topic.show',
            [
                'mailingList' => MailingListList::where(['slug' => $slug])->firstOrFail(),
                'topic' => MailingListTopic::findOrFail($topic),
            ]
        );
    }
}
