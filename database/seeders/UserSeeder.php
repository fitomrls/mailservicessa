<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                
        $user = new User();
        $user->identifier = time();
        $user->email = "admin@mail.com";
        $user->password = Hash::make("adminadmin");
        $user->name = "User Admin";
        $user->docid = "1";
        $user->citycod = "1";
        $user->bdate = Carbon::parse("200-01-01")->format('Y-m-d');
        $user->state = "active";
        $user->rol = "admin";        
    
        $user->save();

    }
}
