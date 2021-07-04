<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Developer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "firstname" => 'required',
            "lastname" => 'required',
            "email" => 'required|email',
            "address" => 'required',
            "phone" => 'required',
            "avatar" => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $input = $request->all();
        if ($avatar = $request->file('avatar')) {
            $destinationPath = 'images/';
            $imageName = date('YmdHis') . '.'. $avatar->getClientOriginalExtension();
            $avatar->move($destinationPath, $imageName);
            $imageName = '/'. $destinationPath . $imageName;
            $input['avatar'] = $imageName;
        }

        Developer::create($input);
        return response(["message" => "created"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response(Developer::destroy($id));
    }

    public function bulkDelete(Request $request) {
        return Developer::whereIn('id', $request->input('ids'))->delete();
    }

}
