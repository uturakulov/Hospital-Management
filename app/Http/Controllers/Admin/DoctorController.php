<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Polyclinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->guard('admin')->user();

        $doctors = Doctor::all();

        return view('admin.doctors', compact('user', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'create';

        $categories = DoctorCategory::all();

        $polyclinics = Polyclinic::all();

        return view('admin.doctorsForm', compact('page', 'categories', 'polyclinics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        validator($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'category_id' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ])->validate();

        $doctor = new Doctor();
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->phone_number = $request->phone_number;
        $doctor->category_id = $request->category_id;
        $doctor->name = $request->first_name . $request->last_name;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->polyclinic_id = $request->polyclinic_id;
        $doctor->save();

        return redirect()->route('admin-doctor')->with('message', 'Doctor Successfully Added!');
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
        $categories = DoctorCategory::all();

        $doctor = Doctor::findOrFail($id);

        $page = 'update';

        $polyclinics = Polyclinic::all();

        return view('admin.doctorsForm', compact('page', 'doctor', 'categories', 'polyclinics'));
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
        $doctor = Doctor::findOrFail($id);
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->phone_number = $request->phone_number;
        $doctor->category_id = $request->category_id;
        $doctor->name = $request->first_name . $request->last_name;
        $doctor->email = $request->email;
        if ($request->password != null) {
            $doctor->password = Hash::make($request->password);
        }
        $doctor->polyclinic_id = $request->polyclinic_id;
        $doctor->save();

        return redirect()->route('admin-doctor')->with('message', 'Doctor Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();

        return redirect()->route('admin-doctor')->with('message', 'Doctor Successfully Deleted!');
    }
}
