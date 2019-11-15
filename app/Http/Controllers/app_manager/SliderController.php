<?php

namespace App\Http\Controllers\app_manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\app_manager\SliderTraits;
use App\Http\Traits\common\AssetTraits;

class SliderController extends Controller
{
	use SliderTraits,AssetTraits;
    //
    public function index()
    {
    	return $this->indexFunction();
    }

}
