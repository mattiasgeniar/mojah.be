<?php

namespace App\Http\Controllers;

use App\MailingListMessage;

class AuthorMessagesController extends Controller
{
    /**
     * Paginate the resource.
     *
     * @param $authorId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index($authorId)
    {
        return MailingListMessage::query()
            ->with(['author'])
            ->where('mailing_list_author_id', $authorId)
            ->orderByDesc('created_at')
            ->paginate(5);
    }
}
