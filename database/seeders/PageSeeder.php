<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkımızda','Kariyer','Vizyon','Misyon'];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=> $page,
                'slug'=> Str::slug($page),
                'image'=>"https://www.mind-your-business.net/media/images/i.a.mind-your-business-01-large.jpg",
                'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis repellat fuga nemo, aliquid esse voluptatum iste maiores tenetur 
                sequi vero adipisci delectus laudantium hic sint rerum et, quo fugit explicabo!",
                'order'=>$count,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
        }      
    }
}
