<?php

use App\Models\Project;
use App\Models\Report;
use App\Models\User;

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

        factory(Project::class, 9)->make()->each(function (Project $project) use ($mainUser) {
            $mainUser->ownedProjects()->save($project);

            factory(Report::class, 53)->make()->each(function (Report $report)  use ($project) {
                $project->reports()->save($report);
            });
        });

        factory(User::class, 10)->create()->each(function (User $user) {

            factory(Project::class, mt_rand(0, 4))->make()->each(function (Project $project) use ($user) {
                $user->ownedProjects()->save($project);
            });

        });

        DB::commit();
    }
}
