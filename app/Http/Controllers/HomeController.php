<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $origin_date = Carbon::parse("2022-03-27 00:00:00");
            // March 27 because it is the start of the calendar month for April
            // Actual date is April 7 for the formal
        $now = Carbon::now();
        $number_of_months = $origin_date->diff($now)->format('%m') + 1;

        $active_month = 0;

        $total_array = [];

        for($i = 0; $i < $number_of_months; $i++) {

            if ($i == 0) {
                $current_date = Carbon::parse("2022-03-27 00:00:00")->addDays($i * 42);
            } else {
                $current_date = Carbon::parse("2022-03-27 00:00:00")->addDays($i * 42);

                while($current_date->isoformat("D") != 1) {
                    $current_date->subDay();
                }

                while($current_date->dayOfWeekIso != 7) {
                    $current_date->subDay();
                }
            }

            $temp_array = [];

            for( $j = 0; $j < 42; $j++) {
                if($current_date->isoformat("D") == 1) {
                    $active_month = !$active_month;
                }

                // Query event for name to attach to array
                $event = Event::where('date', $current_date->toDateString())->first();

                if($event) {
                    if(!$active_month) {
                        $temp_array[] = [$current_date->toDateString(), 0, $event->name, ""];
                    } else {
                        if($event->photos()->first()) {
                            $temp_array[] = [$current_date->toDateString(), 1, $event->name, Storage::disk('s3')->url($event->photos()->first()->url)];
                        } else {
                            $temp_array[] = [$current_date->toDateString(), 1, $event->name, ""];
                        }
                    }
                } else {
                    if(!$active_month) {
                        $temp_array[] = [$current_date->toDateString(), 0, "", ""];
                    } else {
                        $temp_array[] = [$current_date->toDateString(), 1, "", ""];
                    }
                }


                $current_date->addDay();
            }

            $total_array[] = $temp_array;
        }

        $number_of_months -= 1;
        $month_number = $current_date->subMonth()->format('m');
        $month = $current_date->format('F');
        $year = $current_date->format('Y');

        return view('welcome')
            ->with('year', $year)
            ->with('month', $month)
            ->with('month_number', $month_number)
            ->with('number_of_months', $number_of_months)
            ->with('total_array', $total_array);
    }


    /**
     * Show the login screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login()
    {
        $date = "2023-07-27 00:00:00";
        $date_tmp = Carbon::createFromDate($date);
        $days_left = $date_tmp->diffInDays(Carbon::now());

        return view('auth.login', compact('days_left'));
    }
}
