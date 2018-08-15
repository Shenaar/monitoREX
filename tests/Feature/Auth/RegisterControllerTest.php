<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use App\Services\UserService;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @covers RegisterController::register()
     *
     * @dataProvider loginProvider
     *
     * @param string $login
     * @param string $type
     */
    public function testRegisterSuccess(string $login, string $type)
    {

        $response = $this
            ->postJson(route('webapi.auth.register', [
                'login'    => $login,
                'password' => 'secret',
            ]))
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['id'])
            ->assertJson([
                $type => $login,
            ])
        ;

        $id = $response->json('id');
        $user = User::query()->find($id);
        $this->assertNotNull($user);

        $this->assertTrue(Hash::check('secret', $user->password));
    }

    /**
     * @covers RegisterController::register()
     *
     * @dataProvider loginProvider
     *
     * @param string $login
     * @param string $type
     */
    public function testRegisterLoginExists(string $login, string $type)
    {
        $user = factory(User::class)->create([
            $type => $login
        ]);

        $this
            ->postJson(route('webapi.auth.register', [
                'login' => $login,
                'password' => 'secret',
                'rules' => true,
            ]))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonFragment(['message' => 'User with credentials "' . $login . '" already exists']);
    }

    /**
     * @return string[][]
     */
    public function loginProvider()
    {
        return [
            ['dummy@example.com', 'email'],
        ];
    }
}
