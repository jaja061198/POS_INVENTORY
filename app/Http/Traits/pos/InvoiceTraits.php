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

		if(Helper::removeCommas($request->input('pay_amount')) <= Helper::removeCommas($request->input('total_amount2')))
		{
			Session::flash('failed','Cash amount must be greater than or equal to Total Amount');

			return back();
		}

		if($request->input('item_code') == null)
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
			'GRAND_TOTAL' => Helper::removeCommas($request->input('total_amount')),
			'GRAND_TOTAL2' => Helper::removeCommas($request->input('total_amount2')),
			'CASH_AMOUNT' => Helper::removeCommas($request->input('pay_amount')),
			'CHANGE' => Helper::removeCommas($request->input('change')),
		];

		InvoiceHeaderModel::insert($header);

		foreach($request->input('item_code') as $key => $value)
		{

			$details = [
				'INVOICE_NO' => $code_holder,
				'LINE_NO' => $key+1,
				'ITEM_CODE' => $request->input('item_code')[$key],
				'PRICE' => Helper::removeCommas($request->input('unit_cost')[$key]),
				'DISCOUNT' => Helper::removeCommas($request->input('discount')[$key]),
				'QUANTITY' => Helper::removeCommas($request->input('quantity')[$key]),
				'TOTAL_PRICE' => Helper::removeCommas($request->input('total_cost')[$key]),
			];

			// var_dump($request->input('get_quantity')[$key] - $request->input('quantity')[$key]);
			InvoiceDetailsModel::insert($details);

			$this->updateQuantity($request->input('item_code')[$key], $request->input('quantity')[$key]);

			// ItemModel::where('ITEM_CODE','=',$request->input('item_code')[$key])->update(['QUANTITY' => ($request->input('get_quantity')[$key] - $request->input('quantity')[$key] )]);

		}

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

}