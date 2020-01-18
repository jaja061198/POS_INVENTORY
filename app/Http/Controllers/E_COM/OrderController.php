<?php

namespace App\Http\Controllers\E_COM;

use Auth;
use App\Helpers\Helper;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\inventory\OrderHeader as OrderHeaderModel;
use App\Models\inventory\OrderDetail as OrderDetailModel;
use App\Models\inventory\OrderLog as OrderLogModel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('E_COM.orders.new_orders')
        ->with('items',OrderHeaderModel::where('status','=',0)->orderBy('date_ordered','DESC')->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('E_COM.orders.review_order')
        ->with('headers',OrderHeaderModel::where('order_no','=',str_replace('w', '#', $id))->first())
        ->with('logs',OrderLogModel::where('order_no','=',str_replace('w', '#', $id))->orderBy('date_performed','desc')->get())
        ->with('details',OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approvereject($id , $action)
    {
        //
        $or = str_replace('w', '#', $id);

        if($action == 'approve')
        {
            OrderHeaderModel::where('order_no','=',$or)->update(['status' => '2']);

            $order_log = [
                'order_no' => $or,
                'action' => 'Order has been approved for payment',
            ];

            $window = 'New Orders';

            $action_type = 'APV';

            $action = 'Approved Order '.$or;

            Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

            OrderLogModel::insert($order_log);
        }

        if ($action == 'reject') 
        {
            # code...
            OrderHeaderModel::where('order_no','=',$or)->update(['status' => '1']);

            $order_log = [
                'order_no' => $or,
                'action' => 'Order has been reject kindly contact us for details',
            ];

            $window = 'New Orders';

            $action_type = 'REJ';

            $action = 'Rejected Order '.$or;

            Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

            OrderLogModel::insert($order_log);
        }

        Session::flash('success','Success');

        return redirect()->route('new.orders.index');
    }

    public function update(Request $request)
    {
        //
        $details = [
            'contact' => $request->input('contact'),
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'email' => $request->input('email'),
        ];

        FooterModel::where('id','=',$request->input('get_id'))->update($details);

        Session::flash('success','Upadate Success');

        return back();
    }

}
