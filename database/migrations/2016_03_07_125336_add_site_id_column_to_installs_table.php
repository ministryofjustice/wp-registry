<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSiteIdColumnToInstallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installs', function (Blueprint $table) {
            $table->string('site_id')->default('');
            $table->unique('site_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installs', function (Blueprint $table) {
            $table->dropColumn('site_id');
        });
    }
}
