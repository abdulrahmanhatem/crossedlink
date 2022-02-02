<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            ['id' => 1, 'text' => 'sandsof Games', 'start_date' => '2020-1-25 00:00:00', 'duration' => 5, 'progress' => '.3', 'parent' => 0],
            ['id' => 6, 'text' => 'Task-1 ', 'start_date' => '2020-1-25 00:00:00', 'duration' => 2, 'progress' => '.3', 'parent' => 1],
            ['id' => 7, 'text' => 'Task-2 ', 'start_date' => '2020-1-27 00:00:00', 'duration' => 2, 'progress' => '.3', 'parent' => 1],
            ['id' => 8, 'text' => 'Task-3 ', 'start_date' => '2020-1-28 00:00:00', 'duration' => 1, 'progress' => '.3', 'parent' => 1],
            ['id' => 2, 'text' => 'Sosocial', 'start_date' => '2020-1-30 00:00:00', 'duration' => 5, 'progress' => '.5', 'parent' => 0],
            ['id' => 9, 'text' => 'Task-1 ', 'start_date' => '2020-1-30 00:00:00', 'duration' => 2, 'progress' => '.8', 'parent' => 2],
            ['id' => 10, 'text' => 'Task-2 ', 'start_date' => '2020-2-2 00:00:00', 'duration' => 2, 'progress' => '.7', 'parent' => 2],
            ['id' => 11, 'text' => 'Task-3 ', 'start_date' => '2020-2-3 00:00:00', 'duration' => 1, 'progress' => '.5', 'parent' => 2],
            ['id' => 3, 'text' => 'codecube', 'start_date' => '2020-2-5 00:00:00', 'duration' => 5, 'progress' => '.8', 'parent' => 0],
            ['id' => 12, 'text' => 'Task-1 ', 'start_date' => '2020-2-5 00:00:00', 'duration' => 2, 'progress' => '.5', 'parent' => 3],
            ['id' => 13, 'text' => 'Task-2 ', 'start_date' => '2020-2-7 00:00:00', 'duration' => 2, 'progress' => '.6', 'parent' => 3],
            ['id' => 14, 'text' => 'Task-3 ', 'start_date' => '2020-2-8 00:00:00', 'duration' => 1, 'progress' => '.7', 'parent' => 3],
            ['id' => 4, 'text' => 'crosslink', 'start_date' => '2020-2-20 00:00:00', 'duration' => 5, 'progress' => '10', 'parent' => 0],
            ['id' => 15, 'text' => 'Task-1 ', 'start_date' => '2020-2-20 00:00:00', 'duration' => 2, 'progress' => '.5', 'parent' => 4],
            ['id' => 16, 'text' => 'Task-2 ', 'start_date' => '2020-2-22 00:00:00', 'duration' => 2, 'progress' => '.8', 'parent' => 4],
            ['id' => 17, 'text' => 'Task-3 ', 'start_date' => '2020-2-23 00:00:00', 'duration' => 1, 'progress' => '.7', 'parent' => 4],
            ['id' => 5, 'text' => 'Khebrat', 'start_date' => '2020-2-27 00:00:00', 'duration' => 5, 'progress' => '.6', 'parent' => 0],
            ['id' => 18, 'text' => 'Task-1 ', 'start_date' => '2020-2-27 00:00:00', 'duration' => 2, 'progress' => '.1', 'parent' => 5],
            ['id' => 19, 'text' => 'Task-2 ', 'start_date' => '2020-2-29 00:00:00', 'duration' => 2, 'progress' => '.9', 'parent' => 5],
            ['id' => 20, 'text' => 'Task-3 ', 'start_date' => '2020-3-1 00:00:00', 'duration' => 1, 'progress' => '.3', 'parent' => 5],
        ]);
    }
}
