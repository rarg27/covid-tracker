<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('terminal_id')->unsigned();
            $table->timestamps();

            $table->foreign('terminal_id')->references('id')->on('terminals');
            $table->unique(['name', 'terminal_id']);
        });

        if (in_array(config('app.env'), ['local', 'development', 'testing'])) {
            \Artisan::call('db:seed', [
                '--class' => \Database\Seeders\DriversTableSeeder::class
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
