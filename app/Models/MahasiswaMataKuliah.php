<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMataKuliah extends Model
{
   protected $table = "mahasiswa-matakuliah";
   public $timestamps = false;
   protected $primaryKey = 'id';

   protected $fillable = [
    'id',
    'mahasiswa_id',
    'matakuliah_id',
    'nilai'
   ];

   public function matakuliah(){
    return $this->belongsTo(MataKuliah::class);
   }
}
