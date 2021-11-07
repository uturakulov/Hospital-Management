<?php

namespace App\Http\Controllers\Api;

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
    public function index(Request $request)
    {
        $patient = Patient::latest()->with('polyclinic');

        if ($request->first_name) {
            $patient->where('first_name', $request->first_name);
        }

        if ($request->last_name) {
            $patient->where('last_name', $request->last_name);
        }

        if ($request->email) {
            $patient->where('email', $request->email);
        }

        if ($request->created) {
            $patient->where('created_at', 'like', '%' . $request->created . '%');
        }

        if ($request->polyclinic) {
            $patient->whereRelation('polyclinic', 'title', 'like', '%' . $request->polyclinic . '%');
        }

        return $patient->get();
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
        $patient->polyclinic_id = $request->polyclinic_id;
        $patient->save();

        return $patient;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Patient::with('polyclinic')->whereId($id)->get();
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

        $patient = Patient::findOrFail($id);
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->dob = $request->dob;
        $patient->phone_number = $request->phone_number;
        $patient->passport_number = $request->passport_number;
        $patient->address = $request->address;
        $patient->name = $request->first_name . $request->last_name;
        $patient->email = $request->email;
        if ($request->password) {
            $patient->password = Hash::make($request->password);
        }
        $patient->polyclinic_id = $request->polyclinic_id;
        $patient->save();

        return $patient;
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

        return response('Successfully Deleted', 204);
    }
}
