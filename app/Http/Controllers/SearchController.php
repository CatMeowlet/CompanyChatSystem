<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $data = User::select("name")->where("name", "LIKE", "%{$request->input('query')}%")->get();
        return response()->json($data);
    }
    public function searchResult(Request $request)
    {
        $searchQuery = $request->input('search');
        $searchResult = User::with('profile')->where("name", "LIKE", "%$searchQuery%")->get();
        //$getProfile = App\Profile::all();
        return view('result')->with('data' , $searchResult);
    }
}
