<?php

namespace Tests\Unit;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;
use Mockery;
use Tests\Traits\CreateUserTestHelper;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    use CreateUserTestHelper;
    protected $service;
    protected $repository;
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Faker\Factory::create();

        $this->repository = Mockery::mock(UserRepositoryInterface::class);

        $this->service = new UserService($this->repository);
    }

    public function test_create_user(): void
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'type' => 'personal',
            'password' => bcrypt('123456'),
        ];

        $this->repository
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($user) use ($data) {
                return $user['name'] === $data['name'] &&
                    $user['email'] === $data['email'] &&
                    $user['phone'] === $data['phone'] &&
                    password_verify('123456', $user['password']) &&
                    $user['type'] === $data['type'];
            }))->andReturn(new User($data));


        $result = $this->service->create($data);

        $this->assertEquals($data['name'], $result->name);
        $this->assertEquals($data['email'], $result->email);
        $this->assertEquals($data['phone'], $result->phone);
        $this->assertEquals($data['type'], $result->type);
    }

    public function test_update_user(): void
    {
        $user = $this->executeCreateUser();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];

        $id = 1;

        $this->repository
            ->shouldReceive('update')
            ->once()
            ->with($id, Mockery::on(function ($user) use ($data) {
                return $user['name'] === $data['name'] &&
                    $user['email'] === $data['email'] &&
                    $user['phone'] === $data['phone'];
            }))
            ->andReturn(new User(array_merge(['id' => 1], $data)));

        $result = $this->service->update($id, $data);

        $this->assertEquals($data['name'], $result->name);
        $this->assertEquals($data['email'], $result->email);
        $this->assertEquals($data['phone'], $result->phone);
    }

    public function test_delete_user(): void
    {
        $this->executeCreateUser();

        $this->repository
            ->shouldReceive('delete')
            ->once()
            ->with(1)
            ->andReturn(true);

        $result = $this->service->delete(1);

        $this->assertTrue($result);
    }

    public function test_find_user(): void
    {
        $user = $this->executeCreateUser();

        $this->repository
            ->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($user);

        $result = $this->service->find(1);

        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->name, $result->name);
        $this->assertEquals($user->email, $result->email);
        $this->assertEquals($user->phone, $result->phone);
        $this->assertEquals($user->type, $result->type);
    }

    public function test_get_by_email(): void
    {
        $user = $this->executeCreateUser();

        $this->repository
            ->shouldReceive('getByEmail')
            ->once()
            ->with($user->email)
            ->andReturn($user);

        $result = $this->service->getByEmail($user->email);

        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->name, $result->name);
        $this->assertEquals($user->email, $result->email);
        $this->assertEquals($user->phone, $result->phone);
        $this->assertEquals($user->type, $result->type);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
