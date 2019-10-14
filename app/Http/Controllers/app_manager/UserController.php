<?php

namespace App\Http\Controllers\app_manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\app_manager\UserTraits;

class UserController extends Controller
{
	use UserTraits;
    
    public function index()
    {
    	return $this->viewUsersFunction();
    }

    public function serverside(Request $request)
    {
    	return $this->serversideFunction($request);
    }

    public function resetpassword($id)
    {
    	return $this->resetFunction($id);
    }

    public function updateUser(Request $request)
    {
    	return $this->updateFunction($request);
    }

    public function validateNewEmail(Request $request)
    {
        return $this->newEmail($request);
    }

    public function validateNewUsername(Request $request)
    {
        return $this->newUsername($request);
    }

    public function addUser(Request $request)
    {
        return $this->insertFunction($request);
    }
}
