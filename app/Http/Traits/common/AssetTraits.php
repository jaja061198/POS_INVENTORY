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

trait AssetTraits
{

	public function getSliders()
	{
		return SliderModel::get();
	}
}