<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailingListList;
use App\MailingListTopic;

class MailingListController extends Controller
{
    public function index()
    {
        return view(
            'mailinglist.index',
            [
                'mailingLists' => MailingListList::all()
            ]
        );
    }

    public function showTopics($slug)
    {
        return view(
            'mailinglist.showTopics',
            [
                'mailingList' => MailingListList::where(['slug' => $slug])->firstOrFail()
            ]
        );
    }

    public function showTopic($slug, $topic)
    {
        return view(
            'mailinglist.showTopic',
            [
                'mailingList' => MailingListList::where(['slug' => $slug])->firstOrFail(),
                'topic' => MailingListTopic::findOrFail($topic),
            ]
        );
    }
}
