<?php

namespace Tests\Unit\Common;

use Dev\Support\Common\CloneArrayTrait;
use PHPUnit\Framework\TestCase;

class CloneArrayTraitTest extends TestCase
{
    private object $trait;

    protected function setUp(): void
    {
        parent::setUp();
        $this->trait = self::getObjectForTrait(CloneArrayTrait::class);
    }

    public function testShouldCloneArrayWhenParamIsArrayValue()
    {
        $input = ['index' => ['value' => 'SOME_VALUE']];
        $expected = ['index' => ['value' => 'SOME_VALUE']];
        $result = $this->trait->cloneArray($input);

        self::assertIsArray($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldCloneArrayWhenParamIsObjectValue()
    {
        $object = (object) ['value' => 'SOME_VALUE'];
        $input = ['index' => $object];
        $expected = ['index' => $object];
        $result = $this->trait->cloneArray($input);

        $this->assertIsArray($result);
        $this->assertEquals($expected, $result);
    }
}
