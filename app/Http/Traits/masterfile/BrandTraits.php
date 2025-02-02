<?php

namespace App\Http\Traits\masterfile;


use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\masterfile\Brand as BrandModel;

trait BrandTraits 
{
	public function indexFunction()
	{
		return view('POS.masterfile.brand.brand')
		->with('brand',BrandModel::all());
	}

	public function validateCode($CODE)
	{
		$count = BrandModel::where('BRAND_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function validateCodeEdit($CODE,$OLD_CODE)
	{
		$count = BrandModel::where('BRAND_CODE','!=',$OLD_CODE)->where('BRAND_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function getDetails($CODE)
	{
		$details = BrandModel::where('BRAND_CODE','=',$CODE)->first();

		return response()->json(['BRAND_CODE' => $details['BRAND_CODE'], 'BRAND_DESC' => $details['BRAND_DESC'] ]);
	}

	public function insertFunction(Request $request)
	{
		$details = [
			'BRAND_CODE' => $request->input('add_brand_code'),
			'BRAND_DESC' => $request->input('add_brand_desc'),
		];

		BrandModel::insert($details);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function updateFunction(Request $request)
	{
		$details = [
			'BRAND_CODE' => $request->input('edit_brand_code'),
			'BRAND_DESC' => $request->input('edit_brand_desc'),
		];

		BrandModel::where('BRAND_CODE','=',$request->input('get_code'))->update($details);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function deleteFunction(Request $request)
	{
		
		BrandModel::where('BRAND_CODE','=',$request->input('code'))->delete();

		Session::flash('success','Deletion Success');

		return back();
	}
}