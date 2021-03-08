<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private $dataArray = [
        [ 'name'=>'html tutorials' ,'slug'=>'html-tutorials' ],
        [ 'name'=>'css tutorials' ,'slug'=>'css-tutorials' ],
        [ 'name'=>'js tutorials' ,'slug'=>'js-tutorials' ],
        [ 'name'=>'laravel tutorials' ,'slug'=>'laravel-tutorials' ],
        [ 'name'=>'vue js tutorials' ,'slug'=>'vue-js-tutorials' ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataArray as $item){
            \App\Category::create([
                'name' => $item['name'],
                'slug' => $item['slug'],
            ]);
        }

    }
}
