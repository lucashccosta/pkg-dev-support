<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use Dev\Support\Common\Collection;
use Dev\Support\Contracts\IResponse;
use Dev\Support\Enums\AppErrorType;
use Dev\Support\Enums\AppResponseCode;
use Dev\Support\Error\AppError;
use Dev\Support\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    private IResponse $response;

    protected function setUp(): void
    {
        parent::setUp();
        $this->response = new Response(
            new Collection(['item' => 'data']),
            new Collection(['item' => 'error'])
        );
    }

    public function testShouldStartFailedStatus()
    {
        self::assertTrue($this->response->isFailed());
    }

    public function testShouldStartSuccessStatus()
    {   
        $response = new Response(
            new Collection(['item' => 'data'])
        );

        self::assertTrue($response->isSuccessful());
    }

    public function testShouldGetAllData()
    {
        $expected = ['item' => 'data'];
        $result = $this->response->getData();

        self::assertIsArray($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldGetAllErrors()
    {
        $expected = ['item' => 'error'];
        $result = $this->response->getErrors();

        self::assertIsArray($result);
        self::assertEquals($expected, $result);
    }

    public function testShouldHasData()
    {
        $result = $this->response->hasData();

        self::assertTrue($result);
    }

    public function testShouldHasNotData()
    {
        $response = new Response(
            new Collection([]),
            new COllection([])
        );

        $result = $response->hasData();

        self::assertFalse($result);
    }

    public function testShouldHasErrors()
    {
        $result = $this->response->hasErrors();

        self::assertTrue($result);
    }

    public function testShouldHasNotErrors()
    {
        $response = new Response(
            new Collection([]),
            new COllection([])
        );

        $result = $response->hasData();

        self::assertFalse($result);
    }

    public function testShouldIsFailed()
    {
        $this->response->setAsFailed();
        $result = $this->response->isFailed();

        self::assertTrue($result);
    }

    public function testShouldIsNotFailed()
    {
        $this->response->setAsSuccess();
        $result = $this->response->isFailed();

        self::assertFalse($result);
    }

    public function testShouldIsSuccessful()
    {
        $this->response->setAsSuccess();
        $result = $this->response->isSuccessful();

        self::assertTrue($result);
    }

    public function testShouldIsNotSuccessful()
    {
        $result = $this->response->isSuccessful();

        self::assertFalse($result);
    }

    public function testShouldSetAsFailed()
    {
        $this->response->setAsFailed();

        self::assertTrue($this->response->isFailed());
    }

    public function testShouldSetAsSuccess()
    {
        $this->response->setAsSuccess();

        self::assertTrue($this->response->isSuccessful());
    }

    public function testShouldRemoveError()
    {
        $this->response->removeError('item');

        self::assertCount(0, $this->response->getErrors());
    }

    public function testShouldRemoveData()
    {
        $this->response->removeData('item');

        self::assertCount(0, $this->response->getData());
    }

    public function testShoulAddError()
    {
        $error = new AppError(
            AppResponseCode::SERVER_ERROR(),
            AppErrorType::UNKNOWN_ERROR(),
            'pointer',
            'New app error',
            'A new unknown error occurred',
            []
        );

        $expected = [
            'item' => 'error',
            'new_item' => $error
        ];

        $this->response->addError('new_item', $error);

        self::assertEquals($expected, $this->response->getErrors());
    }

    public function testShouldAddData()
    {
        $expected = [
            'item' => 'data',
            'new_item' => 'new_data'
        ];

        $this->response->addData('new_item', 'new_data');

        self::assertEquals($expected, $this->response->getData());
    }
}