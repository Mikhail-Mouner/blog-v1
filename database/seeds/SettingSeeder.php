<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    private $dataArray = [
        [ 'site_name'=>'blog-vue' , 'contact_email'=>'blog@domain.com','address'=>'address example here', ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataArray as $item){
            \App\Setting::create([
                'site_name' => $item['site_name'],
                'contact_email' => $item['contact_email'],
                'address' => $item['address'],
            ]);
        }
    }

}
