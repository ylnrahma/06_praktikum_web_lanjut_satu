<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewMahasiswaSeeder extends Seeder
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
                'Nim' =>  2141720001,
                'Nama' => 'Nabila Amandani',
                'Kelas' => 'Adbis-2F',
                'Jurusan' => 'Administrasi Niaga',
                'No_Handphone' => '089123456789'
            ],
            [
                'Nim' =>  2141720002,
                'Nama' => 'Sherly Anindia',
                'Kelas' => 'TE-2c',
                'Jurusan' => 'Teknik Elektro',
                'No_Handphone' => '089987654321' 
            ],
            [
                'Nim' =>  2141720003,
                'Nama' => 'Mayeta Syakira',
                'Kelas' => 'Adbis-2E',
                'Jurusan' => 'Administrasi Niaga',
                'No_Handphone' => '081234567890' 
            ],
            [
                'Nim' =>  2141720004,
                'Nama' => 'Ahmad Rezqi Dwi I',
                'Kelas' => 'SKL-2F',
                'Jurusan' => 'Teknik Elektro',
                'No_Handphone' => '081234567890' 
            ],
            [
                'Nim' =>  2141720005,
                'Nama' => 'Nur Muhammad Syahru Ramadhana',
                'Kelas' => 'TS-2B',
                'Jurusan' => 'Teknik Sipil',
                'No_Handphone' => '081987654321' 
            ],
        ];
        DB::table('mahasiswas')->insert($data);
    }
}
