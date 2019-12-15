<?php

namespace App\Http\Controllers\E_COM;


use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\inventory\OrderHeader as OrderHeaderModel;
use App\Models\inventory\OrderDetail as OrderDetailModel;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        ->with('details',OrderDetailModel::where('order_id','=',str_replace('w', '#', $id))->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
