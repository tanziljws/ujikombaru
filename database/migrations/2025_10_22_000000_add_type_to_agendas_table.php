<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->string('type')->default('regular')->after('id');
        });
    }

    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
