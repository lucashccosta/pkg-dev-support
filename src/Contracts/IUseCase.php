<?php

declare(strict_types=1);

namespace Dev\Support\Contracts;

interface IUseCase
{
    /**
     * @param IRequest $request
     * @param IResponse $response
     * @return void
     */
    public function handle(IRequest $request, IResponse $response): void;
}
