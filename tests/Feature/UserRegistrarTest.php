<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Auth\Contracts\Registrar;
use App\Services\Auth\Exceptions\LoginExistsException;
use App\Services\Auth\UserRegistrar;
use App\Services\UserService;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserRegistrarTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testProvider()
    {
        $registrar = app(Registrar::class);

        $this->assertNotNull($registrar);
    }

    /**
     * @covers UserRegistrar::getUserByLogin()
     *
     * @dataProvider loginProvider
     *
     * Tests getting a user by login
     *
     * @param string $login
     * @param string $type
     */
    public function testGetUserByLogin(string $login, string $type)
    {
        $registrar = app(Registrar::class);

        $user = factory(User::class)->create([
            $type => $login
        ]);

        $this->assertNotNull($user);

        $userFound = $registrar->getUserByLogin($login);

        $this->assertNotNull($userFound);

        $this->assertEquals($user->id, $userFound->id);
    }
    /**
     * @covers UserRegistrar::getUserByLogin()
     *
     * @dataProvider loginProvider
     *
     * Tests getting a user by login
     *
     * @param string $login
     * @param string $type
     */
    public function testGetUserByLoginNull(string $login, string $type)
    {
        $registrar = app(Registrar::class);

        $userFound = $registrar->getUserByLogin($login . rand(0, 100000));

        $this->assertNull($userFound);
    }

    /**
     * @covers UserRegistrar::register()
     *
     * @dataProvider loginProvider
     *
     * Tests registering user
     *
     * @param $login string
     */
    public function testRegister(string $login)
    {
        $registrar = app(Registrar::class);

        $user = $registrar->register($login, 'secret');

        $this->assertNotNull($user->id);
    }

    /**
     * @covers UserRegistrar::register()
     *
     * @dataProvider loginProvider
     *
     * Tests exception with existing login
     *
     * @param $login string
     * @param $type  string
     *
     */
    public function testRegisterLoginExists(string $login, string $type)
    {
        $registrar = app(Registrar::class);

        factory(User::class)->create([
            $type => $login
        ]);

        $this->expectException(LoginExistsException::class);
        $registrar->register($login, 'secret');
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
