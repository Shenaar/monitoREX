<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @covers LoginController::current()
     *
     */
    public function testGetCurrent()
    {
        $user = factory(User::class)->create([
            'email'    => 'dummy@example.com',
            'password' => 'secret',
        ]);

        $this->actingAs($user);

        $response = $this
            ->get(route('webapi.auth.current'))
            ->assertJson([
                'email'    => 'dummy@example.com',
            ])
        ;

        $this->assertNull($response->json('password'));
    }

    /**
     * @covers LoginController::login()
     *
     * @param string $login
     * @param string $type
     */
    public function testCheckWrongLogin()
    {
        factory(User::class)->create([
            'email'    => 'dummy@example.com',
            'password' => 'secret'
        ]);

        $this
            ->post(route('webapi.auth.login'), [
                'login'    => 'notDummy@example.com',
                'password' => 'secret',
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @covers LoginController::login()
     *
     * @param string $login
     * @param string $type
     */
    public function testCheckWrongPassword()
    {
        factory(User::class)->create([
            'email'    => 'dummy@example.com',
            'password' => 'secret',
        ]);

        $this
            ->post(route('webapi.auth.login'), [
                'login'    => 'dummy@example.com',
                'password' => 'secret1',
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @covers LoginController::login()
     *
     * @param string $login
     * @param string $type
     */
    public function testCheckCorrectCredentials()
    {
        factory(User::class)->create([
            'email'    => 'dummy@example.com',
            'password' => 'secret',
        ]);

        $this
            ->post(route('webapi.auth.login'), [
                'login'    => 'dummy@example.com',
                'password' => 'secret',
            ])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @covers LoginController::logout()
     */
    public function testLogout()
    {
        factory(User::class)->create([
            'email'    => 'dummy@example.com',
            'password' => 'secret',
        ]);

        $this
            ->post(route('webapi.auth.login'), [
                'login'    => 'dummy@example.com',
                'password' => 'secret',
            ])
            ->assertStatus(Response::HTTP_OK);

        $this
            ->get(route('webapi.auth.logout'))
            ->assertStatus(Response::HTTP_OK);
    }
}
