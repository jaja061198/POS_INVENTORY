<?php

namespace App\Http\Traits\inventory;

use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Models\masterfile\Item as ItemModel;
use App\Models\masterfile\Brand as BrandModel;
use App\Models\inventory\ReceivingHeader as ReceivingHeaderModel;
use App\Models\inventory\ReceivingDetail as ReceivingDetailModel;

trait ReceivingTraits
{
	// public function test()
	// {
	// 	$data = ItemModel::with('getType')->get();

	// 	return $data;

	// 	foreach ($data as $key => $value) {
	// 		return $value->getBrand['BRAND_DESC'];
	// 	}
		
	// }

	public function generateCode()
	{
		$data_count = ReceivingHeaderModel::count();

		if ($data_count == 0) 
		{
			$slots = "00000";

			$generated_code = 'RC00000';

			return $generated_code;
		}

		$slots = "00000";

		$padding = strlen($slots) - $data_count;

		$padded_code = substr($slots, -( 5 - strlen($data_count)));

		if(strlen($data_count) >= 5)
		{
			$generated_code = 'RC'.$data_count;

			return $generated_code;
		}

		$generated_code = 'RC'.$padded_code.$data_count;

		return $generated_code;
	}


	public function serversideFunction(Request $request)
	{
		// print_r($request->all());
		
		$columns = array(
			0 => 'ITEM_CODE',
			1 => 'ITEM_DESC',
			2 => 'ITEM_BRAND',
		);

		$totalData = ItemModel::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[1];
		$dir  = $request->input('order.1.dir');

	
		if(empty($request->input('search.value')))
		{
			$posts = $this->emptySearch($start, $limit, $order, $dir);

			$totalFiltered = ItemModel::count();
			// $totalFiltered = ItemModel::count();
		}
		else
		{
			$search = $request->input('search.value');

			$posts = $this->ifNotEmptySearch($search, $limit, $order, $dir);

			
				$totalFiltered = ItemModel::where('item_code','like',"%{$search}%")
										->orWhere('ITEM_DESC','like',"%{$search}%")
										->count();
		}

		$data = array();

		if($posts)
		{
			foreach ($posts as $key => $value) 
			{
				$code = Crypt::encrypt($value->item_code);
				$nestedData['ITEM_CODE'] = $value->ITEM_CODE;
				$nestedData['ITEM_DESC'] = $value->ITEM_DESC;
				$nestedData['ITEM_BRAND'] = $value->getBrand['BRAND_DESC'].'<input type="hidden" id="cost'.$key.'" value="'.$value->STANDARD_COST.'">';
				$nestedData['ITEM_TYPE'] = $value->getType['ITEM_TYPE_DESC'];
				$nestedData['action'] = '';

				$nestedData['action'] .= 'a href="#';
				$nestedData['action'] .= '"style="font-size: 12px;" data-toggle="modal" class="btn btn-success btn-xs" onclick="editUser(this)"><i class="fa fa-download"></i> Select</a> 
				';

				$data[] = $nestedData;
			} 	
		}

		$json_data = array(
			"draw" => intVal($request->input('draw')),
			"recordsTotal" => intVal($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($json_data);
	}

	public function emptySearch($START, $LIMIT , $ORDER , $DIR)
	{

		return $posts = ItemModel::limit($LIMIT)
				->orderBy($ORDER,$DIR)
				->get();
	}

	public function ifNotEmptySearch($SEARCH, $LIMIT, $ORDER, $DIR)
	{

		return $posts = ItemModel::where('ITEM_CODE','like',"%{$SEARCH}%")
						->orWhere('ITEM_DESC','like',"%{$SEARCH}%")
						->limit($LIMIT)
						->orderBy($ORDER,$DIR)
						->get();
	}


	public function populateFunction(Request $request)
	{
		$finder = ItemModel::where('ITEM_CODE','=',$request->input('item_code'))->first();

		return response()->json(['datas' => $finder]);
	}

	public function receiveFunction(Request $request)
	{
		if ($request->input('item_code') != null) 
		{
			# code...

			$header = [
				'RR_CODE' => $request->input('rr_code'),
				'RR_DATE' => $request->input('rr_date'),
				'REMARKS' => $request->input('remarks'),
			];

			ReceivingHeaderModel::insert($header);

			foreach ($request->input('item_code') as $key => $value) {
				# code...
				
				$details = [
					'RR_CODE' => $request->input('rr_code'),
					'ITEM_CODE' => $request->input('get_code')[$key],
					'LINE_NO' => $key+1,
					'QUANTITY' => $request->input('quantity')[$key],
				];

				ReceivingDetailModel::insert($details);

				$this->updateQuantity($request->input('get_code')[$key], $request->input('quantity')[$key]);
				//Update The quantity in mastefile
			}



			$window = 'RECEIVING';

			$action_type = 'REC';

			$action = 'Received item '.$request->input('rr_code');

			Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

			Session::flash('success','Transaction Success');

			return back();
		}

		else

		{
			Session::flash('failed','Please Select the items that you want to receive');

			return back();
		}
	}

	public function updateQuantity($ITEM_CODE , $QUANTITY)
	{
		$get_item = ItemModel::where('ITEM_CODE','=',$ITEM_CODE)->select('QUANTITY')->first();

		$new_quantity = $get_item->QUANTITY + $QUANTITY;

		ItemModel::where('ITEM_CODE','=',$ITEM_CODE)->update(['QUANTITY' => $new_quantity]);
	}

	public function indexListFunction()
	{
		return view('POS.inventory.receiving.receiving_list')
		->with('details',ReceivingHeaderModel::orderBy('RR_DATE','DESC')->get());
	}

	public function showFunction($id)
	{	
		// return ReceivingHeaderModel::with('getDetails')->where('RR_CODE','=',$id)->first();
		return view('POS.inventory.receiving.receiving_info')
		->with('data',ReceivingHeaderModel::with('getDetails')->where('RR_CODE','=',$id)->first());
	}

}