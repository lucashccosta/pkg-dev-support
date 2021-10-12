<?php

namespace Tests\Unit\Common;

use Dev\Support\Common\Collection;
use Dev\Support\Contracts\ICollection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    private ICollection $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->collection = new Collection(['item' => 'value']);
    }

    public function testShouldGetAllItems()
    {
        $expected = ['item' => 'value'];
        $result = $this->collection->all();

        self::assertIsArray($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldClearCollection()
    {
        $result = $this->collection->clear();

        self::assertInstanceOf(Collection::class, $result);
        self::assertCount(0, $result->all());
    }

    public function testShouldContainsItem()
    {
        $result = $this->collection->contains('value');

        self::assertTrue($result);
    }

    public function testShouldNotContainsItem()
    {
        $result = $this->collection->contains('not_contains_value');

        self::assertFalse($result);
    }

    public function testShouldGetExistedItem()
    {
        $result = $this->collection->get('item');

        self::assertEquals('value', $result);
    }
    
    public function testShouldReturnDefaultNullWhenNotExistedItem()
    {
        $result = $this->collection->get('item_not_existed');

        self::assertNull($result);
    }

    public function testShouldReturnDefaultWhenNotExistedItem()
    {
        $result = $this->collection->get('item_not_existed', 'default_value');

        self::assertEquals('default_value', $result);
    }

    public function testShouldHasItem()
    {
        $result = $this->collection->has('item');

        self::assertTrue($result);
    }

    public function testShouldHasNotItem()
    {
        $result = $this->collection->has('item_has_not');

        self::assertFalse($result);
    }

    public function testShoudlGetAllItemKeys()
    {
        $expected = ['item'];
        $result = $this->collection->keys();

        self::assertIsArray($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldCountTotalItems()
    {
        $expected = 1;
        $result = $this->collection->length();

        self::assertIsInt($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldGetMergedItems()
    {   
        $expected = ['item' => 'value', 'new_item' => 'new_value'];
        $newCollection = new Collection(['new_item' => 'new_value']);
        $result = $this->collection->mergeWith(
            ...[$this->collection, $newCollection]
        );

        self::assertInstanceOf(Collection::class, $result);
        self::assertEquals($expected, $result->all());
    }

    public function testShouldAddItem()
    {
        $expected = ['item' => 'value', 'new_item' => 'new_value'];
        $result = $this->collection->with('new_item', 'new_value');

        self::assertInstanceOf(Collection::class, $result);
        self::assertEquals($expected, $result->all());
    }

    public function testShouldRemoveItem()
    {
        $expected = ['item1' => 'value1'];
        $collection = new Collection([
            'item1' => 'value1', 
            'item2' => 'value2'
        ]);

        $result = $collection->without('item2');

        self::assertInstanceOf(Collection::class, $result);
        self::assertCount(1, $result->all());
        self::assertEquals($expected, $result->all());
    }

    public function testShouldGetAllValues()
    {
        $result = $this->collection->values();

        self::assertCount(1, $result);
        self::assertEquals(['value'], $result);
    }
}
