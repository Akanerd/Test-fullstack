<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CandidateController extends Controller
{
    protected $candidates;

    public function __construct()
    {
        $this->candidates = new Candidate();
    }
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
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required',
                'job_id'   => 'required',
                'email'    => 'required|email',
                'phone'    => 'required|numeric|digits_between:10,12',
                'year'     => 'required|numeric',
                'skill'    => 'required|array|min:1',
            ],
            [
                'name.required'    => 'Entry Nama Harus Diisi',
                'job_id.required'  => 'Entry Jabatan Harus Diisi',
                'email.required'   => 'Entry Email Harus Diisi',
                'phone.required'   => 'Entry Telepon Harus Diisi',
                'year.required'    => 'Entry Tahun Harus Diisi',
                'skill.required'   => 'Entry Skill Harus Diisi',
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $candidate = Candidate::create([
            'name'   => $request->name,
            'job_id' => $request->job_id,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'year'   => $request->year,
            'created_by' => $this->candidates->id,
        ]);


        if ($candidate) {
            // Penyimpanan berhasil, lanjutkan dengan skillset jika ada.
            if ($request->has('skill')) {
                $candidate->skillsets()->attach($request->skill);
            }
            // Alert::success('Berhasil!', 'Lamaran berhasil dikirim');
            // return redirect()->back();
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            // Alert::error('Gagal!', 'Lamaran gagal dikirim');
            // return redirect()->back();
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
