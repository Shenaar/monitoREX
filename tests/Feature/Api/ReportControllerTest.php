<?php

namespace Tests\Feature\Api;

use App\Models\Project;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

use Tests\TestCase;

/**
 *
 */
class ReportControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateReport()
    {
        $project = factory(Project::class)->create([
            'user_id' => 1,
        ]);

        $report = [
            'class' => 'Illuminate\Database\Eloquent\ModelNotFoundException',
            'file' => '/home/vagrant/monitorex/vendor/laravel/framework/src/Illuminate/Routing/Router.php',
            'line' => 963,
            'message' => 'No query results for model [App\Models\Project].',
            'trace' => 'trace',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ];

        $this
            ->post(route('api.report.create', ['api_key' => $project->api_key]), $report)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($report)
        ;
    }

    public function testCreateReportNoApiKey()
    {
        $project = factory(Project::class)->create([
            'user_id' => 1,
        ]);

        $report = [
            'class' => 'Illuminate\Database\Eloquent\ModelNotFoundException',
            'file' => '/home/vagrant/monitorex/vendor/laravel/framework/src/Illuminate/Routing/Router.php',
            'line' => 963,
            'message' => 'No query results for model [App\Models\Project].',
            'trace' => 'trace',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ];

        $this
            ->post(route('api.report.create', []), $report)
            ->assertStatus(Response::HTTP_FORBIDDEN)
        ;
    }

    public function testCreateReportWrongApiKey()
    {
        $project = factory(Project::class)->create([
            'user_id' => 1,
        ]);

        $report = [
            'class' => 'Illuminate\Database\Eloquent\ModelNotFoundException',
            'file' => '/home/vagrant/monitorex/vendor/laravel/framework/src/Illuminate/Routing/Router.php',
            'line' => 963,
            'message' => 'No query results for model [App\Models\Project].',
            'trace' => 'trace',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ];

        $this
            ->post(route('api.report.create', ['api_key' => $project->api_key . '42']), $report)
            ->assertStatus(Response::HTTP_FORBIDDEN)
        ;
    }
}
