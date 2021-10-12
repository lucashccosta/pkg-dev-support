<?php

declare(strict_types=1);

namespace Spportz\Support\Contracts;

interface IValidableUseCase
{
    /**
     * @param IRequest $request
     * @param IResponse $response
     * @return bool
     */
    public function isValid(IRequest $request, IResponse $response): bool;
}
