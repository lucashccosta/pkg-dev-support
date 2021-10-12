<?php

declare(strict_types=1);

namespace Tests\Unit\Error;

use Dev\Support\Enums\AppErrorType;
use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Error\AppError;
use PHPUnit\Framework\TestCase;

class AppErrorTest extends TestCase
{
    private AppError $error;

    protected function setUp(): void
    {
        parent::setUp();
        $this->error = new AppError(
            AppResponseCode::SERVER_ERROR(),
            AppErrorType::UNKNOWN_ERROR(),
            'pointer',
            'New app error',
            'A new unknown error occurred',
            []
        );
    }

    public function testShouldCreateAppError()
    {
        self::assertInstanceOf(AppError::class, $this->error);
    }

    public function testShouldGetCode()
    {
        $expected = AppResponseCode::SERVER_ERROR();
        $result = $this->error->getCode();

        self::assertInstanceOf(AppResponseCode::class, $result);
        self::assertEquals($expected, $result);
    }

    public function testShouldGetErrorType()
    {
        $expected = AppErrorType::UNKNOWN_ERROR();
        $result = $this->error->getErrorType();

        self::assertInstanceOf(AppErrorType::class, $result);
        self::assertEquals($expected, $result);
    }

    public function testShouldGetPointer()
    {
        $expected = 'pointer';
        $result = $this->error->getPointer();

        self::assertIsString($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldGetTitle()
    {
        $expected = 'New app error';
        $result = $this->error->getTitle();

        self::assertIsString($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldGetDetail()
    {
        $expected = 'A new unknown error occurred';
        $result = $this->error->getDetail();

        self::assertIsString($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldGetMetadata()
    {
        $expected = [];
        $result = $this->error->getMeta();

        self::assertIsArray($result);
        self::assertEquals($expected, $result);
    }
}
