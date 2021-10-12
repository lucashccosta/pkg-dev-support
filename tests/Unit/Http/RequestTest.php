<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use Dev\Support\Common\Collection;
use Dev\Support\Contracts\ICollection;
use Dev\Support\Contracts\IRequest;
use Dev\Support\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    private IRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new Request(
            new Collection(['item' => 'value'])
        );
    }

    public function testeShouldCreateRequest()
    {
        self::assertInstanceOf(IRequest::class, $this->request);
    }

    public function testShouldGetAllItems()
    {
        $expected = ['item' => 'value'];
        $result = $this->request->all();

        self::assertIsArray($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldClearItems()
    {
        $result = $this->request->clear();

        self::assertInstanceOf(IRequest::class, $result);
        self::assertCount(0, $result->all());
    }

    public function testShouldGetExistedItem()
    {
        $result = $this->request->get('item');

        self::assertEquals('value', $result);
    }
    
    public function testShouldReturnDefaultNullWhenNotExistedItem()
    {
        $result = $this->request->get('item_not_existed');

        self::assertNull($result);
    }

    public function testShouldReturnDefaultWhenNotExistedItem()
    {
        $result = $this->request->get('item_not_existed', 'default_value');

        self::assertEquals('default_value', $result);
    }

    public function testShouldHasItem()
    {
        $result = $this->request->has('item');

        self::assertTrue($result);
    }

    public function testShouldHasNotItem()
    {
        $result = $this->request->has('item_has_not');

        self::assertFalse($result);
    }

    public function testShouldAddItem()
    {
        $expected = ['item' => 'value', 'new_item' => 'new_value'];
        $result = $this->request->with('new_item', 'new_value');

        self::assertInstanceOf(IRequest::class, $result);
        self::assertEquals($expected, $result->all());
    }

    public function testShouldRemoveItem()
    {
        $expected = [];
        $result = $this->request->without('item');

        self::assertInstanceOf(IRequest::class, $result);
        self::assertCount(0, $result->all());
        self::assertEquals($expected, $result->all());
    }
}
