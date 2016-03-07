<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('install_plugin', function (Blueprint $table) {
            // Columns
            $table->integer('install_id')->unsigned();
            $table->integer('plugin_id')->unsigned();
            $table->string('version');
            $table->boolean('is_mu_plugin');
            $table->boolean('is_active');

            // Indexes
            $table->primary(['install_id', 'plugin_id']);
            $table->index('install_id');
            $table->index('plugin_id');

            // Foreign keys
            $table->foreign('install_id')
                ->references('id')->on('installs')
                ->onDelete('cascade');
            $table->foreign('plugin_id')
                ->references('id')->on('plugins')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plugins');
        Schema::drop('install_plugin');
    }
}
