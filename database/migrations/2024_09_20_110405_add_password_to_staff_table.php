<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToStaffTable extends Migration
{
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->string('password')->after('email');  // Add password field
        });
    }

    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('password');  // Remove password field if rolling back
        });
    }
}
