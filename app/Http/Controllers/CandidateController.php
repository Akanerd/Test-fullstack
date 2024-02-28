<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Skillset;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job = Job::all();
        $skill = Skill::all();
        return view('apply', compact('job', 'skill'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'     => 'required',
                'job_id'   => 'required',
                'email'    => 'required|email',
                'phone'    => 'required|numeric|digits_between:10,12',
                'year'     => 'required|numeric',
                'skill'    => 'required|array|min:1', 
            ],
            [
                'name.required'    => 'Kolom Nama Harus Diisi',
                'job_id.required'  => 'Kolom Nama Harus Diisi',
                'email.required'   => 'Kolom Email Harus Diisi',
                'phone.required'   => 'Kolom Telepon Harus Diisi',
                'year.required'    => 'Kolom Tahun Harus Diisi',
                'skill.required'    => 'Kolom Skill Harus Diisi',
            ]
        );

        $candidate = Candidate::create([
            'name' => $request->name,
            'job_id' => $request->job_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'year' => $request->year,
        ]);

        if ($candidate) {
            // Penyimpanan berhasil, lanjutkan dengan skillset jika ada.
            if ($request->has('skill')) {
                $candidate->skillsets()->attach($request->skill);
            }
            Alert::success('Berhasil!', 'Lamaran berhasil dikirim');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Lamaran gagal dikirim');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
