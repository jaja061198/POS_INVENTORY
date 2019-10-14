<?php

namespace App\Http\Controllers\app_manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\app_manager\UserAccessTraits;
use App\User as UserModel;

class UserAccessController extends Controller
{

	use UserAccessTraits;
    
    public function index($id)
    {
    	return $this->indexFunction($id);
    }

    public function windowIndex($id)
    {
    	return $this->windowIndexFunction($id);
    }

    public function getParent(Request $request)
    {
    	return $this->getParentFunction($request);
    }

    public function updateAccess(Request $request)
    {
    	return $this->updateFunction($request);
    }
}
