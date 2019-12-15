<?php

namespace App\Http\Controllers\pos;


use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\pos\InvoiceHeader as InvoiceHeaderModel;
use App\Models\pos\InvoiceDetail as InvoiceDetailsModel;
use App\Models\masterfile\Item as ItemModel;
use App\Models\masterfile\Service as ServiceModel;

class SalesReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDaily()
    {
        //
        return view('POS.pos.reports.daily_report');
    }


    public function indexWeekly()
    {
        //
        return view('POS.pos.reports.weekly_report');
    }

    public function indexMonthly()
    {
        //
        return view('POS.pos.reports.monthly_report');
    }


    public function generateMonthlySales(Request $request)
    {
        return view('POS.pos.reports.monthly_report_result')
        ->with('date_sort',$request->input('date_sort'));
    }

    public function generateDailySales(Request $request)
    {
        return view('POS.pos.reports.daily_report_result')
        ->with('date_sort',$request->input('month'));
    }

    public function generateWeeklySales(Request $request)
    {

          $year = substr($request->input('date_sort'),0,4);

          $week = substr($request->input('date_sort'),6);

          $dto = new DateTime();
          $dto->setISODate($year, $week);
          $ret['week_start'] = $dto->format('Y-m-d');
          $dto->modify('+6 days');
          $ret['week_end'] = $dto->format('Y-m-d');
            // return InvoiceDetailsModel::where('INVOICE_NO','=',)
          return view('POS.pos.reports.weekly_report_result')
          ->with('week_start',$ret['week_start'])
          ->with('week_end',$ret['week_end']);
        }

    public static function getDailyData($date)
    {
        $count = InvoiceDetailsModel::where('INVOICE_DATE','=',$date)->count();

        return $count;
    }

    public static function getWeeklyData($week_start, $week_end)
    {
        $count = InvoiceDetailsModel::where('INVOICE_DATE','>=',$week_start)->where('INVOICE_DATE','<=',$week_end)->count();

        return $count;
    }

    public static function getMonthlyData($month)
    {
        $count = InvoiceDetailsModel::whereYear('INVOICE_DATE',date('Y',strtotime($month)))->whereMonth('INVOICE_DATE',date('m',strtotime($month)))->count();

        return $count;
    }


    public static function retrieveWeeklyData($week_start,$week_end,  $skip, $take)
    {
        $retrieve = InvoiceDetailsModel::where('INVOICE_DATE','>=',$week_start)->where('INVOICE_DATE','<=',$week_end)->skip($skip)->take($take)->orderBy('INVOICE_NO','ASC')->get();

        $data = [];
        foreach ($retrieve as $key => $value) 
        {
             $data[] = [
                'INVOICE' => $value['INVOICE_NO'],
                'TYPE' => Self::geType($value['TYPE']),
                'CODE' => $value['ITEM_CODE'],
                'DESC' => Self::getDesc($value['TYPE'], $value['ITEM_CODE']),
                'QUANTITY' => $value['QUANTITY'],
                'TOTAL_PRICE' => $value['TOTAL_PRICE'],
            ];

        }


        return $data;
    }

    public static function retrieveDailyData($date,  $skip, $take)
    {
        $retrieve = InvoiceDetailsModel::where('INVOICE_DATE','=',$date)->skip($skip)->take($take)->orderBy('INVOICE_NO','ASC')->get();

        $data = [];
        foreach ($retrieve as $key => $value) 
        {
             $data[] = [
                'INVOICE' => $value['INVOICE_NO'],
                'TYPE' => Self::geType($value['TYPE']),
                'CODE' => $value['ITEM_CODE'],
                'DESC' => Self::getDesc($value['TYPE'], $value['ITEM_CODE']),
                'QUANTITY' => $value['QUANTITY'],
                'TOTAL_PRICE' => $value['TOTAL_PRICE'],
            ];

        }


        return $data;
    }


    public static function retrieveMontlyData($month,  $skip, $take)
    {
        $retrieve = InvoiceDetailsModel::whereYear('INVOICE_DATE',date('Y',strtotime($month)))->whereMonth('INVOICE_DATE',date('m',strtotime($month)))->skip($skip)->take($take)->get();

        $data = [];
        foreach ($retrieve as $key => $value) 
        {
             $data[] = [
                'INVOICE' => $value['INVOICE_NO'],
                'TYPE' => Self::geType($value['TYPE']),
                'CODE' => $value['ITEM_CODE'],
                'DESC' => Self::getDesc($value['TYPE'], $value['ITEM_CODE']),
                'QUANTITY' => $value['QUANTITY'],
                'TOTAL_PRICE' => $value['TOTAL_PRICE'],
            ];

        }


        return $data;
    }


    public static function geType($type)
    {
        if ($type == '1') 
        {
           return 'ITEM';
        }

        if ($type == '2') 
        {
           return 'SERVICE';
        }
    }

    public static function getDesc($type , $code)
    {
        if ($type == '1') 
        {
            $data = ItemModel::where('ITEM_CODE','=',$code)->first();

            return $data->ITEM_DESC;
        }

        if ($type == '2') 
        {
           $data = ServiceModel::where('SERVICE_CODE','=',$code)->first();

           return $data->SERVICE_DESC;
        }
    }

    public static function getTotalDiscount($date)
    {   
        $sum = InvoiceHeaderModel::where('INVOICE_DATE','=',$date)->sum('DISCOUNT');

        $sum2 = InvoiceHeaderModel::where('INVOICE_DATE','=',$date)->sum('ADDITIONAL_DISC');

        return $sum + $sum2;
    }


    public static function getTotalDiscountMonthly($month)
    {   
        $sum = InvoiceHeaderModel::whereYear('INVOICE_DATE',date('Y',strtotime($month)))->whereMonth('INVOICE_DATE',date('m',strtotime($month)))->sum('DISCOUNT');

        $sum2 = InvoiceHeaderModel::whereYear('INVOICE_DATE',date('Y',strtotime($month)))->whereMonth('INVOICE_DATE',date('m',strtotime($month)))->sum('ADDITIONAL_DISC');

        return $sum + $sum2;
    }


    public static function getTotalDiscountWeekly($week_start,$week_end)
    {   
        $sum = InvoiceHeaderModel::where('INVOICE_DATE','>=',$week_start)->where('INVOICE_DATE','<=',$week_end)->sum('DISCOUNT');

        $sum2 = InvoiceHeaderModel::where('INVOICE_DATE','>=',$week_start)->where('INVOICE_DATE','<=',$week_end)->sum('ADDITIONAL_DISC');

        return $sum + $sum2;
    }


}
