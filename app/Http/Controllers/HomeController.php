<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalStudent = Student::count();
        return view('home',compact('totalStudent'));
    }

    public function getStateList($id){
        $state = State::where('countryId', $id)->get();
        return response()->json($state);
    }

    public function getCityList($id){
        $city = City::where('stateId', $id)->get();
        return response()->json($city);
    }
}
