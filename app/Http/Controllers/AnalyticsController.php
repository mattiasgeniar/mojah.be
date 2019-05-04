<?php

namespace App\Http\Controllers;

class AnalyticsController extends Controller
{
    /**
     * List the Mailing Lists.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view(
            'analytics.index'
        );
    }

    public function transactionCountPerDay()
    {
        $txPerDay = [
            1 => 5,
            2 => 10,
        ];

        return view(
            'analytics.transaction-count-per-day',
            [
                'txPerDay' => $txPerDay,
            ]
        );
    }
}
