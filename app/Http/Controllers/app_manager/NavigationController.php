<?php

namespace App\Http\Controllers\app_manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\app_manager\NavigationTraits;

class NavigationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     */
    
    use NavigationTraits;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return $this->showParent();
    }

    public function postParent(Request $request)
    {
        return $this->postParentFunction($request);
    }
    

    public function deleteNav(Request $request)
    {
        return $this->deleteFunction($request);
    }

    /**
     * This returns to the navigation category section
     */
    public function Categoryindex()
    {
        return $this->showCategory();
    }

    public function postCategory(Request $request)
    {
        return $this->postCategoryFunction($request);
    }
}
