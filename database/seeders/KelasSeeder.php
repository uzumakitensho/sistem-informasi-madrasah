<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenjang = ['7', '8', '9'];
        $grup = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

        $incId = 1;
        $data = [];
        foreach($jenjang as $jn) {
            foreach($grup as $gr) {
                array_push($data, [
                    'id' => $incId,
                    'nama_kelas' => $jn.$gr,
                    'jenjang' => $jn,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $incId++;
            }
        }

        DB::table('kelas')->delete();
        DB::table('kelas')->insert($data);
    }
}
