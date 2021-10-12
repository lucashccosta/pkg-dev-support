<?php

namespace Tests\Unit\Enums;

use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Enums\BaseEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BaseEnumTest extends TestCase
{
    public function testShouldGetAllowedValues()
    {
        $expected = [
            'SUCCESS' => 200,
            'CREATED' => 201,
            'NO_CONTENT' => 204,
            'BAD_REQUEST' => 400,
            'UNAUTHORIZED' => 401,
            'NOT_FOUND' => 404,
            'METHOD_NOT_ALLOWED' => 405,
            'UNPROCESSABEL_ENTITY' => 422,
            'SERVER_ERROR' => 500,
        ];

        self::assertEquals($expected, AppResponseCode::getAllowedValues());
    }

    public function testShouldCallStaticInvalidArgumentException()
    {
        self::expectException(InvalidArgumentException::class);
        AppResponseCode::NOT_EXISTS();
    }

    public function testShouldConstructorInvalidArgumentException()
    {
        self::expectException(InvalidArgumentException::class);
        new AppResponseCode('NOT_EXISTS');
    }

    public function testConstructorValidEnum()
    {
        $firstEnum = new AppResponseCode(AppResponseCode::SUCCESS);
        $secondEnum = new AppResponseCode(AppResponseCode::CREATED);

        self::assertInstanceOf(BaseEnum::class, $firstEnum);
        self::assertInstanceOf(BaseEnum::class, $secondEnum);

        self::assertEquals(200, $firstEnum->getValue());
        self::assertEquals(201, $secondEnum->getValue());
    }

    public function testCallStaticValidEnum()
    {
        $firstEnum = AppResponseCode::SUCCESS();
        $secondEnum = AppResponseCode::CREATED();

        self::assertInstanceOf(BaseEnum::class, $firstEnum);
        self::assertInstanceOf(BaseEnum::class, $secondEnum);

        self::assertSame(200, $firstEnum->getValue());
        self::assertSame(201, $secondEnum->getValue());
    }

    public function testShouldToStringMagicMethod()
    {
        $firstEnum = new AppResponseCode(AppResponseCode::SUCCESS);
        $secondEnum = new AppResponseCode(AppResponseCode::CREATED);

        self::assertSame('200', (string) $firstEnum);
        self::assertSame('201', (string) $secondEnum);
    }
}