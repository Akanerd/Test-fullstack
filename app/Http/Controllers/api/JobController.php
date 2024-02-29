<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->get();
        return new ApiResource(true, 'List Data Skill', $jobs);
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
            ],
            [
                'name.required'    => 'Entry Nama Harus Diisi',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jobs = Job::create([
            'name'   => $request->name,
        ]);

        if ($jobs) {
            return new ApiResource(true, 'Berhasil menyimpan data', $jobs);
        } else {
            return new ApiResource(false, 'Gagal menyimpan data', $jobs);
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
            ],
            [
                'name.required'    => 'Entry Nama Harus Diisi',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jobs = Job::findorfail($id);
        $jobs->update([
            'name'   => $request->name,
            'updated_by' => $jobs->id,
        ]);

        if ($jobs) {
            return new ApiResource(true, 'Berhasil update data', $jobs);
        } else {
            return new ApiResource(false, 'Gagal update data', $jobs);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobs = job::FindOrFail($id);
        $jobs = $jobs->delete();
        if ($jobs) {
            return new ApiResource(true, 'Berhasil delete data', $jobs);
        } else {
            return new ApiResource(false, 'Gagal delete data', $jobs);
        }
    }
}
