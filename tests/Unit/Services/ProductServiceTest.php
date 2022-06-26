<?php

namespace Tests\Unit\Services;

use App\Repositories\Product\IProductRepository;
use App\Services\ProductService;
use Mockery;
use Mockery\Mock;
use Tests\TestCase;

/**
 * Class ProductServiceTest.
 *
 * @covers \App\Services\ProductService
 */
final class ProductServiceTest extends TestCase
{
    private ProductService $productService;

    private IProductRepository|Mock $productRepository;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepository = Mockery::mock(IProductRepository::class);
        $this->productService = new ProductService($this->productRepository);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->productService);
        unset($this->productRepository);
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
