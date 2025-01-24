<?php

namespace App\Shared\Contracts\Events;

interface ActionInterface
{
    /**
     * Метод подключает описанные кастомные события
     * @return void
     */
    public function initEvents(): void;
}
