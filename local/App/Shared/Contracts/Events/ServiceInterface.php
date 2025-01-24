<?php

namespace App\Shared\Contracts\Events;

interface ServiceInterface
{
    public function actions(): ActionInterface;
}