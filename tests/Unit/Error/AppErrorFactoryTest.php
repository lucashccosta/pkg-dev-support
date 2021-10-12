<?php

declare(strict_types=1);

namespace Tests\Unit\Error;

use Dev\Support\Enums\AppErrorType;
use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Error\AppError;
use Dev\Support\Error\AppErrorFactory;
use PHPUnit\Framework\TestCase;

class AppErrorFactoryTest extends TestCase
{
    public function testShouldBuildAppError()
    {
        $result = AppErrorFactory::build(
            AppResponseCode::SERVER_ERROR(),
            AppErrorType::UNKNOWN_ERROR(),
            'pointer',
            'New app error',
            'A new unknown error occurred',
            []
        );

        self::assertInstanceOf(AppError::class, $result);
    }
}
