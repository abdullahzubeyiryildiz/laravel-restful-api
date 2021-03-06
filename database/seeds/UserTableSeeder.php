<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE users");

        DB::table("users")->insert([
            'name' => 'admin',
            'email' => 'admin@laravelapi.test',
            'email_verified_at' => now(),
            'first_name' => 'Abdullah',
            'last_name' => 'Yıldız',
            'password' => bcrypt(123), // password
            'remember_token' => Str::random(10),
        ]);
        factory(User::class,10)->create();
    }
}
