<?php

namespace App\Shared\Services\EventManager\BaseEvent;

use App\Shared\Contracts\Events\ActionInterface;
use App\Shared\Contracts\Events\ServiceInterface;
use App\Shared\Services\EventManager\BaseEvent\Actions\BaseEventActions;

class BaseEventService implements ServiceInterface
{
    public function __construct(
        private readonly BaseEventActions $actions
    )
    {
    }

    public function actions(): ActionInterface
    {
        return $this->actions;
    }
}
