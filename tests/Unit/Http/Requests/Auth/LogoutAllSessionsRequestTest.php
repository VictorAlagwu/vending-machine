<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\LogoutAllSessionsRequest;
use Tests\TestCase;

/**
 * Class LogoutAllSessionsRequestTest.
 *
 * @covers \App\Http\Requests\Auth\LogoutAllSessionsRequest
 */
final class LogoutAllSessionsRequestTest extends TestCase
{
    private LogoutAllSessionsRequest $logoutAllSessionsRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->logoutAllSessionsRequest = new LogoutAllSessionsRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->logoutAllSessionsRequest);
    }

    public function testAuthorize(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testRules(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
