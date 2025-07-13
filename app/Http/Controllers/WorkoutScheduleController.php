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
        
        // Format time for each schedule
        $schedules->transform(function ($schedule) {
            $schedule->waktu = substr($schedule->waktu, 0, 5);
            return $schedule;
        });
        
        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_workout' => 'required|string|max:255',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:5|max:180',
            'jenis_olahraga' => 'required|in:Cardio,Strength,Flexibility,HIIT,Yoga,Other',
        ]);

        $workout = WorkoutSchedule::create([
            'user_id' => Auth::id(),
            'nama_workout' => $request->nama_workout,
            'hari' => $request->hari,
            'waktu' => $request->waktu . ':00', // Add seconds for database storage
            'durasi' => $request->durasi,
            'jenis_olahraga' => $request->jenis_olahraga,
        ]);

        // Format time for response
        $workout->waktu = substr($workout->waktu, 0, 5);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil ditambahkan',
                'data' => $workout
            ], 201);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $schedule = WorkoutSchedule::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'nama_workout' => 'required|string|max:255',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:5|max:180',
            'jenis_olahraga' => 'required|in:Cardio,Strength,Flexibility,HIIT,Yoga,Other',
        ]);

        // Add seconds for database storage
        $updateData = $request->only(['nama_workout','hari','durasi','jenis_olahraga']);
        $updateData['waktu'] = $request->waktu . ':00';
        
        $schedule->update($updateData);

        // Format time for response
        $schedule->waktu = substr($schedule->waktu, 0, 5);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil diupdate',
                'data' => $schedule->fresh()
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy(Request $request, $id)
    {
        $schedule = WorkoutSchedule::where('user_id', Auth::id())->findOrFail($id);
        $schedule->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dihapus'
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }

    public function show($id)
    {
        $schedule = WorkoutSchedule::where('user_id', Auth::id())->findOrFail($id);
        
        // Format time for HTML time input (remove seconds if present)
        $schedule->waktu = substr($schedule->waktu, 0, 5);
        
        return response()->json([
            'success' => true,
            'data' => $schedule
        ]);
    }
}
