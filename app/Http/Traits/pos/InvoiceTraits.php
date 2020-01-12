<?php

namespace App\Http\Traits\pos;


use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\pos\InvoiceHeader as InvoiceHeaderModel;
use App\Models\pos\InvoiceDetail as InvoiceDetailsModel;
use App\Models\masterfile\Item as ItemModel;
use App\Models\masterfile\Service as ServiceModel;

trait InvoiceTraits 
{


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

	public function postInvoice(Request $request)
	{

		// return $request->all();

		if(Helper::removeCommas($request->input('pay_amount')) < Helper::removeCommas($request->input('total_amount2')))
		{
			Session::flash('failed','Cash amount must be greater than or equal to Total Amount');

			return back();
		}

		if($request->input('item_code') == null && $request->input('service_code') == null)
		{
			Session::flash('failed','Please Select the items that you want to Invoice');

			return back();
		}

		$code_holder = $this->generateCode();

		$header = [
			'INVOICE_NO' => $code_holder,
			'CUSTOMER' => $request->input('customer'),
			'DISCOUNT' => Helper::removeCommas($request->input('total_discount')),
			'ADDITIONAL_DISC' => Helper::removeCommas($request->input('additional_discount')),
			'SERVICE_COST' => Helper::removeCommas($request->input('service_amount')),
			'GRAND_TOTAL' => Helper::removeCommas($request->input('total_amount')),
			'GRAND_TOTAL2' => Helper::removeCommas($request->input('total_amount2')),
			'CASH_AMOUNT' => Helper::removeCommas($request->input('pay_amount')),
			'CHANGE' => Helper::removeCommas($request->input('change')),
			'INVOICE_DATE' => Carbon\Carbon::now(),
		];

		InvoiceHeaderModel::insert($header);

		if ($request->input('item_code') != null) 
		{
			# code...
		

			foreach($request->input('item_code') as $key => $value)
			{

				$details = [
					'INVOICE_NO' => $code_holder,
					'LINE_NO' => $key+1,
					'ITEM_CODE' => $request->input('item_code')[$key],
					'PRICE' => Helper::removeCommas($request->input('unit_cost')[$key]),
					'TYPE' => 1,
					'DISCOUNT' => Helper::removeCommas($request->input('discount')[$key]),
					'QUANTITY' => Helper::removeCommas($request->input('quantity')[$key]),
					'TOTAL_PRICE' => Helper::removeCommas($request->input('total_cost')[$key]),
					'INVOICE_DATE' => Carbon\Carbon::now(),
				];

				// var_dump($request->input('get_quantity')[$key] - $request->input('quantity')[$key]);
				InvoiceDetailsModel::insert($details);

				$this->updateQuantity($request->input('item_code')[$key], $request->input('quantity')[$key]);

				// ItemModel::where('ITEM_CODE','=',$request->input('item_code')[$key])->update(['QUANTITY' => ($request->input('get_quantity')[$key] - $request->input('quantity')[$key] )]);

			}

		}


		if ($request->input('service_code') != null) 
		{
			# code...
		

			foreach($request->input('service_code') as $key => $value)
			{

				$details = [
					'INVOICE_NO' => $code_holder,
					'LINE_NO' => 'service_line'.($key+1),
					'ITEM_CODE' => $request->input('service_code')[$key],
					'PRICE' => Helper::removeCommas($request->input('service_cost')[$key]),
					'TYPE' => 2,
					'DISCOUNT' => 0,
					'QUANTITY' => 1,
					'TOTAL_PRICE' => Helper::removeCommas($request->input('service_cost')[$key]),
					'INVOICE_DATE' => Carbon\Carbon::now(),
				];

				// var_dump($request->input('get_quantity')[$key] - $request->input('quantity')[$key]);
				InvoiceDetailsModel::insert($details);

				// $this->updateQuantity($request->input('item_code')[$key], $request->input('quantity')[$key]);

				// ItemModel::where('ITEM_CODE','=',$request->input('item_code')[$key])->update(['QUANTITY' => ($request->input('get_quantity')[$key] - $request->input('quantity')[$key] )]);

			}

		}


		$window = 'INVOICE';

		$action_type = 'INV';

		$action = 'Invoiced item '.$code_holder;

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Transaction '.$code_holder.' success');
		
		return back();

	}


	public function updateQuantity($ITEM_CODE , $QUANTITY)
	{
		$get_item = ItemModel::where('ITEM_CODE','=',$ITEM_CODE)->select('QUANTITY')->first();

		$new_quantity = $get_item->QUANTITY - $QUANTITY;

		ItemModel::where('ITEM_CODE','=',$ITEM_CODE)->update(['QUANTITY' => $new_quantity]);
	}

	public function invoiceListFunction()
	{
		return view('POS.activity.invoice.invoice_list')
		->with('details',InvoiceHeaderModel::orderBy('INVOICE_DATE','DESC')->get());
	}

	public function showFunction($id)
	{
		return view('POS.activity.invoice.invoice_detail')
		->with('header',InvoiceHeaderModel::where('INVOICE_NO','=',$id)->first())
		->with('details',InvoiceDetailsModel::where('INVOICE_NO','=',$id)->get());
	}

	public function serverSideFunction(Request $request)
	{
		$columns = array(
			0 => 'SERVICE_CODE',
			1 => 'SERVICE_DESC',
		);

		$totalData = ServiceModel::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[1];
		$dir  = $request->input('order.1.dir');

	
		if(empty($request->input('search.value')))
		{
			$posts = $this->emptySearch($start, $limit, $order, $dir);

			$totalFiltered = ServiceModel::count();
			// $totalFiltered = ItemModel::count();
		}
		else
		{
			$search = $request->input('search.value');

			$posts = $this->ifNotEmptySearch($search, $limit, $order, $dir, $start);

			
				$totalFiltered = ServiceModel::where('SERVICE_CODE','like',"%{$search}%")
										->orWhere('SERVICE_DESC','like',"%{$search}%")
										->count();
		}

		$data = array();

		if($posts)
		{
			foreach ($posts as $key => $value) 
			{
				$code = Crypt::encrypt($value->SERVICE_CODE);
				$nestedData['SERVICE_CODE'] = $value->SERVICE_CODE;
				$nestedData['SERVICE_DESC'] = $value->SERVICE_DESC;
				$nestedData['STANDARD_COST'] = $value->STANDARD_COST;
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

		return $posts = ServiceModel::limit($LIMIT)
				->offset($START)
				->orderBy($ORDER,$DIR)
				->get();
	}

	public function ifNotEmptySearch($SEARCH, $LIMIT, $ORDER, $DIR, $START)
	{

		return $posts = ServiceModel::where('SERVICE_CODE','like',"%{$SEARCH}%")
						->orWhere('SERVICE_DESC','like',"%{$SEARCH}%")
						->offset($START)
						->limit($LIMIT)
						->orderBy($ORDER,$DIR)
						->get();
	}

	public function populateFunction(Request $request)
	{
		$finder = ServiceModel::where('SERVICE_CODE','=',$request->input('service_code'))->first();

		return response()->json(['datas' => $finder]);
	}

}