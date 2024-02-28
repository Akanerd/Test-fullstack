<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data untuk disimpan
        $data = [
            [
                "name" => "PHP",
                "created_by" => 1,
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "PostgreSQL",
                "created_by" => 1,
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "API (JSON, REST)",
                "created_by" => 1,
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Version Control System (Gitlab, Github)",
                "created_by" => 1,
                "created_at" => date('Y-m-d H:i:s'),
            ],
        ];

        // Simpan data ke dalam tabel
        foreach ($data as $row) {
            Skill::create($row);
        }
    }
}
