<?php

namespace App\Http\Controllers;

use App\MailingListList;
use App\Repositories\TopicRepository;

class TopicApiController extends Controller
{
    /**
     * List the topics
     *
     * @param TopicRepository $topicRepository
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index($slug, TopicRepository $topicRepository)
    {
        $mailingListList = MailingListList::query()
            ->where(['slug' => $slug])
            ->firstOrFail();

        return $topicRepository->latestTopics($mailingListList);
    }
}
