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
       Schema::create('wali_kelas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');   // id guru/wali
        $table->unsignedBigInteger('kelas_id');  // id kelas
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wali_kelas');
    }
};
