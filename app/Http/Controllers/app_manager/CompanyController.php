<?php

namespace App\Http\Controllers\app_manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\app_manager\CompanyTraits;

class CompanyController extends Controller
{
	use CompanyTraits;
    //
    public function index()
    {
    	return $this->companyDetails();
    }

    public function update(Request $request)
    {
    	return $this->updateFunction($request);
    }
}
