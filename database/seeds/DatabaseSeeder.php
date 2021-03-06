<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use App\Answer;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //bacause we will call multiple seeder files
        $this->call([
            UsersQuestionsAnswersTableSeeder::class,
            FavoritesTableSeeder::class,
            VotablesTableSeeder::class,
        ]);
    /*    factory(\App\User::class, rand(1, 5))->create()->each(function($u) {
            $u->questions()->saveMany(
                factory(\App\Question::class, rand(1, 5))->make()
                )
                ->each(function($q) {
                    $q->answers()->saveMany(factory(\App\Answer::class, rand(1,5))->make());
                });
        });
      */  
        
    }
}
