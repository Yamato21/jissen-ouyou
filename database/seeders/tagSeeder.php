<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;
use App\Models\Tag;

class tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Tag::create([
        'tag_name' =>'']);
        
       Tag::create([
        'tag_name' => '家事']);
    
      Tag::create([
        'tag_name' => '勉強']);

         Tag::create([
        'tag_name' => '運動']);

         Tag::create([
        'tag_name' => '食事']);

         Tag::create([
        'tag_name' => '移動']);
    }
}