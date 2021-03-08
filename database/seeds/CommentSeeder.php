<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    private $dataArray = [
        [ 'body'=>'Quos occaecat.' , 'user_id'=>1,'post_id'=>1, ],
        [ 'body'=>'Molestiae quibusdam quibusdam.' , 'user_id'=>1,'post_id'=>1, ],
        [ 'body'=>'Cupidatat unde.' , 'user_id'=>1,'post_id'=>2, ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataArray as $item){
            \App\Comment::create([
                'body' => $item['body'],
                'user_id' => $item['user_id'],
                'post_id' => $item['post_id'],
            ]);
        }
    }
}
