<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use DB;

class PatientController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $doctors = Doctor::distinct()->get(['category_id']);

        return view('patient.cart', compact('user', 'doctors'));
    }

    public function histories($title)
    {
        $user = auth()->user();

        $histories = DB::select("SELECT
        histories.id,
        doctors.first_name,
        doctors.last_name,
        doctor_categories.title,
        histories.`comment`,
        histories.created_at
    FROM
        histories
        JOIN doctors ON histories.doctor_id = doctors.id
        JOIN doctor_categories ON doctors.category_id = doctor_categories.id
    WHERE
        histories.patient_id = '$user->id' 
        AND doctor_categories.title = '$title'");

        return view('patient.history', compact('user', 'histories'));
    }

    public function history($title, $id)
    {
        $user = auth()->user();

        $histories = DB::select("SELECT
        doctors.first_name,
        doctors.last_name,
        doctor_categories.title,
        histories.`comment`,
        histories.created_at
    FROM
        histories
        JOIN doctors ON histories.doctor_id = doctors.id
        JOIN doctor_categories ON doctors.category_id = doctor_categories.id
    WHERE
        histories.patient_id = '$user->id' 
        AND doctor_categories.title = '$title'
        AND histories.id = '$id'");

        return view('patient.historyShow', compact('user', 'histories'));
    }
}
