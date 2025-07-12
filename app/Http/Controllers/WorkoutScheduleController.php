<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutSchedule;
use Illuminate\Support\Facades\Auth;

class WorkoutScheduleController extends Controller
{
    public function index()
    {
        $schedules = WorkoutSchedule::where('user_id', Auth::user()->id)->get();
        return view('pages.jadwal', compact('schedules'));
    }

    public function jadwalapi()
    {
        $schedules = WorkoutSchedule::where('user_id', Auth::user()->id)->get();
        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_workout' => 'required',
            'hari' => 'required',
            'waktu' => 'required',
            'durasi' => 'required|integer|min:5|max:180',
            'jenis_olahraga' => 'required',
        ]);
        WorkoutSchedule::create([
            'user_id' => Auth::id(),
            'nama_workout' => $request->nama_workout,
            'hari' => $request->hari,
            'waktu' => $request->waktu,
            'durasi' => $request->durasi,
            'jenis_olahraga' => $request->jenis_olahraga,
        ]);
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $schedule = WorkoutSchedule::where('user_id', Auth::id())->findOrFail($id);
        $request->validate([
            'nama_workout' => 'required',
            'hari' => 'required',
            'waktu' => 'required',
            'durasi' => 'required|integer|min:5|max:180',
            'jenis_olahraga' => 'required',
        ]);
        $schedule->update($request->only(['nama_workout','hari','waktu','durasi','jenis_olahraga']));
        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy($id)
    {
        $schedule = WorkoutSchedule::where('user_id', Auth::id())->findOrFail($id);
        $schedule->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }
}
