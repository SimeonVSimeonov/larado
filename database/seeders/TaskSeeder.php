<?php

namespace Database\Seeders;

use App\Models\Task;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
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
        Task::truncate();
        $time_zone = new DateTimeZone('Europe/Sofia');

        for ($x = 0; $x <= 4; $x++) {
            DB::table('tasks')->insert([
                'todo_id' => 1,
                'name' => 'task' . $x,
                'deadline' => new DateTime('now +7 day', $time_zone),
                'created_at' => new DateTime('now', $time_zone),
                'updated_at' => new DateTime('now', $time_zone),
            ]);
        }

        for ($x = 0; $x <= 4; $x++) {
            DB::table('tasks')->insert([
                'todo_id' => 2,
                'name' => 'task' . $x,
                'deadline' => new DateTime('now +7 day', $time_zone),
                'created_at' => new DateTime('now', $time_zone),
                'updated_at' => new DateTime('now', $time_zone),
            ]);
        }
    }
}
