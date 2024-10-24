<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=========== avant de seeder la table user  ======
        //User::truncate();


        // ==== Attribution du role administrateur ========

        $admin_role = Role::where('name', 'Administrateur')->first();

        User::create([
            'full_name' => 'Alla Wilfried',
            'email' => 'wilfriedala94@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => $admin_role->id
        ]);
    }
}
