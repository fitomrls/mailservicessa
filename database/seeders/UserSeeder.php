<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;
user 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $hash = Hash::make(time());
        $user = new User();
        $user->nombres = $input['nombres'];
        $user->apellidos = $input['apellidos'];
        $user->email = $input['email'];
        $hash = Hash::make(time());
        $user->remember_token = str_replace("/", "", $hash);
        $user->password = Hash::make(time());
        $user->rol = "user";
        $user->estadou = "inactivo";
        
    
        $user->save();

    }
}
