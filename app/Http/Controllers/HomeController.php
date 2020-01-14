<?php

namespace App\Http\Controllers;

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

        $current_month = date("M");

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

        for($i = 0; $i < sizeof($months) ; $i++ )
        {
                $sales[$i] = InvoiceHeaderModel::whereYear('INVOICE_DATE',date('Y'))->whereMonth('INVOICE_DATE',$i + 1)->sum('GRAND_TOTAL2');            
            
        }
        return response()->json(['months' => $months,'sales' => $sales]);
    }


}
