<?php

namespace App\Http\Controllers\E_COM;

use Carbon;
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
use App\Models\masterfile\Item as ItemModel;
use App\User as UserModel;

class PaymentController extends Controller
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
        return view('E_COM.payment.payment')
        ->with('items',PaymentModel::first());
    }
 

    /**
     * Update the specifiedr esource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $details = [
            'description' => $request->input('description'),
        ];

        $window = 'Terms & Conditions';

        $action_type = 'ED';

        $action = 'Updated About Us Values';

        Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

        PaymentModel::where('id','=',$request->input('get_id'))->update($details);

        Session::flash('success','Upadate Success');

        return back();
    }

    public function forPayment()
    {   
        return view('E_COM.payment.payment_list')
        ->with('items',OrderHeaderModel::where('status','=','2')->orderBy('date_ordered','DESC')->get());
    }

    public function forPaymentReview()
    {   
        return view('E_COM.payment.payment_review')
        ->with('items',OrderHeaderModel::where('status','=','3')->orderBy('date_ordered','DESC')->get());
    }

    public function downloadPayment($id)
    {

        $get_image = OrderHeaderModel::where('order_no','=',str_replace('w', '#', $id))->first();

        $base_link = DB::table('image_base_payment')->first();

         return redirect(($base_link->link.'img/').$get_image->image);
    }

    public function approvereject($id, $action)
    {
        if ($action == 'approve') 
        {
            # code...
            $get_or_header = OrderHeaderModel::where('order_no','=',str_replace('w', '#', $id))->first();

            $get_user_info = UserModel::where('id','=',$get_or_header->user)->first();

            $grandtotal2 = 0;

            if ($get_or_header->type == '1') 
            {

                $total_items_price =  OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->sum('item_price');


                foreach (OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->get() as $grand_key => $grand_value) 
                {

                    $grandtotal2 += $grand_value['item_price'] * $grand_value['quantity'];
                }

                # code...
                # With Shipping
                OrderHeaderModel::where('order_no','=',str_replace('w', '#', $id))->update(['status' => '6']); #Change status to to ship

                #generate invoice

                $code_holder = $this->generateCode();

                $header = [
                    'INVOICE_NO' => $code_holder,
                    'CUSTOMER' => $get_user_info->name,
                    'DISCOUNT' => 0,
                    'ADDITIONAL_DISC' => 0,
                    'SERVICE_COST' => $get_or_header->shipping_price,
                    'GRAND_TOTAL' => $grandtotal2 + $get_or_header->shipping_price,
                    'GRAND_TOTAL2' => $grandtotal2 + $get_or_header->shipping_price,
                    'CASH_AMOUNT' => $grandtotal2 + $get_or_header->shipping_price,
                    'CHANGE' => 0,
                    'INVOICE_DATE' => Carbon\Carbon::now(),
                ];

                InvoiceHeaderModel::insert($header);

                foreach (OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->get() as $key => $value) 
                {
                    $details = [
                        'INVOICE_NO' => $code_holder,
                        'LINE_NO' => $key+1,
                        'ITEM_CODE' => $value['item_code'],
                        'PRICE' => $value['item_price'],
                        'TYPE' => 1,
                        'DISCOUNT' => 0,
                        'QUANTITY' => $value['quantity'],
                        'TOTAL_PRICE' => $value['item_price'] * $value['quantity'],
                        'INVOICE_DATE' => Carbon\Carbon::now(),
                    ];

                    InvoiceDetailsModel::insert($details);

                }

                 $order_log = [
                    'order_no' => str_replace('w', '#', $id),
                    'action' => 'Payment has been accepted here is your invoice reference number '.$code_holder,
                ];

                OrderLogModel::insert($order_log);

                Session::flash('success','Order has been successfully invoiced');
                return redirect()->route('payment.review.index');

            }

            #For Pickup

            if ($get_or_header->type == '2') 
            {

                $total_items_price =  OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->sum('item_price');

                # code...
                # With Shipping
                OrderHeaderModel::where('order_no','=',str_replace('w', '#', $id))->update(['status' => '4']); #Change status to to ship

                #generate invoice

                foreach (OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->get() as $grand_key => $grand_value) 
                {

                    $grandtotal2 += $grand_value['item_price'] * $grand_value['quantity'];
                }

                $code_holder = $this->generateCode();

                $header = [
                    'INVOICE_NO' => $code_holder,
                    'CUSTOMER' => $get_user_info->name,
                    'DISCOUNT' => 0,
                    'ADDITIONAL_DISC' => 0,
                    'SERVICE_COST' => 0,
                    'GRAND_TOTAL' => $grandtotal2,
                    'GRAND_TOTAL2' => $grandtotal2,
                    'CASH_AMOUNT' => $grandtotal2,
                    'CHANGE' => 0,
                    'INVOICE_DATE' => Carbon\Carbon::now(),
                ];

                InvoiceHeaderModel::insert($header);

                foreach (OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->get() as $key => $value) 
                {
                    $details = [
                        'INVOICE_NO' => $code_holder,
                        'LINE_NO' => $key+1,
                        'ITEM_CODE' => $value['item_code'],
                        'PRICE' => $value['item_price'],
                        'TYPE' => 1,
                        'DISCOUNT' => 0,
                        'QUANTITY' => $value['quantity'],
                        'TOTAL_PRICE' => $value['item_price'] * $value['quantity'],
                        'INVOICE_DATE' => Carbon\Carbon::now(),
                    ];

                    InvoiceDetailsModel::insert($details);

                    $this->updateQuantity($value['item_code'], $value['quantity']);

                }

                 $order_log = [
                    'order_no' => str_replace('w', '#', $id),
                    'action' => 'Payment has been accepted here is your invoice reference number '.$code_holder,
                ];

                OrderLogModel::insert($order_log);

                $window = 'For Payment Review';

                $action_type = 'APV';

                $action = 'Approved Payment for ORDER '.str_replace('w', '#', $id). 'Invoice ref '.$code_holder;

                Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

                Session::flash('success','Order has been successfully invoiced');
                return redirect()->route('payment.review.index');

            }
        }

        if ($action == 'reject') 
        {
            # code...

            OrderHeaderModel::where('order_no','=',str_replace('w', '#', $id))->update(['status' => '2']); #Change status to to ship

            $order_log = [
                'order_no' => str_replace('w', '#', $id),
                'action' => 'Payment has been rejected please contact us for further details',
            ];

            OrderLogModel::insert($order_log);

            $window = 'For Payment Review';

                $action_type = 'APV';

                $action = 'Rejected Payment for ORDER '.str_replace('w', '#', $id);

                Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

            return back();
        }
    }


    public function generateCode()
    {
            $data_count = InvoiceHeaderModel::count();

            if ($data_count == 0) 
            {
                $slots = "00000";

                $generated_code = 'INV00000';

                return $generated_code;
            }

            $slots = "00000";

            $padding = strlen($slots) - $data_count;

            $padded_code = substr($slots, -( 5 - strlen($data_count)));

            if(strlen($data_count) >= 5)
            {
                $generated_code = 'INV'.$data_count;

                return $generated_code;
            }

            $generated_code = 'INV'.$padded_code.$data_count;

            return $generated_code;
    }

    public function updateQuantity($ITEM_CODE , $QUANTITY)
    {
        $get_item = ItemModel::where('ITEM_CODE','=',$ITEM_CODE)->select('QUANTITY')->first();

        $new_quantity = $get_item->QUANTITY - $QUANTITY;

        ItemModel::where('ITEM_CODE','=',$ITEM_CODE)->update(['QUANTITY' => $new_quantity]);
    }
}
