<?php

namespace App\Http\Traits\masterfile;


use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\masterfile\Item as ItemModel;
use App\Models\masterfile\Brand as BrandModel;
use App\Models\masterfile\ItemType as ItemTypeModel;

trait ItemTraits 
{
	public function indexFunction()
	{
		return view('POS.masterfile.item.item')
		->with('brand',BrandModel::all())
		->with('type',ItemTypeModel::all())
		->with('datas',ItemModel::all());
	}

	public function validateCode($CODE)
	{
		$count = ItemModel::where('ITEM_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function validateCodeEdit($CODE,$OLD_CODE)
	{
		$count = ItemModel::where('ITEM_CODE','!=',$OLD_CODE)->where('ITEM_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function getDetails($CODE)
	{
		$details = ItemModel::where('ITEM_CODE','=',$CODE)->first();

		return response()->json($details);

		// return response()->json(['ITEM_CODE' => $details['ITEM_CODE'], 'ITEM_DESC' => $details['ITEM_DESC'], 'STANDARD_COST' => Helper::numberFormat($details['STANDARD_COST']), 'BRAND' => $details['ITEM_BRAND'] , 'ITEM_TYPE' => $details['ITEM_TYPE'] ]);
	}

	public function insertFunction(Request $request)
	{

		if ($request->hasFile('add_item_image')) 
		{

			$extension = Input::file('add_item_image')->getClientOriginalExtension();
            $filename_old = Input::file('add_item_image')->getClientOriginalName();
            $filesize = Input::file('add_item_image')->getClientSize();

            $filename = rand(11111111, 99999999). '.' . $extension;
            $fullPath = $filename;

            $details = [
				'ITEM_CODE' => $request->input('add_item_code'),
				'ITEM_DESC' => $request->input('add_item_desc'),
				'ITEM_BRAND' => $request->input('add_item_brand'),
				'ITEM_TYPE' => $request->input('add_item_type'),
				'MIN_LEVEL' => $request->input('add_min_level'),
				'MAX_LEVEL' => $request->input('add_max_level'),
				'STANDARD_COST' => Helper::removeCommas($request->input('add_item_cost')),
				'STANDARD_PRICE' => Helper::removeCommas($request->input('add_item_price')),
				'IMAGE' => 'img/'.$fullPath,
				'DESCRIPTION' =>  $request->input('add_item_desc2'),
			];

            $request->file('add_item_image')->move(base_path('public/img/'), $filename);

        }

        else

        {
			$details = [
				'ITEM_CODE' => $request->input('add_item_code'),
				'ITEM_DESC' => $request->input('add_item_desc'),
				'ITEM_BRAND' => $request->input('add_item_brand'),
				'ITEM_TYPE' => $request->input('add_item_type'),
				'MIN_LEVEL' => $request->input('add_min_level'),
				'MAX_LEVEL' => $request->input('add_max_level'),
				'STANDARD_COST' => Helper::removeCommas($request->input('add_item_cost')),
				'STANDARD_PRICE' => Helper::removeCommas($request->input('add_item_price')),
			];

		}

		ItemModel::insert($details);


		$window = 'ITEM';

		$action_type = 'ADD';

		$action = 'Added a new item '.$request->input('add_item_code');

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function updateFunction(Request $request)
	{

		if ($request->hasFile('edit_item_img')) 
		{

			$extension = Input::file('edit_item_img')->getClientOriginalExtension();
            $filename_old = Input::file('edit_item_img')->getClientOriginalName();
            $filesize = Input::file('edit_item_img')->getClientSize();

            $filename = rand(11111111, 99999999). '.' . $extension;
            $fullPath = $filename;


			$details = [
				'ITEM_CODE' => $request->input('edit_item_code'),
				'ITEM_DESC' => $request->input('edit_item_desc'),
				'ITEM_BRAND' => $request->input('edit_item_brand'),
				'ITEM_TYPE' => $request->input('edit_item_type'),
				'MIN_LEVEL' => $request->input('edit_min_level'),
				'MAX_LEVEL' => $request->input('edit_max_level'),
				'QUANTITY' => $request->input('edit_quantity'),
				'STANDARD_COST' => Helper::removeCommas($request->input('edit_item_cost')),
				'STANDARD_PRICE' => Helper::removeCommas($request->input('edit_item_price')),
				'IMAGE' => 'img/'.$fullPath,
				'DESCRIPTION' =>  $request->input('edit_item_desc2')
			];

			$request->file('edit_item_img')->move(base_path('public/img/'), $filename);
		}

		else

		{

			$details = [
				'ITEM_CODE' => $request->input('edit_item_code'),
				'ITEM_DESC' => $request->input('edit_item_desc'),
				'ITEM_BRAND' => $request->input('edit_item_brand'),
				'ITEM_TYPE' => $request->input('edit_item_type'),
				'MIN_LEVEL' => $request->input('edit_min_level'),
				'MAX_LEVEL' => $request->input('edit_max_level'),
				'QUANTITY' => $request->input('edit_quantity'),
				'STANDARD_COST' => Helper::removeCommas($request->input('edit_item_cost')),
				'STANDARD_PRICE' => Helper::removeCommas($request->input('edit_item_price')),
				'DESCRIPTION' =>  $request->input('edit_item_desc2')
			];

		}
		
		ItemModel::where('ITEM_CODE','=',$request->input('get_code'))->update($details);

		$window = 'ITEM';

		$action_type = 'ED';

		$action = 'Edited item '.$request->input('edit_service_code');

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function deleteFunction(Request $request)
	{
		
		ItemModel::where('ITEM_CODE','=',$request->input('code'))->delete();

		$window = 'ITEM';

		$action_type = 'DEL';

		$action = 'Deleted ITEM '.$request->input('code');

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Deletion Success');

		return back();
	}

	public function statusFunction($id)
	{
		$detail = ItemModel::where('item_code','=',$id)->first();

		// return $detail;

		if ($detail->STATUS == '1') 
		{
		 	ItemModel::where('item_code','=',$id)->update(['STATUS' => '2']);
		}


		if ($detail->STATUS == '2') 
		{
		 	ItemModel::where('item_code','=',$id)->update(['STATUS' => '1']);
		}

		$window = 'ITEM';

		$action_type = 'ED';

		$action = 'UPDATED ITEM STATUS '.$id;

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Change Status Success');

		return back();
	}
}