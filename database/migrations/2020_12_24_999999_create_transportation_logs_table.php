<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportation_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('resident_id')->unsigned();
            $table->bigInteger('terminal_id')->unsigned();
            $table->bigInteger('conductor_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('terminal_id')->references('id')->on('terminals');
            $table->foreign('conductor_id')->references('id')->on('conductors');
            $table->foreign('driver_id')->references('id')->on('drivers');
        });

        if (in_array(config('app.env'), ['local', 'development', 'testing'])) {
            \Artisan::call('db:seed', [
                '--class' => \Database\Seeders\TransportationLogsTableSeeder::class
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
        Schema::dropIfExists('transportation_logs');
    }
}
