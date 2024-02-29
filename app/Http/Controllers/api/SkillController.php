<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::latest()->get();
        return new ApiResource(true, 'List Data Skill', $skills);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

        $skills = skill::create([
            'name'   => $request->name,
        ]);

        if ($skills) {
            return new ApiResource(true, 'Berhasil menyimpan data', $skills);
        } else {
            return new ApiResource(false, 'Gagal menyimpan data', $skills);
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

        $skills = skill::findorfail($id);
        $skills->update([
            'name'   => $request->name,
            'updated_by' => $skills->id,
        ]);

        if ($skills) {
            return new ApiResource(true, 'Berhasil update data', $skills);
        } else {
            return new ApiResource(false, 'Gagal update data', $skills);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skills = Skill::FindOrFail($id);
        $skills = $skills->delete();
        if ($skills) {
            return new ApiResource(true, 'Berhasil delete data', $skills);
        } else {
            return new ApiResource(false, 'Gagal delete data', $skills);
        }
    }
}
