<?php

namespace Tests\Unit\Http\Requests\Users;

use App\Http\Requests\Users\PurchaseRequest;
use Tests\TestCase;

/**
 * Class PurchaseRequestTest.
 *
 * @covers \App\Http\Requests\Users\PurchaseRequest
 */
final class PurchaseRequestTest extends TestCase
{
    private PurchaseRequest $purchaseRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->purchaseRequest = new PurchaseRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->purchaseRequest);
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
