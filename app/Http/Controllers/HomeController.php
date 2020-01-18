<?php

namespace App\Http\Controllers;

use Carbon;
use Response;
use Illuminate\Http\Request;
use App\Models\pos\InvoiceHeader as InvoiceHeaderModel;
use App\Models\pos\InvoiceDetail as InvoiceDetailsModel;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function artisancall()
    {

        \Artisan::call('view:clear');

        \Artisan::call('config:clear');

        \Artisan::call('config:cache');

        \Artisan::call('clear-compiled');

    }

    public function chart()
    {
        $months = ['January','Febuary','March','April','May','June','July','August','September','October','November','December'];

        $days = cal_days_in_month(CAL_GREGORIAN, date("m"), date("y"));

        $current_month = date("M");

        $get_days = [];

        for ($i=1; $i <= $days ; $i++) { 
            // $get_days[$i] = "$i";
            array_push($get_days, $i);
        }

        $relative_months = [];

        for ($i=0; $i < 12 ; $i++) 
        { 
            if ($current_month != substr($months[$i],0,3)) 
            {
                $relative_months[$i] = $months[$i];
            }

            else

            {
                $relative_months[$i] = $months[$i];

                break;
            }
        }

        $sales = [];

        for($i = 0; $i < sizeof($get_days) ; $i++ )
        {
                $year = Carbon\Carbon::now()->year;
                $month = Carbon\Carbon::now()->month;
                $date_create = date_create($year."-".$month."-".$i);
                $format_date = date_format($date_create,"Y-m-d");
                // $sales[$i] = InvoiceHeaderModel::whereYear('INVOICE_DATE',date('Y'))->whereMonth('INVOICE_DATE',Carbon\Carbon::now()->month)->sum('GRAND_TOTAL2');
                $sales[$i] = InvoiceHeaderModel::where('INVOICE_DATE','=',$format_date)->sum('GRAND_TOTAL2');            
            
        }

        return response()->json(['months' => $get_days,'sales' => $sales]);

    }
}
