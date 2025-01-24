<?php

namespace App\Shared\Contracts\Events;

/**
 * Интерфейс описания событий сущности.
 * Методы событий необходимо называть именами самих событий, например "OnAfterCrmContactAdd"
 */
interface EventsInterface
{
    /**
     * Определение модуля для подключения события
     * @return string
     */
    public static function getModule(): string;
}
