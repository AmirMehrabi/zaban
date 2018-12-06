<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        DB::table('posts')->insert([
          [
            'title' => 'About',
            'slug' =>  'about',
            'body' => 'jk sadjdksjajkdsa jkdskjajd sk',
            'parent_id' => null,
            'lft' => 3,
            'rgt' => 8,
            'depth' => 0
          ],
          [
            'title' => 'Contact',
            'slug' =>  'contact',
            'body' => 'jk sadjdksjajkdsa jkdskjajd sk',
            'parent_id' => 1,
            'lft' => 4,
            'rgt' => 5,
            'depth' => 1
          ],
          [
            'title' => 'FAQ',
            'slug' =>  'faq',
            'body' => 'jk sadjdksjajkdsa jkdskjajd sk',
            'parent_id' => 1,
            'lft' => 6,
            'rgt' => 7,
            'depth' => 1
          ],
          [
            'title' => 'Media',
            'slug' =>  'media',
            'body' => 'jk sadjdksjajkdsa jkdskjajd sk',
            'parent_id' => null,
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0
          ],
          [
            'title' => 'About',
            'slug' =>  'about',
            'body' => 'jk sadjdksjajkdsa jkdskjajd sk',
            'parent_id' => null,
            'lft' => 9,
            'rgt' => 10,
            'depth' => 0
          ],
        ]);
    }
}
