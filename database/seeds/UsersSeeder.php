<?php

use App\Models\User;
use App\Models\Project;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();
        Project::query()->truncate();

        DB::beginTransaction();

        $mainUser = factory(User::class)->create([
            'email' => 'pavel.polshkov@gmail.com',
            'name'  => 'Pavel Polshkov',
            'password' => '123456',
        ]);

        factory(Project::class, 10)->make()->each(function (Project $project) use ($mainUser) {
            $mainUser->ownedProjects()->save($project);
        });

        factory(User::class, 100)->create()->each(function (User $user) {

            factory(Project::class, mt_rand(0, 4))->make()->each(function (Project $project) use ($user) {
                $user->ownedProjects()->save($project);
            });

        });

        DB::commit();
    }
}
