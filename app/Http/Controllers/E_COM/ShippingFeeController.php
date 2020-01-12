<?php

namespace App\Http\Controllers\E_COM;

use Auth;
use App\Helpers\Helper;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\e_com\Shipping as ShippingModel;
use App\User as UserModel;

class ShippingFeeController extends Controller
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
        return view('E_COM.shippingfee.shippingfee')
        ->with('data',ShippingModel::orderBy('area','asc')->get());
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
        $changes = 0;
        // 
        foreach ($request->input('area') as $key => $value) 
        {

            if (Helper::getCheckBoxValue($request->input('update'))[$key] == 1) 
            {
                $for_update = [
                    'area' => $request->input('area')[$key],
                    'price' => Helper::removeCommas($request->input('price')[$key]),
                ];

                ShippingModel::where('id','=',$request->input('code')[$key])->update($for_update);

                $changes +=1;
            }
        }

        if ($request->input('area_add') != null) 
        {
            foreach ($request->input('area_add') as $key => $value) 
            {
                $for_add = [
                    'area' => $request->input('area_add')[$key],
                    'price' => Helper::removeCommas($request->input('price_add')[$key]),
                ];

                ShippingModel::insert($for_add);

                $changes +=1;
            }
        }


        if($changes > 0)
        {
            Session::flash('success','Changes was successfully completed');
        }

        else

        {
            Session::flash('success','No chages was made.');
        }

        return back();

        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        ShippingModel::where('id','=',$request->input('del_id'))->delete();

        Session::flash('success','Data has been removed successfully');

        return back();
    }

    public static function countTransaction($area)
    {
        return UserModel::where('area','=',$area)->count();
    }
}
