<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->guard('admin')->user();

        $patients = Patient::all();

        return view('admin.patients', compact('user', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'create';

        return view('admin.patientsForm', compact('page'));
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
            'dob' => 'required',
            'phone_number' => 'required',
            'passport_number' => 'required',
            'address' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ])->validate();

        $patient = new Patient();
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->dob = $request->dob;
        $patient->phone_number = $request->phone_number;
        $patient->passport_number = $request->passport_number;
        $patient->address = $request->address;
        $patient->name = $request->first_name . $request->last_name;
        $patient->email = $request->email;
        $patient->password = Hash::make($request->password);
        $patient->save();

        return redirect()->route('admin-patients')->with('message', 'Patient Successfully Added!');
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
        $page = 'update';

        $patient = Patient::findOrFail($id);

        return view('admin.patientsForm', compact('page', 'patient'));
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
        $patient = Patient::findOrFail($id);
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->dob = $request->dob;
        $patient->phone_number = $request->phone_number;
        $patient->passport_number = $request->passport_number;
        $patient->address = $request->address;
        $patient->name = $request->first_name . $request->last_name;
        $patient->email = $request->email;
        if ($request->password != null) {
            $patient->password = Hash::make($request->password);
        }
        $patient->save();

        return redirect()->route('admin-patients')->with('message', 'Patient Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        $patient->delete();

        return redirect()->back()->with('message', 'Patient Successfully Deleted!');
    }
}
