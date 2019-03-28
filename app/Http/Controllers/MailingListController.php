<?php

namespace App\Http\Controllers;

use App\MailingListList;

class MailingListController extends Controller
{
    /**
     * List the Mailing Lists.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view(
            'mailing-list.index',
            [
                'mailingLists' => MailingListList::all()->sortBy('slug')
            ]
        );
    }
}
