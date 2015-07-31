<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    private $tables = [
        'users',
        'password_resets',
        'celebrities',
        'votes',
        'photos'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Model::unguard();
            $this->cleanDatabase();
            factory('App\Src\User\User', 1)->create();
//            factory('App\Src\Celebrity\Celebrity', 100)->create();
//            factory('App\Src\Vote\Vote', 1000)->create();
//            factory('App\Src\Photo\Photo', 300)->create();
    }

    private function cleanDatabase()
    {
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
    }

}
