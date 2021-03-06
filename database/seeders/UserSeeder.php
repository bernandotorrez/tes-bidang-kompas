<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'password' => Hash::make('admin'),
            'level' => 'Adm',
            'status' => '1'
        ]);

        User::create([
            'username' => 'reporter',
            'name' => 'Reporter',
            'password' => Hash::make('reporter'),
            'level' => 'Rpt',
            'status' => '1'
        ]);

        User::create([
            'username' => 'editor',
            'name' => 'Editor',
            'password' => Hash::make('editor'),
            'level' => 'Edt',
            'status' => '1'
        ]);
    }
}
