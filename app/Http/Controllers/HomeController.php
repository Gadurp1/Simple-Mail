<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
      $analyticsData =$analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));;
      $topPages =Analytics::fetchMostVisitedPages(Period::days(1));
      $topPages =Analytics::fetchMostVisitedPages(Period::days(1));
      return view('home',compact('analyticsData','topPages'));
    }
}
