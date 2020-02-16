<?php namespace App\Helpers;

use Auth;
use App\Models\app_manager\Company as CompanyModel;
use App\User as UserModel;
use App\Models\app_manager\WindowAccess as AccessModel;
use App\Models\pos\InvoiceHeader as InvoiceHeaderModel;
use App\Models\masterfile\Item as ItemModel;
use App\Models\inventory\OrderHeader as OrderHeaderModel;
use App\Models\app_manager\AuditTrail as AuditTrailModel;
use App\Models\masterfile\Service as ServiceModel;
use App\Models\e_com\Shipping as ShippingModel;
use Carbon\Carbon;
use DB;

class Helper
{

    public static function getUserAccess($WINDOW_ID)
    {
        return AccessModel::where('USER_ID','=',Auth::user()->id)->where('NAV_ID','=',$WINDOW_ID)->first();
    }

    public static function convert_number_to_words($number)
    {
        $hyphen      = ' ';
        $conjunction = ' ';
        $separator   = ' ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion',
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . self::convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string    = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit     = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder    = $number % $baseUnit;
                $string       = self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= self::convert_number_to_words($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return ucwords($string);
    }
    

    public static function GetCompanyInfo()
    {
        return CompanyModel::first();
    }

    public static function getUserLevel($USER_ID)
    {
        return UserModel::where('id','=',$USER_ID)->select('user_level')->first();
    }

    public static function getUserInfo($USER_ID)
    {
        return UserModel::where('id','=',$USER_ID)->first();
    }

    public static function getCheckBoxValue($checkbox_value)
    {
        $chk_name = $checkbox_value;
        $found = array(); 
        if(!empty($chk_name)) {
            foreach($chk_name as $key => $val) {
                if($val == '1') {
                    $found[] = $key;
                }
            }
        }
        
        foreach($found as $kev_f => $val_f) {
            unset($chk_name[$val_f+1]); 
        } 
        $final_arr = array(); 
        return $final_arr = array_values($chk_name); 
    }

    public static function numberFormat( $NUMBER )
    {
        return number_format($NUMBER, 2, '.', ',');
    }

    public static function removeCommas( $NUMBER )
    {
        return str_replace( ',', '', $NUMBER);
    }

    public static function getTodaySales()
    {
        $today_sales = InvoiceHeaderModel::whereDate('INVOICE_DATE','=',date('Y-m-d'))->sum('GRAND_TOTAL2');

        return $today_sales;
    }

    public static function getMonthlySales()
    {
        $today_sales = InvoiceHeaderModel::whereMonth('INVOICE_DATE','=',Carbon::now()->month)->sum('GRAND_TOTAL2');

        return $today_sales;
    }

    public static function getMinimumItems()
    {
        return ItemModel::whereRaw('QUANTITY < MIN_LEVEL')->count();
    }
    

    public static function getneworders()
    {
        return OrderHeaderModel::where('status','=','0')->count();
    }


    public static function retrieveMinimumItems()
    {
        return ItemModel::whereRaw('QUANTITY < MIN_LEVEL')->get();
    }


    public static function retrieveOrders()
    {
        return OrderHeaderModel::where('status','=',0)->get();
    }

    public static function getIteminfo($item_code)
    {
        return ItemModel::where('ITEM_CODE','=',$item_code)->first();
    }

    public static function getServiceInfo($service_code)
    {
        return ServiceModel::where('SERVICE_CODE','=',$service_code)->first();
    }

    public static function putTrail($user_id, $window, $action_type, $action)
    {
        $trail = [
            'user_id' => $user_id,
            'window' => $window,
            'action_type' => $action_type,
            'action' => $action
        ];

        AuditTrailModel::insert($trail);
    }

    public static function getShippingInfo($code)
    {
        if ($code == '' || $code == null) 
        {
            return (object) ['area' => 'N\A'];
        }
        else
        {
            return ShippingModel::where('id','=',$code)->first();
        }
    }
    
}
