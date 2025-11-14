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
        Schema::create('informasi_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // jurusan, akreditasi, kontak, jam_operasional
            $table->string('key'); // nama field
            $table->text('value'); // nilai
            $table->integer('order')->default(0); // urutan
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
        Schema::dropIfExists('informasi_sekolahs');
    }
};
