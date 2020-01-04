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

use App\Models\masterfile\Service as ServiceModel;

trait ServiceTraits 
{
	public function indexFunction()
	{
		return view('POS.masterfile.service.service')
		->with('datas',ServiceModel::all());
	}

	public function validateCode($CODE)
	{
		$count = ServiceModel::where('SERVICE_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function validateCodeEdit($CODE,$OLD_CODE)
	{
		$count = ServiceModel::where('SERVICE_CODE','!=',$OLD_CODE)->where('SERVICE_CODE','=',$CODE)->count();

		return response()->json(['counter' => $count]);
	}

	public function getDetails($CODE)
	{
		$details = ServiceModel::where('SERVICE_CODE','=',$CODE)->first();

		return response()->json(['SERVICE_CODE' => $details['SERVICE_CODE'], 'SERVICE_DESC' => $details['SERVICE_DESC'], 'STANDARD_COST' => Helper::numberFormat($details['STANDARD_COST']) ]);
	}

	public function insertFunction(Request $request)
	{
		$details = [
			'SERVICE_CODE' => $request->input('add_service_code'),
			'SERVICE_DESC' => $request->input('add_service_desc'),
			'STANDARD_COST' => Helper::removeCommas($request->input('add_service_cost')),
		];

		ServiceModel::insert($details);

		$window = 'SERVICES';

		$action_type = 'ADD';

		$action = 'Added a new service '.$request->input('add_service_code');

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function updateFunction(Request $request)
	{
		$details = [
			'SERVICE_CODE' => $request->input('edit_service_code'),
			'SERVICE_DESC' => $request->input('edit_service_desc'),
		];

		ServiceModel::where('SERVICE_CODE','=',$request->input('get_code'))->update($details);

		$window = 'SERVICES';

		$action_type = 'ED';

		$action = 'Edited a Service '.$request->input('edit_service_code');

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Insert Success');

		return bacK();
	}

	public function deleteFunction(Request $request)
	{
		
		ServiceModel::where('SERVICE_CODE','=',$request->input('code'))->delete();

		$window = 'ITEM';

		$action_type = 'DEL';

		$action = 'Deleted SERVICES '.$request->input('code');

		Helper::putTrail(Auth::user()->id,$window,$action_type,$action);

		Session::flash('success','Deletion Success');

		return back();
	}
}