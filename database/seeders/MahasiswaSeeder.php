<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
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
                'Nim' =>  2141720241,
                'Nama' => 'Yuliyana Rahmawati',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '0895391933533'
            ],
            [
                'Nim' =>  2141720047,
                'Nama' => 'Yasmine Navisha Andhani',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081233672068' 
            ],
            [
                'Nim' =>  2141720015,
                'Nama' => 'Syahla Fayra S',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081381776064' 
            ],
        ];
        DB::table('mahasiswas')->insert($data);
    }
}
