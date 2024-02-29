<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Skillset;
use Illuminate\Support\Facades\Validator;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = candidate::with(['job', 'skills'])->get();


        $candidates = $candidates->map(function ($item, $key) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'email' => $item['email'],
                'phone' => $item['phone'],
                'job' => $item['job']['name'],
                'skills' => collect($item['skills'])->pluck('name'),
            ];
        });

        // $candidates = Candidate::latest()->paginate(5);
        return new ApiResource(true, 'List Data Candidates', $candidates);
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
                'job_id.required'  => 'Entry Nama Harus Diisi',
                'email.required'   => 'Kolom Email Harus Diisi',
                'phone.required'   => 'Entry Telepon Harus Diisi',
                'year.required'    => 'Entry Tahun Harus Diisi',
                'skill.required'   => 'Entry Skill Harus Diisi',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $candidate = Candidate::create([
            'name'   => $request->name,
            'job_id' => $request->job_id,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'year'   => $request->year,
            'created_by' => $request->created_by,
        ]);

        if ($candidate) {
            // Penyimpanan berhasil, lanjutkan dengan skillset jika ada.
            if ($request->has('skill')) {
                $candidate->skillsets()->attach($request->skill);
            }
            return new ApiResource(true, 'Berhasil menyimpan data', $candidate);
        } else {
            return new ApiResource(false, 'Gagal menyimpan data', $candidate);
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
                'job_id.required'  => 'Entry Nama Harus Diisi',
                'email.required'   => 'Entry Email Harus Diisi',
                'phone.required'   => 'Entry Telepon Harus Diisi',
                'year.required'    => 'Entry Tahun Harus Diisi',
                'skill.required'   => 'Entry Skill Harus Diisi',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $candidate = Candidate::findOrfail($id);
        $candidate->update([
            'name'   => $request->name,
            'job_id' => $request->job_id,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'year'   => $request->year,
            'updated_by' => $candidate->id,
        ]);

        if ($candidate) {
            // Penyimpanan berhasil, lanjutkan dengan skillset jika ada.
            if ($request->has('skill')) {
                $candidate->skillsets()->attach($request->skill);
            }
            return new ApiResource(true, 'Berhasil update data', $candidate);
        } else {
            return new ApiResource(false, 'Gagal update data', $candidate);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $candidate = Candidate::FindOrFail($id);
        $candidate= $candidate->delete();
        if ($candidate) {
            return new ApiResource(true, 'Berhasil delete data', $candidate);
        } else {
            return new ApiResource(false, 'Gagal delete data', $candidate);
        }
    }
}
