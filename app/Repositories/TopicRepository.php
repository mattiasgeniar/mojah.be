<?php

namespace App\Repositories;

use App\MailingListList;

class TopicRepository
{
    public function latestTopics(MailingListList $mailingListList)
    {
        return $mailingListList->topics()->orderBy('created_at', 'desc')->paginate(5);
    }
}
