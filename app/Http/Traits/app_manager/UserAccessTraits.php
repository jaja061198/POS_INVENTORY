<?php

namespace App\Http\Traits\app_manager;


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

use App\User as UserModel;
use App\Models\app_manager\WindowAccess as WindowModel;
use App\Models\app_manager\UserAccess as AccessModel;
use App\Models\app_manager\Navigation as NavigationModel;

trait UserAccessTraits
{
	public function indexFunction($id)
	{

	}

	public function windowIndexFunction($id)
	{
		return view('POS.app_manager.user_access.window_access')
    	->with('user',UserModel::where('id','=',$id)->first());
	}

	public function getParentFunction(Request $request)
	{
		$output = '';


		$output.= '<thead>'.
				  '<tr>'.
				  '<td>PARENT NAME</td>'.
				  '<td>VIEW</td>'.
				  '<td>ADD</td>'.
				  '<td>EDIT</td>'.
				  '<td>PRINT</td>'.
				  '<td>SPCL ACCESS</td></tr></thead>';

        // Loop through the items

		foreach ($this->getNavigationItems($request->Input('window_code')) as $key => $value) 
        {

        	if ($value['CHILD'] == 0) 
        	{
        		if ($this->getAccess($request->input('user_id'), $value['NAV_ID']) != NULL) 
        		{
        			$output.='<tr>'.
		        			 '<td>'.$value['NAV_DESCRIPTION'].'<small style="color:green;"> (PARENT)ssd</small></td>'.
		        			 '<input type="hidden" name="nav_update[]" value="'.$value['NAV_ID'].'>'.
		        			 '<td align="center"><input type="checkbox" class="form-check-input"';

		        			 	// if($this->getAccess($request->input('user_id'), $value['NAV_ID'])->VIEW == 1)
		        			 	// {
		        			 	// 	$output.= ' checked';
		        			 	// }	

		        			 $output.='><input type="hidden" name="view_update[]" value="0"></td>';


		        			 $output.='<td align="center"><input type="checkbox" name="add_update[]" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $value['NAV_ID'])->VIEW == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="view_update[]" value="0"></td>';
		        			 
		        			 $output.='<td align="center"><input type="checkbox" name="add_update[]" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $value['NAV_ID'])->ADD == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="add_update[]" value="0"></td>';

		        			 $output.='<td align="center"><input type="checkbox" name="edit_update[]" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $value['NAV_ID'])->EDIT == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="edit_update[]" value="0"></td>';

		        			 $output.='<td align="center"><input type="checkbox" name="print_update[]" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $value['NAV_ID'])->PRINT == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="print_update[]" value="0"></td>';

		        			 $output.='<td align="center"><input type="checkbox" name="spcl_update[]" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $value['NAV_ID'])->SPCL_ACCESS == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="spcl_update[]" value="0"></td></tr>';
        		}

        		else

        		{
        			$output.='<tr>'.
		        			 '<td>'.$value['NAV_DESCRIPTION'].'<small style="color:green;"> (PARENT)</small></td>'.
		        			 '<input type="hidden" name="nav_add[]" value="'.$value['NAV_ID'].'">'.
		        			 '<td align="center"><input type="checkbox" name="view_add[]" class="form-check-input" value="1"><input type="hidden" name="view_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="checkbox" name="insert_add[]" class="form-check-input" value="1"><input type="hidden" name="insert_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="checkbox" name="edit_add[]" class="form-check-input" value="1"><input type="hidden" name="edit_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="checkbox" name="print_add[]" class="form-check-input" value="1"><input type="hidden" name="print_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="checkbox" name="spcl_add[]" class="form-check-input" value="1"><input type="hidden" name="spcl_add[]" value="0" class="form-check-input"></td></tr>';
        		}
        	}

        	else

        	{
        		if ($this->getAccess($request->input('user_id'), $value['NAV_ID']) != NULL) 
        		{
        			$output.='<tr>'.
		        			 '<td>'.$value['NAV_DESCRIPTION'].'<small style="color:green;"> (PARENT)</small></td>'.
		        			 '<input type="hidden" name="nav_update[]" value="'.$value['NAV_ID'].'">';
		        			 
		        			 $output.='<td align="center"><input type="checkbox" name="view_update[]" value="1" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $value['NAV_ID'])->VIEW == 1)
		        			 	{
		        			 		$output.= ' checked';
		        			 	}	

		        			 $output.='><input type="hidden" name="view_update[]" value="0"></td>';
		        			 $output.='<td align="center"><input type="hidden" name="add_update[]" class="form-check-input" value="0"></td>'.
		        			 '<td align="center"><input type="hidden" name="edit_update[]" class="form-check-input" value="0"></td>'.
		        			 '<td align="center"><input type="hidden" name="print_update[]" class="form-check-input" value="0"></td>'.
		        			 '<td align="center"><input type="hidden" name="spcl_update[]" class="form-check-input" value="0"></td></tr>';
        		}

        		else

        		{
        			$output.='<tr>'.
		        			 '<td>'.$value['NAV_DESCRIPTION'].'<small style="color:green;"> (PARENT)</small></td>'.
		        			 '<input type="hidden" name="nav_add[]" value="'.$value['NAV_ID'].'">'.
		        			 '<td align="center"><input type="checkbox" name="view_add[]" value="1" class="form-check-input"><input type="hidden" name="view_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="hidden" name="insert_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="hidden" name="edit_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="hidden" name="print_add[]" value="0" class="form-check-input"></td>'.
		        			 '<td align="center"><input type="hidden" name="spcl_add[]" value="0" class="form-check-input"></td></tr>';
        		}

        		if ($this->getCategoryItems($value['NAV_ID']) != null) 
        		{
        			// Get Category Items
        			foreach ($this->getCategoryItems($value['NAV_ID']) as $category_key => $category_value) 
		        	{	

		        		if($this->getAccess($request->input('user_id'), $category_value['NAV_ID']) != null)
        				{
        					$output.='<tr>'.
				        			 '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$category_value['NAV_DESCRIPTION'].'<small style="color:red;"> (CATEGORY)</small></td>'.
				        			 '<input type="hidden" name="nav_update[]" value="'.$category_value['NAV_ID'].'">'.
				        			 '<td align="center"><input type="checkbox" name="view_update[]" value="1" class="form-check-input"';

	        			 	if($this->getAccess($request->input('user_id'), $category_value['NAV_ID'])->VIEW == 1)
	        			 	{
	        			 		$output.= ' checked ';
	        			 	}	

		        			 $output.='><input type="hidden" name="view_update[]" value="0"></td>';
		        			 
		        			 $output.='<td align="center"><input type="checkbox" name="add_update[]" value="1" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $category_value['NAV_ID'])->ADD == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="add_update[]" value="0"></td>';

		        			 $output.='<td align="center"><input type="checkbox" name="edit_update[]" value="1" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $category_value['NAV_ID'])->EDIT == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="edit_update[]" value="0"></td>';

		        			 $output.='<td align="center"><input type="checkbox" name="print_update[]" value="1" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $category_value['NAV_ID'])->PRINT == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="print_update[]" value="0"></td>';

		        			 $output.='<td align="center"><input type="checkbox" name="spcl_update[]" value="1" class="form-check-input"';

		        			 	if($this->getAccess($request->input('user_id'), $category_value['NAV_ID'])->SPCL_ACCESS == 1)
		        			 	{
		        			 		$output.= ' checked ';
		        			 	}	

		        			 $output.='><input type="hidden" name="spcl_update[]" value="0"></td></tr>';

        				}

        				else

        				{
        					$output.='<tr>'.
				        			 '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$category_value['NAV_DESCRIPTION'].'<small style="color:red;"> (CATEGORY)</small></td>'.
				        			 '<input type="hidden" name="nav_add[]" value="'.$category_value['NAV_ID'].'">'.
				        			 '<td align="center"><input type="checkbox" name="view_add[]" class="form-check-input" value="1"><input type="hidden" name="view_add[]" value="0" class="form-check-input"></td>'.
				        			 '<td align="center"><input type="checkbox" name="insert_add[]" class="form-check-input" value="1"><input type="hidden" name="insert_add[]" value="0" class="form-check-input"></td>'.
				        			 '<td align="center"><input type="checkbox" name="edit_add[]" class="form-check-input" value="1"><input type="hidden" name="edit_add[]" value="0" class="form-check-input"></td>'.
				        			 '<td align="center"><input type="checkbox" name="print_add[]" class="form-check-input" value="1"><input type="hidden" name="print_add[]" value="0" class="form-check-input"></td>'.
				        			 '<td align="center"><input type="checkbox" name="spcl_add[]" class="form-check-input" value="1"><input type="hidden" name="spcl_add[]" value="0" class="form-check-input"></td></tr>';
        				}

		        	}

        		}
        	}
       	}

		 return response($output);
	}

