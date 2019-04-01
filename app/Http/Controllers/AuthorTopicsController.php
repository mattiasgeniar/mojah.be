<?php

namespace App\Http\Controllers;

use App\MailingListTopic;

class AuthorTopicsController extends Controller
{
    /**
     * Paginate the resource.
     *
     * @param $authorId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index($authorId)
    {
        return MailingListTopic::query()
            ->with(['author', 'list'])
            ->where('mailing_list_author_id', $authorId)
            ->orderByDesc('created_at')
            ->paginate(15);
    }
}
