<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'first_name'            => 'amoba',
            'last_name'            => 'project',
            'description'            => 'lorem ipsum',
            'email'           => 'amoba@gmail.com',
            'password'        => bcrypt('password'),          
        ]);

        for ($i=1; $i < 20; $i++) { 
             User::create([
            'first_name'            => 'amoba',
            'last_name'            => 'project',
            'description'            => 'lorem ipsum',
            'email'           => 'amoba'.$i.'@gmail.com',
            'password'        => bcrypt('password'),          
            ]);
        }
       
     

        

    }
}

