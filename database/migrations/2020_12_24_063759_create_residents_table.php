<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->date('birth_date');
            $table->string('email');
            $table->string('contact_number')->nullable();
            $table->tinyInteger('status')
                ->default(0)
                ->unsigned()
                ->comment('0 - pending, 1 - accepted, 2 - rejected');
            $table->string('id_type', 50)->nullable();
            $table->string('id_value', 50)->nullable();
            $table->timestamps();

            $table->unique(['id_type', 'id_value']);
        });

        if (in_array(config('app.env'), ['local', 'development', 'testing'])) {
            \Artisan::call('db:seed', [
                '--class' => \Database\Seeders\ResidentsTableSeeder::class
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
        Schema::dropIfExists('residents');
    }
}
