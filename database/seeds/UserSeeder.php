<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $dataArray = [
        [ 'name'=>'mikhail' , 'email'=>'mikhail@yahoo.com' ,'photo'=>'no-img.jpg' ,'password'=>'123456' ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataArray as $item){
            \App\User::create([
                'name' => $item['name'],
                'email' => $item['email'],
                'photo' => $item['photo'],
                'password' => bcrypt($item['password']),
            ]);
        }
    }
}
