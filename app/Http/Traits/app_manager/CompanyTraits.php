<?php

namespace App\Http\Traits\app_manager;


use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\app_manager\Company as CompanyModel;

trait CompanyTraits
{
	public function companyDetails()
	{
		return view('POS.app_manager.company.company')
		->with('company',CompanyModel::first());
	}

	public function updateFunction(Request $request)
	{
		
		if($request->input('logo') == NULL)
		{
			$details = [
				'COMPANY_NAME' => $request->input('company'),
				'ADDRESS' => $request->input('address'),
				'ZIP_CODE' => $request->input('zip'),
				'TIN_NO' => $request->input('tin'),
				'PHONE_NO' => $request->input('phone'),
				'FAX' => $request->input('fax'),
				'WEBSITE' => $request->input('website'),
			];

		}

		else

		{
			$details = [
				'COMPANY_NAME' => $request->input('company'),
				'ADDRESS' => $request->input('address'),
				'ZIP_CODE' => $request->input('zip'),
				'TIN_NO' => $request->input('tin'),
				'PHONE_NO' => $request->input('phone'),
				'FAX' => $request->input('fax'),
				'WEBSITE' => $request->input('website'),
				'LOGO' => $request->input('logo'),
			];

		}

		CompanyModel::where('id','=',$request->input('get_id'))->update($details);

		Session::flash('success','Company details updated successfully');

		return back();
	}
}