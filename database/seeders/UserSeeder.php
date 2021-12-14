<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;
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
        $user->email = "admin@mail.com";
        $user->password = Hash::make("adminadmin");    
        $user->state = "active";
        $user->rol = "admin";        
        $user->save();
        
        $person = new Person();
        $person->identifier = time();
        $person->name = "User Admin";
        $person->docid = "1";
        $person->citycod = "1";
        $person->bdate = Carbon::parse("1988-04-07")->format('Y-m-d');
        $person->user_id = $user->id;
        $person->save();

    }
}
