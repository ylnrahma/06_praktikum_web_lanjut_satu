<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'mahasiswa_id' => '2141720241',
                'matakuliah_id' => 1,
                'nilai' => 'A'
            ],
            [
                'mahasiswa_id' => '2141720241',
                'matakuliah_id' => 2,
                'nilai' => 'B'
            ],
            [
                'mahasiswa_id' => '2141720241',
                'matakuliah_id' => 3,
                'nilai' => 'A'
            ],
            [
                'mahasiswa_id' => '2141720241',
                'matakuliah_id' => 4,
                'nilai' => 'B'
            ],
        ];
        DB::table('mahasiswa-matakuliah')->insert($data);
    }
}
