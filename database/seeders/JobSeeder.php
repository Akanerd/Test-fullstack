<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Buat data untuk disimpan
         $data = [
            [
                "name" => "Backend Web Programmer",
                "created_by" => 1,
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Frontend Web Programmer",
                "created_by" => 1,
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Quality Control",
                "created_by" => 1,
                "created_at" => date('Y-m-d H:i:s'),
            ],
        ];

        // Simpan data ke dalam tabel
        foreach ($data as $row) {
            Job::create($row);
        }
    }
}
