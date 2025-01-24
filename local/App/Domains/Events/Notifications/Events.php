<?php

namespace App\Domains\Events\Notifications;

use App\Shared\Contracts\Events\EventsInterface;

class Events implements EventsInterface
{
    public static function getModule(): string
    {
        return 'im';
    }

    /**
     * Событие перед отправкой уведомления или сообщения
     * @param $fields
     * @return bool
     */
    public static function OnBeforeMessageNotifyAdd(&$fields): bool
    {
        if ($fields['TO_USER_ID'] == 12) {
            //Пример переопределения текста уведомления
            $fields['MESSAGE'] = 'Уведомление переопределено!';
        } elseif($fields['TO_USER_ID'] == 13) {
            //Пример отмены отправки уведомления
            return false;
        }

        return true;
    }
}
