<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMatriculeNameMoviePhoneAddressToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('matricule',30)->unique()->nullable()->default(null)->after('name');
            $table->string('nameMovie')->nullable()->default(null)->after('matricule');
            $table->string('phone', 14)->unique()->nullable()->default(null)->after('nameMovie');
            $table->string('address')->default(null)->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('matricule');
            $table->dropColumn('nameMovie');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
}
