<?php

namespace App\Http\Controllers\E_COM;

use DB;
use Response;
use Auth;
use App\Helpers\Helper;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\e_com\Payment as PaymentModel;
use App\Models\inventory\OrderHeader as OrderHeaderModel;
use App\Models\inventory\OrderDetail as OrderDetailModel;
use App\Models\pos\InvoiceHeader as InvoiceHeaderModel;
use App\Models\pos\InvoiceDetail as InvoiceDetailsModel;
use App\Models\inventory\OrderLog as OrderLogModel;
use App\User as UserModel;

class ForShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        return view('E_COM.payment.for_shipping')
        ->with('items',OrderHeaderModel::where('status','=','6')->orWhere('status','=','5')->get());
    }
    

    public function complete()
    {
        //
        //
        return view('E_COM.payment.completed_order')
        ->with('items',OrderHeaderModel::where('status','=','7')->get());
    }

    public function cancel()
    {
        //
        //
        return view('E_COM.payment.cancelled_orders')
        ->with('items',OrderHeaderModel::where('status','=','1')->get());
    }

    public function changestatus($id, $action)
    {
        OrderHeaderModel::where('order_no',str_replace('w', '#', $id))->update(['status' => $action]);

        if ($action == '5') {

            $order_log = [
                'order_no' => str_replace('w', '#', $id),
                'action' => 'Order has been shipped to your location',
            ];

            OrderLogModel::insert($order_log);
        }

        if ($action == '7') {

            $order_log = [
                'order_no' => str_replace('w', '#', $id),
                'action' => 'Order has been received and completed',
            ];

            OrderLogModel::insert($order_log);
        }

        Session::flash('success','Suscces');

        return redirect()->route('shipping.list.index');
    }

}
