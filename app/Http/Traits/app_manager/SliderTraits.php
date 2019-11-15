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

trait SliderTraits
{

	public function indexFunction()
	{
		return view('POS.app_manager.e_com.slider')
		->with('sliders',$this->getSliders());
	}
}