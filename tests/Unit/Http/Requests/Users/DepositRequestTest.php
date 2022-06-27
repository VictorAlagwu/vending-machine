<?php

namespace Tests\Unit\Http\Requests\Users;

use App\Http\Requests\Users\DepositRequest;
use Tests\TestCase;

/**
 * Class DepositRequestTest.
 *
 * @covers \App\Http\Requests\Users\DepositRequest
 */
final class DepositRequestTest extends TestCase
{
    private DepositRequest $depositRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->depositRequest = new DepositRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->depositRequest);
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
