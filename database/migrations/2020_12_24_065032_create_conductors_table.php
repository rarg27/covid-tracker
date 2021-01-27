<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('terminal_id')->unsigned();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('terminal_id')->references('id')->on('terminals');
        });

        \Artisan::call('db:seed', [
            '--class' => \Database\Seeders\ConductorsTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductors');
    }
}
