<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use Tests\TestCase;

/**
 *
 */
class ProjectControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function testGuestCreate()
    {
        $this
            ->postJson(route('webapi.project.create'), [
                'title'  => 'The coolest project ever',
                'domain' => 'example.com',
            ])
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
        ;
    }

    /**
     *
     */
    public function testCreateProject()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this
            ->postJson(route('webapi.project.create'), [
                'title'  => 'The coolest project ever',
                'domain' => 'example.com',
            ])
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'title'   => 'The coolest project ever',
                'domain'  => 'example.com',
                'user_id' => $user->id,
            ])
        ;

        $this->assertEquals(ProjectService::DEFAULT_LENGTH, strlen($response->json('api_key')));

        $this->assertDatabaseHas('projects', ['id' => $response->json('id')]);
    }

    /**
     * @dataProvider invalidData
     */
    public function testInvalidRequest(string $key, string $data)
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this
            ->postJson(route('webapi.project.create'), [
                $key => $data,
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ;
    }

    /**
     *
     */
    public function testGuestUpdate()
    {
        $user = factory(User::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create([
            'user_id' => $user->id,
        ]);

        $this
            ->putJson(route('webapi.project.update', $project), [
                'title'  => 'The coolest project ever',
                'domain' => 'example.com',
            ])
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
        ;
    }

    /**
     *
     */
    public function testUpdateProject()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        /** @var Project $project */
        $project = factory(Project::class)->create([
            'user_id' => $user->id,
        ]);

        $this
            ->putJson(route('webapi.project.update', $project), [
                'title'  => 'The coolest project ever2',
                'domain' => 'example2.com',
                'api_key' => '42',
                'user_id' => -1,
            ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'title'   => 'The coolest project ever2',
                'domain'  => 'example2.com',
                'user_id' => $user->id,
            ])
        ;

        $updatedProject = Project::getQuery()->find($project->id);
        $this->assertEquals($updatedProject->api_key, $project->api_key);
    }

    /**
     *
     */
    public function testUpdateNoProject()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        factory(Project::class)->create([
            'user_id' => $user->id,
        ]);

        $this
            ->putJson(route('webapi.project.update', -1), [
                'title'  => 'The coolest project ever2',
                'domain' => 'example2.com',
                'api_key' => '42',
                'user_id' => -1,
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
        ;
    }

    /**
     * @dataProvider invalidData
     */
    public function testInvalidUpdateRequest(string $key, string $data)
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        /** @var Project $project */
        $project = factory(Project::class)->create([
            'user_id' => $user->id,
        ]);

        $this
            ->putJson(route('webapi.project.update', $project), [
                $key => $data
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ;
    }


    /**
     *
     */
    public function testUpdateNotOwnedProject()
    {
        $user = factory(User::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create([
            'user_id' => $user->id,
        ]);

        $actingUser = factory(User::class)->create();
        $this->actingAs($actingUser);

        $this
            ->putJson(route('webapi.project.update', $project), [
                'title'  => 'The coolest project ever2',
                'domain' => 'example2.com',
                'api_key' => '42',
                'user_id' => -1,
            ])
            ->assertStatus(Response::HTTP_FORBIDDEN)
        ;
    }

    /**
     *
     */
    public function testGetOwned()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        factory(Project::class, 10)->create([
            'user_id' => $user->id,
        ]);

        $this
            ->getJson(route('webapi.project.available'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(10)
        ;
    }

    /**
     *
     */
    public function testGetOwnedGuest()
    {
        $this
            ->getJson(route('webapi.project.available'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
        ;
    }

    /**
     * @return array
     */
    public function invalidData()
    {
        return [
            ['domain', 'example.com'],
            ['title',  'Invalid project'],
        ];
    }
}
