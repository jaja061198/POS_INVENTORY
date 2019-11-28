<?php

namespace App\Http\Traits\common;


use Crypt;
use DB;
use Auth;
use Session;
use Response;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\app_manager\Slider as SliderModel;
use Yajra\Datatables\Datatables;

trait AssetTraits
{

	public function getSliders()
	{
		return SliderModel::get();
	}

	public function serverSide()
	{
		return Datatables::of(SliderModel::query())
		->addColumn('action', function($user) {
			return '<a href="#" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>Edit</a>';
		})
		->make(true);
	}
}