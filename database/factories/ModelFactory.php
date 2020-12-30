<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'last_login_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Terminal::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'location' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Conductor::class, static function (Faker\Generator $faker) {
    return [
        'terminal_id' => $faker->sentence,
        'name' => $faker->firstName,
        'username' => $faker->sentence,
        'password' => bcrypt($faker->password),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'deleted_at' => null,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\TransportationLog::class, static function (Faker\Generator $faker) {
    return [
        'resident_id' => $faker->sentence,
        'terminal_id' => $faker->sentence,
        'conductor_id' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Resident::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'address' => $faker->sentence,
        'birth_date' => $faker->date(),
        'contact_number' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Driver::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
