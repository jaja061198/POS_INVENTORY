<?php

namespace App\Http\Traits\app_manager;


use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use App\User as UserModel;;

trait UserTraits
{
	public function viewUsersFunction()
	{
		
		return view('POS.app_manager.user.user')
		->with('company',UserModel::getUsers());
	}


	/**
	 * Server Side Retrieving Via Datatable thru AJAX Request
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function serversideFunction(Request $request)
	{
		// print_r($request->all());
		$edit_link = '/crm/tbl_maintenance/editArea/';

		$password_reset = '/applicationsetting/user/resetpassword/';

		$window_access = '/applicationsetting/windowaccess/';

		$columns = array(
			0 => 'username',
			1 => 'name',
			2 => 'level',
		);
		if(Auth::user()->user_level == 1)
		{
			$totalData = UserModel::where('user_level','!=',0)->count();
		}
		else
		{
			$totalData = UserModel::count();
		}
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[0];
		$dir  = $request->input('order.0.dir');

		

		if(empty($request->input('search.value')))
		{
			$posts = $this->emptySearch($start, $limit, $order, $dir);

			if(Auth::user()->user_level == 1)
			{
				$totalFiltered = UserModel::where('user_level','!=',0)->count();
			}
			else
			{
				$totalFiltered = UserModel::count();
			}
			// $totalFiltered = UserModel::count();
		}
		else
		{
			$search = $request->input('search.value');

			$posts = $this->ifNotEmptySearch($search, $limit, $order, $dir);

			
			if(Auth::user()->user_level == 1)
			{
				$totalFiltered = UserModel::where('user_level','!=',0)
										->where('username','like',"%{$search}%")
										->orWhere('name','like',"%{$search}%")
										->count();
			}
			else
			{
				$totalFiltered = UserModel::where('username','like',"%{$search}%")
										->orWhere('name','like',"%{$search}%")
										->count();
			}
		}

		$data = array();

		if($posts)
		{
			foreach ($posts as $key => $value) 
			{
				if($value->user_level == 0) { $level = 'Super Admin' ; } 
				if ($value->user_level == 1){ $level = 'Admin'; }
				if ($value->user_level == 3){ $level = 'Ordinary'; }
				if ($value->user_level == 4){ $level = 'Customer'; }
				$code = Crypt::encrypt($value->username);
				$nestedData['username'] = $value->username;
				$nestedData['name'] = $value->name;
				$nestedData['level'] = $level;
				$nestedData['action'] = '';

				$nestedData['action'] .= '<a href="#';
				$nestedData['action'] .= '"style="font-size: 12px;" data-target="#exampleModal2" data-toggle="modal" class="btn btn-primary btn-xs" onclick="editUser(this)" data-attr1="'.$value->name.'" data-attr2="'.$value->username.'" data-attr3="'.$value->password.'" data-attr4="'.$value->email.'" data-attr5="'.$value->user_level.'"><i class="fa fa-edit"></i></a> 
				';

				$nestedData['action'] .= '<a href="#';
				$nestedData['action'] .= '"style="font-size: 12px;" data-toggle="tooltip" data-placement="top" title="Make Inactive" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></a> 
				';

				$nestedData['action'] .= '<a href="'.$password_reset.$value->id;
				$nestedData['action'] .= '"style="font-size: 12px;" data-toggle="tooltip" data-placement="top" title="Reset Password" class="btn btn-warning btn-xs"><i class="fa fa-unlock"></i></a> 
				';


				$nestedData['action'] .= '<a href="'.$window_access.$value->id;

	            $nestedData['action'] .= '" class="btn btn-success btn-xs btn-delete"';

	            $nestedData['action'].= 'data-id="'.$value['username'].'" data-id2="'.$value['name'].'"';
	            $nestedData['action'].= 'style="color: #F00; font-size: 12px;color:white;" data-toggle="tooltip" data-placement="top"';
	            $nestedData['action'].= 'title="Edit User Access '.$value['username'].'"><i class="fa fa-asterisk"></i></a>';

             //    $nestedData['action'] .= ' <a href="javascript:void(0)"';

	            // $nestedData['action'] .= 'class="btn btn-success btn-xs btn-delete"';

	            // $nestedData['action'].= 'data-id="'.$value['username'].'" data-id2="'.$value['name'].'"';
	            // $nestedData['action'].= 'style="color: #F00; font-size: 12px;color:white;" data-toggle="tooltip" data-placement="top"';
	            // $nestedData['action'].= 'title="Edit Access '.$value['username'].'" onclick="deleteRow(this)"><i class="fa fa-key"></i></a>';

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
		if(Auth::user()->user_level == 1)
		{
			return $posts = UserModel::where('user_level','!=',0)
					->where('user_level','!=',4)
					->limit($LIMIT)
					->orderBy($ORDER,$DIR)
					->get();
		}
		else
		{
			return $posts = UserModel::where('user_level','!=',4)
					->limit($LIMIT)
					->orderBy($ORDER,$DIR)
					->get();
		}


	}

	public function ifNotEmptySearch($SEARCH, $LIMIT, $ORDER, $DIR)
	{
		if(Auth::user()->user_level == 1)
		{
			return $posts = UserModel::where('user_level','!=',4)
							->where('user_level','!=',0)
							->where('username','like',"%{$SEARCH}%")
							->orWhere('user_level','!=',4)
							->where('user_level','!=',0)
							->Where('name','like',"%{$SEARCH}%")
							->limit($LIMIT)
							->orderBy($ORDER,$DIR)
							->get();
		}
		else
		{
			return $posts = UserModel::where('user_level','!=',4)
						->where('username','like',"%{$SEARCH}%")
						->orWhere('user_level','!=',4)
						->Where('name','like',"%{$SEARCH}%")
						->limit($LIMIT)
						->orderBy($ORDER,$DIR)
						->get();
		}
	}


	/**
	 * Password Resets
	 */

	public function resetFunction($id)
	{
		$password = [
			'password' => Hash::make('1'),
		];

		UserModel::where('id','=',$id)->update($password);

		Session::flash('success','Password Reset Success');

		return back();
	}

	public function updateFunction(Request $request)
	{
		$details = [
			'name' => $request->input('fullname'),
			'email' => $request->input('email'),
			'user_level' => $request->input('user_level'),
		];

		Session::flash('success','User updated successfully');

		return back();
	}

	public function newEmail(Request $request)
	{
		$counter = UserModel::where('email','=',$request->input('email'))->count();

		return response()->json(['counter' => $counter]);
	}

	public function newUsername(Request $request)
	{
		$counter = UserModel::where('username','=',$request->input('username'))->count();

		return response()->json(['counter' => $counter]);
	}

	public function insertFunction(Request $request)
	{

		$counter1 = UserModel::where('username','=',$request->input('username'))->count();

		$counter2 = UserModel::where('email','=',$request->input('email'))->count();

		if ($counter1 > 0) 
		{
			Session::flash('failed','Username Already Exist');
			return back();
		}

		if ($counter2 > 0) 
		{
			Session::flash('failed','Email Already Exist');

			return back();
		}


		$data = [
			'name' => $request->input('fullname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_level' => $request->input('user_level'),
		];

		UserModel::insert($data);
		Session::flash('success','User successfully added');
		return back();
	}


}