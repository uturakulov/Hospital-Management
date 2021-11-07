<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctor = Doctor::latest()->with('category')->with('polyclinic');

        if ($request->first_name) {
            $doctor->where('first_name', $request->first_name);
        }

        if ($request->last_name) {
            $doctor->where('last_name', $request->last_name);
        }

        if ($request->email) {
            $doctor->where('email', $request->email);
        }

        if ($request->created) {
            $doctor->where('created_at', 'like', '%' . $request->created . '%');
        }

        if ($request->polyclinic) {
            $doctor->whereRelation('polyclinic', 'title', 'like', '%' . $request->polyclinic . '%');
        }

        if ($request->category) {
            $doctor->whereRelation('category', 'title', 'like', '%' . $request->category . '%');
        }

        return $doctor->get();
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
            'polyclinic_id' => 'required',
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

        return $doctor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Doctor::with('category')->with('polyclinic')->whereId($id)->get();
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

        return $doctor;
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

        return response('Successfully deleted!', 204);
    }
}
