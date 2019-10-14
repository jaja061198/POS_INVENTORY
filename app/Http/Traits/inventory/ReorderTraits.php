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

trait ReorderTraits
{

	public function indexFunction()
	{
		return view('POS.inventory.reports.reorder_report')
		->with('brand',BrandModel::all())
		->with('type',ItemTypeModel::all());
	}

	public function generateFunction(Request $request)
	{

	}
}