<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    private $dataArray = [
        [ 'title'=>'Title 1 (laravel)' , 'body'=>'Iusto ea habitasse fermentum numquam modi voluptates maiores nisl repellat, eligendi, distinctio. Hac luctus atque. Aliquip. Minim animi ligula occaecat.' ,'image'=>'no-img.jpg' ,'user_id'=>1, 'category_id' => 1 ],
        [ 'title'=>'Title 2 (js)' , 'body'=>'Accusantium pretium sociis? Praesentium modi molestias mauris tenetur nascetur in, vero. Aliqua id venenatis labore exercitation, do iure reprehenderit veniam.' ,'image'=>'no-img.jpg' ,'user_id'=>1, 'category_id' => 2 ],
        [ 'title'=>'Title 3 (css)' , 'body'=>'Non tempor dignissim nascetur animi possimus ex quam debitis, integer. Dicta vitae suscipit aenean! Doloremque labore hac morbi, veritatis pellentesque.' ,'image'=>'no-img.jpg' ,'user_id'=>1, 'category_id' => 1 ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataArray as $item){
            \App\Post::create([
                'title' => $item['title'],
                'slug' => \Illuminate\Support\Str::slug($item['title']),
                'body' => $item['body'],
                'image' => $item['image'],
                'user_id' => $item['user_id'],
                'category_id' => $item['category_id'],
            ]);
        }
    }
}
