<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Patient;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $user = auth()->guard('doctor')->user();

        $histories = History::where('doctor_id', $user->id)->latest()->paginate(20);

        return view('doctor.home', compact('user', 'histories'));
    }

    public function addHistoryView()
    {
        $page = 'add';

        $user = auth()->guard('doctor')->user();

        $patients = Patient::where('polyclinic_id', $user->polyclinic_id)->get();

        return view('doctor.formHistory', compact('patients', 'user', 'page'));
    }

    public function addHistoryStore(Request $request)
    {
        date_default_timezone_set('Asia/Tashkent');

        History::create($request->all());

        return redirect()->route('doctor-home')->with('message', 'Added Successfully!');
    }

    public function showHistory($id)
    {
        $history = History::findOrFail($id);

        $user = auth()->guard('doctor')->user();

        return view('doctor.showHistory', compact('history', 'user'));
    }

    public function editHistory($id)
    {
        $page = 'update';

        $history = History::findOrFail($id);

        $user = auth()->guard('doctor')->user();

        $patients = Patient::where('polyclinic_id', $user->polyclinic_id)->get();

        return view('doctor.formHistory', compact('history', 'user', 'patients', 'page'));
    }

    public function updateHistory(Request $request, $id)
    {
        $history = History::findOrFail($id);

        $history->patient_id = $request->patient_id;
        $history->comment = $request->comment;
        $history->save();

        return redirect()->route('doctor-home')->with('message', 'Updated Successfully!');
    }

    public function deleteHistory($id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return redirect()->route('doctor-home')->with('message', 'Deleted Successfully!');
    }
}
