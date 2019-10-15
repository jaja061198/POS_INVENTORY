<?php


namespace App\Http\Traits\pos;

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
use App\Models\pos\InvoiceHeader as InvoiceHeaderModel;
use App\Models\pos\InvoiceDetail as InvoiceDetailsModel;
use App\Models\masterfile\ItemType as ItemTypeModel;

trait InvoiceReportTraits
{

	public function indexFunction()
	{

		return view('POS.pos.reports.selling_report')
		->with('brand',BrandModel::all())
		->with('type',ItemTypeModel::all());
	}


	function top_selling($unsorted, $column) 
	{ 
		$sorted = $unsorted; 

		for ($i=0; $i < sizeof($sorted)-1; $i++) 
		{ 
			  for ($j=0; $j<sizeof($sorted)-1-$i; $j++) 

			  {

				    if ($sorted[$j][$column] < $sorted[$j+1][$column]) 
				    { 
				      $tmp = $sorted[$j]; 
				      $sorted[$j] = $sorted[$j+1]; 
				      $sorted[$j+1] = $tmp; 
				  	} 

			  }
		} 
		return $sorted; 
	} 

	public function generateFunction(Request $request)
	{

		

		// return $this->top_selling($data,'COUNT');

		return view('POS.pos.reports.selling_report_result')
		->with('brand',$request->input('brand'))
		->with('date_sort',$request->input('month_range'))
		->with('sorting',$request->input('sort'))
		->with('type',$request->input('type'));
	}

	public static function getData($brand, $type, $skip, $take, $sorting = null, $month = null)
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


		$data = [];
		foreach ($item as $key => $value) {
			$data[] = [
				'ITEM_CODE' => $value['ITEM_CODE'],
				'ITEM_DESC' => $value['ITEM_DESC'],
				'ITEM_BRAND' => $value->getBrand['BRAND_DESC'],
				'ITEM_TYPE' => $value->getType['ITEM_TYPE_DESC'],
				'COUNT' => InvoiceDetailsModel::whereYear('INVOICE_DATE',date('y',strtotime($month)))->whereMonth('INVOICE_DATE',date('m',strtotime($month)))->where('ITEM_CODE','=',$value['ITEM_CODE'])->orderBy(DB::raw('SUM(QUANTITY) ASC'))->sum('QUANTITY'),
			];
		}

		return $this->top_selling($data,'COUNT');
	}


	public static function countData($brand, $type , $sorting = null , $month = null)
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