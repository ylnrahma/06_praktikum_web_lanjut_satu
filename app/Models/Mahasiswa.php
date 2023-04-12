<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Mahasiswa extends Model
{
    protected $table="mahasiswas"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    protected $primaryKey = 'nim'; // Memanggil isi DB Dengan primarykey
    public $timestamps = false;
    /**
     * * The attributes that are mass assignable.
     *  *
     * * @var array
     * */
    protected $fillable = [
        'Nim',
        'Nama',
        'kelas_id',
        'Jurusan',
        'No_Handphone',
        'Email',
        'Tanggal_lahir',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
};

