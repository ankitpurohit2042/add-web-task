<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \Log::info('run ajax');
        if ($request->ajax()) {
            $data = Student::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $url = route("view-student-detail",['id' => $row->id]);
                    $btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->addColumn('image', function ($report) {
                    $url=asset("/storage/images/studentImages/".$report->image);
                    if(file_exists($url)){
                        return '<img src='.$url.' border="0" width="50" height="50" class="img-rounded" align="center" />';
                    }else{
                        $imageName = explode("/", $url);
                        $newPath = asset("/storage/images/studentImages/".end($imageName));
                       return '<img src='.$newPath.' border="0" width="50" height="50" class="img-rounded" align="center" />';
                    }
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }
        return view('pages.students.student-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryList = Country::all();
        return view('pages.students.add-student', compact('countryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        \Log::info('store data');
        Validator::make($request->all(), [
            'name'=> 'required',
            'grade'=> 'required',
            'image'=> 'required|mimes:jpeg,png,jpg|max:2048',
            'dob'=> 'required|date_format:Y-m-d|before:today',
            'address'=> 'required',
            'country'=> 'required',
            'state'=> 'required',
            'city'=> 'required',
        ],
        [
            'name.required'=> 'Name is required',
            'grade.required'=> 'Grade is required',
            'image.required'=> 'Upload image',
            'image.mimes'=> 'Upload valid image.',
            'image.max'=> 'Image is very large.',
            'dob.required'=> 'Date of birth is required',
            'dob.date_format'=> 'Enter valid Date of birth',
            'dob.before'=> 'Enter valid Date of birth',
            'address.required' => 'Enter your address',
            'country.required' => 'Enter your country',
            'state.required' => 'Enter your state',
            'city.required' => 'Enter your city',
        ])->validate();

        if($request->hasFile('image')){
            if ($request->file('image')->isValid()) {

                /*image upload code */
                $extension = $request->image->extension();
                $imageName = time().'.'.$extension;
                /*student create*/
                $studentData = Student::create([
                    'studentName' => $request->input('name'),
                    'grade' => $request->input('grade'),
                    'image' => $imageName,
                    'dateOfBirth' => $request->input('dob'),
                    'address' => $request->input('address'),
                    'country' => $request->input('country'),
                    'state' => $request->input('state'),
                    'city' => $request->input('city'),
                ]);
                $studentData->save();

                if($studentData){
                    $request->file('image')->storeAs('public/images/studentImages/', $imageName);
                    $request->session()->flash('success', 'Customer added successfully.');
                }

            }
        }
        return redirect()->route('student-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentData = Student::findOrFail($id);
        $countryList = Country::all();
        $stateList = State::all();
        $cityList = City::all();

        return view('pages.students.view-student-detail', compact('studentData','countryList','stateList','cityList'));

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
    public function update(Request $request, $id)
    {
        //
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