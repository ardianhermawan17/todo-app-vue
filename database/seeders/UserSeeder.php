<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
                'name'       => 'ardian',
                'email'      => 'ardian@mail',
                'password'   => bcrypt('root'),
       ];
        DB::table('users')->insert($user);
    }
}
