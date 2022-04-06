<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->bigInteger('nip');
            $table->string('email');
            $table->string('pejabat');
            $table->string('jabatan');
            $table->string('unit_kerja');
            $table->string('tujuan_penggunaan');
            $table->string('watermark');
            $table->integer('status');
            $table->string('petugas')->nullable();
            $table->string('signed');
            $table->timestamps();
        });

        //Set Foreign Key di kolom id_user pada tabel standard_demands
        Schema::table('standard_demands', function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('data_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Foreign Key di kolom id_user di tabel standard_demands
        Schema::table('standard_demands', function(Blueprint $table){
            $table->dropForeign('standard_demands_id_user_foreign');
        });

        Schema::dropIfExists('data_users');
    }
}
