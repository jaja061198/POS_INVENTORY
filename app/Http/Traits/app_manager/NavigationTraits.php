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

use App\Models\app_manager\Icons as IconModel;
use App\Models\app_manager\Navigation as NavigationModel;

trait NavigationTraits
{
	public function showParent()
	{
		return view('POS.app_manager.navigation.navigation')
		->with('icons',IconModel::all())
		->with('navigation',NavigationModel::where('WINDOW_TYPE','=','M')->orderBy('WINDOW_CLASS','ASC')->orderBy('ORDER','ASC')->get());
	}

	public function postParentFunction(Request $request)
	{
		if ($request->input('nav_desc')) 
		{
			/**
			 * Update the existing navigations
			 */
			
			foreach ($request->input('nav_desc') as $key => $value) 
			{
				$update_navigations = [
					'NAV_ID' => $request->input('window_code')[$key],
					'WINDOW_CLASS' => $request->input('window_class')[$key],
					'NAV_DESCRIPTION' => $request->input('nav_desc')[$key],
					'ICON' => $request->input('icon')[$key],
					'WINDOW_TYPE' => 'M',
					'WINDOW_CLASS' => $request->input('window_class')[$key],
					'PARENT' => 0,
					'CHILD' => $request->input('with_child')[$key],
					'ROUTE' => $request->input('route')[$key],
					'ORDER' => $request->input('order')[$key],
				];

				NavigationModel::where('NAV_ID','=',$request->input('nav_id')[$key])->update($update_navigations);
			}
		}

		if ($request->input('desc_add')) 
		{
			/**
			 * Insert the new navigations item
			 */
			
			foreach ($request->input('desc_add') as $key => $value) {

				$insert_navigations = [
					'NAV_ID' => $request->input('code_add')[$key],
					'NAV_DESCRIPTION' => $request->input('window_class_add')[$key],
					'NAV_DESCRIPTION' => $request->input('desc_add')[$key],
					'ICON' => $request->input('icon_add')[$key],
					'WINDOW_TYPE' => 'M',
					'PARENT' => 0,
					'WINDOW_CLASS' => $request->input('window_class_add')[$key],
					'CHILD' => $request->input('child_add')[$key],
					'ROUTE' => $request->input('route_add')[$key],
					'ORDER' => $request->input('order_add')[$key],
				];


				NavigationModel::insert($insert_navigations);

			}	
		}
		Session::flash('success','List Successfuly Updated');
		return back();
	}


	/**
	 * Get All Parent Items
	 */

	public static function getParentItems()
	{
		return NavigationModel::where('WINDOW_TYPE','=','M')->where('CHILD','=',1)->get();
	}

	public static function hasChild( $NAV_ID)
	{
		return NavigationModel::where('PARENT','=',$NAV_ID)->count();
	}

	public static function getCategoryItems()
	{
		return NavigationModel::where('WINDOW_TYPE','=','C')->where('CHILD','=',1)->get();
	}

	/**
	 * Return Navigation Windows Class
	 */
	
	public function getWindowClass( $NAV_ID)
	{
	  $CLASS = NavigationModel::where('NAV_ID','=',$NAV_ID)->select('WINDOW_CLASS')->first();

	  return $CLASS->WINDOW_CLASS;
	}


	/**
	 * CATEGORY SECTION
	 */
	
	public function showCategory()
	{
		return view('POS.app_manager.navigation.navigation_category')
		->with('icons',IconModel::all())
		->with('navigation',NavigationModel::where('WINDOW_TYPE','=','SC')->orderBy('PARENT','ASC')->orderBy('ORDER','ASC')->get());
	}

	public function postCategoryFunction(Request $request)
	{
		if ($request->input('nav_desc')) 
		{
			/**
			 * Update the existing navigations
			 */
			
			foreach ($request->input('nav_desc') as $key => $value) 
			{
				$update_navigations = [
					'NAV_ID' => $request->input('window_code')[$key],
					'WINDOW_CLASS' => $request->input('window_class')[$key],
					'NAV_DESCRIPTION' => $request->input('nav_desc')[$key],
					'ICON' => $request->input('icon')[$key],
					'WINDOW_TYPE' => 'SC',
					'WINDOW_CLASS' => $this->getWindowClass($request->input('parent')[$key]),
					'PARENT' => $request->input('parent')[$key],
					'CHILD' => 0,
					'ROUTE' => $request->input('route')[$key],
					'ORDER' => $request->input('order')[$key],
				];

				NavigationModel::where('NAV_ID','=',$request->input('nav_id')[$key])->update($update_navigations);
			}
		}

		if ($request->input('desc_add')) 
		{
			/**
			 * Insert the new navigations item
			 */
			
			foreach ($request->input('desc_add') as $key => $value) {

				$insert_navigations = [
					'NAV_ID' => $request->input('code_add')[$key],
					'NAV_DESCRIPTION' => $request->input('window_class_add')[$key],
					'NAV_DESCRIPTION' => $request->input('desc_add')[$key],
					'ICON' => $request->input('icon_add')[$key],
					'WINDOW_TYPE' => 'SC',
					'WINDOW_CLASS' => $this->getWindowClass($request->input('parent_add')[$key]),
					'PARENT' => $request->input('parent_add')[$key],
					'CHILD' => 0,
					'ROUTE' => $request->input('route_add')[$key],
					'ORDER' => $request->input('order_add')[$key],
				];


				NavigationModel::insert($insert_navigations);

			}	
		}


		Session::flash('success','List Updated Successfully');
		return back();
	}


	/**
	 * Delete Process
	 */
	
	public function deleteFunction(Request $request)
	{
		$haschild = NavigationModel::where('PARENT','=',$request->input('del_id'))->count();

		if ($haschild > 0) 
		{
			Session::flash('failed','This navigation has child items you cannot delete this');
			return back();
		}	
		else
		{
			NavigationModel::where('NAV_ID','=',$request->input('del_id'))->delete();
			Session::flash('success','Success');
			return back();
		}
	}
}