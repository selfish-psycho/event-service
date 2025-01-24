<?php

namespace App\Shared\Services\EventManager;

use App\Shared\Contracts\BaseServiceInterface;
use App\Shared\DI\Container;
use App\Shared\Enums\EventManager\ServicesEnums;
use App\Shared\Services\EventManager\BaseEvent\BaseEventService;

class EventManagerService implements BaseServiceInterface
{
    /**
     * @inheritDoc
     */
    public static function create(int $typeId): mixed
    {
        return match ($typeId) {
            ServicesEnums::BASE->value => (new Container())->get(BaseEventService::class)
        };
    }
}