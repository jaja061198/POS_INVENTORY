<?php

namespace App\Http\Controllers\app_manager;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\app_manager\CompanyTraits;
use App\User as UserModel;
use App\Models\app_manager\AuditTrail as AuditTrailModel;

class AuditTrailController extends Controller
{
    //
    public function index()
    {
    	return view('POS.app_manager.audit_trail.audit_trans')
        ->with('users',UserModel::where('user_level','!=',3)->get());
    }

    public function trailResult(Request $request)
    {
        return view('POS.app_manager.audit_trail.audit_trail_result')
        ->with('user',$request->input('user'))
        ->with('type',$request->input('type'));
    }

    public static function getData($user, $type, $skip, $take)
    {
        $data = AuditTrailModel::query();

        if($user != '_ALL')
        {
            $data = $data->where('user_id','=',$user);
        }

        if($type != '_ALL')
        {
            $data = $data->where('action_type','=',$type);
        }

        $data = $data->skip($skip)->take($take)->orderBy('date','DESC')->get();

        $final_data  = [];

        foreach ($data as $key => $value) 
        {
           $final_data[] = [
                'user_id' => $value['user_id'],
                'name' => Helper::getUserInfo($value['user_id'])->name,
                'window' => $value['window'],
                'action' => $value['action_type'],
                'desc' => $value['action'],
                'date' => $value['date'],
           ];
        }

        return $final_data;
    }


    public static function dataCount($user, $type)
    {
        $data = AuditTrailModel::query();

        if($user != '_ALL')
        {
            $data = $data->where('user_id','=',$user);
        }

        if($type != '_ALL')
        {
            $data = $data->where('action_type','=',$type);
        }

        $data = $data->count();

        return $data;
    }


}
