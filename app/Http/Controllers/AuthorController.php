<?php

namespace App\Http\Controllers;

use App\MailingListAuthor;

class AuthorController extends Controller
{
    /**
     * Show an Author.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $author = MailingListAuthor::where(['id' => $id])->firstOrFail();

        return view(
            'author.show',
            [
                'author' => $author,
            ]
        );
    }
}
