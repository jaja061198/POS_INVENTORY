<?php


use App\User;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function showusers()
    {
    	return view('user_list');
    }

}
