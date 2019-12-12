<?php

namespace App\Http\Controllers\E_COM;


use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\e_com\WelcomePage as WelcomePageModel;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        return view('E_COM.welcome.welcome_page')
        ->with('items',WelcomePageModel::first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if ($request->hasFile('add_item_image')) 
        {

            $extension = Input::file('add_item_image')->getClientOriginalExtension();
            $filename_old = Input::file('add_item_image')->getClientOriginalName();
            $filesize = Input::file('add_item_image')->getClientSize();

            $filename = rand(11111111, 99999999). '.' . $extension;
            $fullPath = $filename;

            $details = [
                'welcome_greet' => $request->input('welcome'),
                'welcome_msg' => $request->input('welcome_msg'),
                'IMAGE' => 'img/'.$fullPath,
            ];

            $request->file('add_item_image')->move(base_path('public/img/'), $filename);

        }

        else

        {
            $details = [
                'welcome_greet' => $request->input('welcome'),
                'welcome_msg' => $request->input('welcome_msg'),
            ];
        }

        WelcomePageModel::where('id','=',$request->input('get_id'))->update($details);

        Session::flash('success','Upadate Success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
