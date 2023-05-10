<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa-matakuliah', function(Blueprint $table){
            $table->id();
            $table->integer('mahasiswa_id')->nullable();
            $table->unsignedBigInteger('matakuliah_id')->nullable();
            $table->char('nilai');
            $table->foreign('mahasiswa_id')->references('Nim')->on('mahasiswas');
            $table->foreign('matakuliah_id')->references('id')->on('matakuliah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa-matakuliah');
    }
};
