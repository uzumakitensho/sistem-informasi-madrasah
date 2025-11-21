<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun_ajaran')->delete();

        DB::table('tahun_ajaran')->insert([
            'id' => 1,
            'tahun_mulai' => 2025,
            'tahun_akhir' => 2026,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
