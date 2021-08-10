<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 10; $i++) { 
            # code...
        Post::create([
            'title'=>"test-$i",
            'image'=>"test[$i].png",
            'content'=>"test-$i"
        ]);
    }
    }
}
