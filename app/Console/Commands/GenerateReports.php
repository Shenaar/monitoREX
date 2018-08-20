<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Report;
use App\Models\User;

use Carbon\Carbon;

use Faker\Factory;
use Faker\Generator;

use Illuminate\Console\Command;


class GenerateReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        /** @var Project $project */
        $projects = User::query()->find(1)->ownedProjects;

        /** @var Generator $faker */
        $faker = Factory::create();

        for (;;) {
            $project = $faker->randomElement($projects);

            factory(Report::class, $faker->numberBetween(1, 3))->make([
                'created_at' => Carbon::now()
            ])->each(function (Report $report) use ($project) {
                $project->reports()->save($report);
            });

            sleep($faker->numberBetween(1, 5));
        }

    }
}