	//WINDOW ACCESS

	public function getNavigationItems($WINDOW_CLASS)
	{
		$items = NavigationModel::where('WINDOW_CLASS','=',$WINDOW_CLASS)->where('WINDOW_TYPE','=','M')->get();

		return $items;
	}


	public function getCategoryItems($NAV_ID)
	{
		$items = NavigationModel::where('PARENT','=',$NAV_ID)->get();

		return $items;
	}

	public function getAccess($USER_ID,$NAV_ID)
	{
		$details = WindowModel::where('USER_ID','=',$USER_ID)->where('NAV_ID','=',$NAV_ID)->first();

		return $details;
	}

	public function parentCount($USER_ID,$NAV_ID)
	{
		$details = WindowModel::where('USER_ID','=',$USER_ID)->where('NAV_ID','=',$NAV_ID)->count();

		return $details;
	}

	public function getType($NAV_ID)
	{
		$details = NavigationModel::where('NAV_ID','=',$NAV_ID)->select(['WINDOW_TYPE','CHILD'])->first();

		return $details;
	}

	public function updateFunction(Request $request)
	{
		$new_navigations = $request->input('nav_add');

		// return $request->all();
		$cnt = 0;

		// return $request->all();

		if($new_navigations != NULL)
		{
			foreach ($new_navigations as $key => $value) {
				
				// $accessdetails = [
				// 	'USER_ID' => $request->input('user_id'),
				// 	'NAV_ID' => $request->input('nav_add')[$key],
				// 	'VIEW' => Helper::getCheckBoxValue($request->input('view_add')[$key]),
				// 	'ADD' => Helper::getCheckBoxValue($request->input('insert_add')[$key]),
				// 	'EDIT' => Helper::getCheckBoxValue($request->input('edit_add')[$key]),
				// 	'PRINT' => Helper::getCheckBoxValue($request->input('print_add')[$key]),
				// 	'SPCL_ACCESS' => Helper::getCheckBoxValue($request->input('spcl_add')[$key]),
				// ];

				if ($this->getType($request->input('nav_add')[$key])['WINDOW_TYPE'] == 'M' && $this->getType($request->input('nav_add')[$key])['CHILD'] == 1) 
				{
					$accessdetails = [
						'USER_ID' => $request->input('user_id'),
						'NAV_ID' => $request->input('nav_add')[$key],
						'VIEW' => Helper::getCheckBoxValue($request->input('view_add'))[$key],
					];
				}

				if ($this->getType($request->input('nav_add')[$key])['WINDOW_TYPE'] == 'M' && $this->getType($request->input('nav_add')[$key])['CHILD'] == 0) 
				{
					$accessdetails = [
						'USER_ID' => $request->input('user_id'),
						'NAV_ID' => $request->input('nav_add')[$key],
						'VIEW' => Helper::getCheckBoxValue($request->input('view_add'))[$key],
						'ADD' => Helper::getCheckBoxValue($request->input('insert_add'))[$key],
						'EDIT' => Helper::getCheckBoxValue($request->input('edit_add'))[$key],
						'PRINT' => Helper::getCheckBoxValue($request->input('print_add'))[$key],
						'SPCL_ACCESS' => Helper::getCheckBoxValue($request->input('spcl_add'))[$key],
					];
				}

				if ($this->getType($request->input('nav_add')[$key])['WINDOW_TYPE'] == 'SC') 
				{
					$accessdetails = [
						'USER_ID' => $request->input('user_id'),
						'NAV_ID' => $request->input('nav_add')[$key],
						'VIEW' => Helper::getCheckBoxValue($request->input('view_add'))[$key],
						'ADD' => Helper::getCheckBoxValue($request->input('insert_add'))[$key],
						'EDIT' => Helper::getCheckBoxValue($request->input('edit_add'))[$key],
						'PRINT' => Helper::getCheckBoxValue($request->input('print_add'))[$key],
						'SPCL_ACCESS' => Helper::getCheckBoxValue($request->input('spcl_add'))[$key],
					];
				}
				WindowModel::insert($accessdetails);

			}
			// return response()->json($accessdetails);
			 

		}

		// return $accessdetails;

		$existing_navigations = $request->input('nav_update');

		if ($existing_navigations != NULL) 
		{
			foreach ($existing_navigations as $key => $value) 
			{

				if ($this->getType($request->input('nav_update')[$key])['WINDOW_TYPE'] == 'M' && $this->getType($request->input('nav_update')[$key])['CHILD'] == 1)
				{
					$accessdetails = [
						// 'USER_ID' => $request->input('user_id'),
						// 'NAV_ID' => $request->input('nav_update')[$key],
						'VIEW' => Helper::getCheckBoxValue($request->input('view_update'))[$key],
					];
				}

				if ($this->getType($request->input('nav_update')[$key])['WINDOW_TYPE'] == 'M' && $this->getType($request->input('nav_update')[$key])['CHILD'] == 0) 
				{
					$accessdetails = [
						// 'USER_ID' => $request->input('user_id'),
						// 'NAV_ID' => $request->input('nav_update')[$key],
						'VIEW' => Helper::getCheckBoxValue($request->input('view_update'))[$key],
						'ADD' => Helper::getCheckBoxValue($request->input('add_update'))[$key],
						'EDIT' => Helper::getCheckBoxValue($request->input('edit_update'))[$key],
						'PRINT' => Helper::getCheckBoxValue($request->input('print_update'))[$key],
						'SPCL_ACCESS' => Helper::getCheckBoxValue($request->input('spcl_update'))[$key],
					];
				}

				if ($this->getType($request->input('nav_update')[$key])['WINDOW_TYPE'] == 'SC') 
				{
					$accessdetails = [
						// 'USER_ID' => $request->input('user_id'),
						// 'NAV_ID' => $request->input('nav_update')[$key],
						'VIEW' => Helper::getCheckBoxValue($request->input('view_update'))[$key],
						'ADD' => Helper::getCheckBoxValue($request->input('add_update'))[$key],
						'EDIT' => Helper::getCheckBoxValue($request->input('edit_update'))[$key],
						'PRINT' => Helper::getCheckBoxValue($request->input('print_update'))[$key],
						'SPCL_ACCESS' => Helper::getCheckBoxValue($request->input('spcl_update'))[$key],
					];
				}


				WindowModel::where('NAV_ID','=',$request->input('nav_update')[$key])->where('USER_ID','=',$request->input('user_id'))
					   ->update($accessdetails);
			}


			
		}

		Session::flash('success','Window Access Succesfully updated');

		return back();
	}	

	//END OF WINDOW ACCESS
	

	

}