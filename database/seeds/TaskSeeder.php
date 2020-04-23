<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@realtair.com'
        ])->each(function ($user){
            $user->tasks()->createMany(
                factory(App\Task::class, 25)->make()->toArray()
            );
        });

        factory(App\User::class)->create([
            'first_name' => 'Juan',
            'last_name' => 'Cruz',
            'email' => 'juancruz@realtair.com'
        ])->each(function ($user){
            $user->tasks()->createMany(
                factory(App\Task::class, 25)->make()->toArray()
            );
        });
    }
}
