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

use App\Models\masterfile\ItemType as ItemTypeModel;

trait ItemTypeTraits 
{
	public function indexFunction()
	{
		return view('POS.masterfile.item_type.itemtype')
		->with('datas',ItemTypeModel::all());
	}

	public function validateCode($CODE)
	{
		$count = ItemTypeModel::where('ITEM_TYPE_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function validateCodeEdit($CODE,$OLD_CODE)
	{
		$count = ItemTypeModel::where('ITEM_TYPE_CODE','!=',$OLD_CODE)->where('ITEM_TYPE_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function getDetails($CODE)
	{
		$details = ItemTypeModel::where('ITEM_TYPE_CODE','=',$CODE)->first();

		return response()->json(['ITEM_TYPE_CODE' => $details['ITEM_TYPE_CODE'], 'ITEM_TYPE_DESC' => $details['ITEM_TYPE_DESC'] ]);
	}

	public function insertFunction(Request $request)
	{
		$details = [
			'ITEM_TYPE_CODE' => $request->input('add_item_type_code'),
			'ITEM_TYPE_DESC' => $request->input('add_item_type_desc'),
		];

		ItemTypeModel::insert($details);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function updateFunction(Request $request)
	{
		$details = [
			'ITEM_TYPE_CODE' => $request->input('edit_item_type_code'),
			'ITEM_TYPE_DESC' => $request->input('edit_item_type_desc'),
		];

		ItemTypeModel::where('ITEM_TYPE_CODE','=',$request->input('get_code'))->update($details);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function deleteFunction(Request $request)
	{
		
		ItemTypeModel::where('ITEM_TYPE_CODE','=',$request->input('code'))->delete();

		Session::flash('success','Deletion Success');

		return back();
	}
}