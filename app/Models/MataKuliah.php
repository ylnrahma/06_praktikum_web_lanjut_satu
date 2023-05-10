<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
   protected $table = "matakuliah";
   public $timestamps = false;
   protected $primaryKey = 'id';

   protected $fillable = [
    'id',
    'nama_matkul',
    'sks',
    'jam',
    'semester'
   ];

   public function mahasiswa(){
    return $this->belongsToMany(Mahasiswa::class);
   }
   public function mahasiswamatakuliah(){
        return $this->belongsToMany(MahasiswaMataKuliah::class);
   }
}
