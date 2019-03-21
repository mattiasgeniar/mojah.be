<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailingListList;
use App\MailingListTopic;
use App\MailingListAuthor;

class MailingListController extends Controller
{
    public function index()
    {
        return view(
            'mailinglist.index',
            [
                'mailingLists' => MailingListList::all()->sortBy('slug')
            ]
        );
    }

    public function showTopics($slug)
    {
        $mailingList = MailingListList::where(['slug' => $slug])->firstOrFail();
        $topics = $mailingList->topics()->orderBy('created_at', 'desc')->get();

        return view(
            'mailinglist.showTopics',
            [
                'mailingList' => $mailingList,
                'topics' => $topics,
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

    public function showAuthor($id)
    {
        $author = MailingListAuthor::where(['id' => $id])->firstOrFail();

        return view(
            'mailinglist.showAuthor',
            [
                'author' => $author,
            ]
        );
    }
}
