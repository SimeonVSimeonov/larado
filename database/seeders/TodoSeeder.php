<?php

namespace Database\Seeders;

use App\Models\Todo;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Todo::truncate();
        $time_zone = new DateTimeZone('Europe/Sofia');

        for ($x = 0; $x <= 1; $x++) {
            DB::table('todos')->insert([
                'name' => 'name' . $x,
                'user_id' => '38a4933a-1807-47d4-b598-aa7dea0e3261',
                'created_at' => new DateTime('now', $time_zone),
                'updated_at' => new DateTime('now', $time_zone),
            ]);
        }
    }
}
