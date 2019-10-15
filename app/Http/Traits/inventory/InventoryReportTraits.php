<?php

namespace App\Http\Traits\inventory;

use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Models\masterfile\Item as ItemModel;
use App\Models\masterfile\Brand as BrandModel;
use App\Models\inventory\ReceivingHeader as ReceivingHeaderModel;
use App\Models\inventory\ReceivingDetail as ReceivingDetailModel;
use App\Models\masterfile\ItemType as ItemTypeModel;

trait InventoryReportTraits
{

	public function indexFunction()
	{

		return view('POS.inventory.reports.inventory_value')
		->with('brand',BrandModel::all())
		->with('type',ItemTypeModel::all());
	}

	public function generateFunction(Request $request)
	{

		return view('POS.inventory.reports.inventory_value_report')
		->with('brand',$request->input('brand'))
		->with('type',$request->input('type'));
	}

	public static function getData($brand, $type, $skip, $take)
	{
		$item = ItemModel::query();

		// $item = $item->whereRaw('QUANTITY < MIN_LEVEL');

		if($brand != '_ALL')
		{
			$item = $item->where('ITEM_BRAND','=',$brand);
		}

		if($type != '_ALL')
		{
			$item = $item->where('ITEM_TYPE','=',$type);
		}

		$item = $item->skip($skip)->take($take)->get();

		return $item;
	}


	public static function countData($brand, $type)
	{
		$item = ItemModel::query();

		// $item = $item->whereRaw('QUANTITY < MIN_LEVEL');

		if($brand != '_ALL')
		{
			$item = $item->where('ITEM_BRAND','=',$brand);
		}

		if($type != '_ALL')
		{
			$item = $item->where('ITEM_TYPE','=',$type);
		}

		$item = $item->count();

		return $item;
	}
}