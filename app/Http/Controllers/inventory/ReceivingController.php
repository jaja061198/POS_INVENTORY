<?php

namespace App\Http\Controllers\inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\inventory\ReceivingTraits;

class ReceivingController extends Controller
{
	use ReceivingTraits;
    //
    public function index()
    {
    	// return $this->test();
    	return view('POS.inventory.receiving.receive')
        ->with('RR_CODE',$this->generateCode());
    }

    public function serverside(Request $request)
    {
        return $this->serverSideFunction($request);
    }

    public function populate(Request $request)
    {
        return $this->populateFunction($request);
    }

    public function receive(Request $request)
    {
        return $this->receiveFunction($request);
    }

    public function indexList()
    {
        // return $this->test();
        return $this->indexListFunction();
    }

    public function show($id)
    {
        return $this->showFunction($id);
    }
}
