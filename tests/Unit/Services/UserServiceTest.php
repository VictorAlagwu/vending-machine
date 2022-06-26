<?php

namespace Tests\Unit\Services;

use App\Repositories\User\IUserRepository;
use App\Services\UserService;
use Mockery;
use Mockery\Mock;
use Tests\TestCase;

/**
 * Class UserServiceTest.
 *
 * @covers \App\Services\UserService
 */
final class UserServiceTest extends TestCase
{
    private UserService $userService;

    private IUserRepository|Mock $userRepository;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = Mockery::mock(IUserRepository::class);
        $this->userService = new UserService($this->userRepository);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->userService);
        unset($this->userRepository);
    }

    public function testIndex(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testCreate(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testShow(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testUpdate(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testDestroy(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
