<?php

namespace App\Shared\Services\EventManager\BaseEvent\Actions;

use App\Shared\Contracts\Events\ActionInterface;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

class BaseEventActions implements ActionInterface
{
    /**
     * Метод подключает определённые в соответствующих классах события
     * @return void
     */
    public function initEvents(): void
    {
        //Получаем итератор для всех PHP-файлов в папке с описаниями событий
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                Application::getDocumentRoot() . '/local/App/Domains/Events'
            )
        );

        $regex = new RegexIterator($iterator, '/^.*\.php/i', RegexIterator::GET_MATCH);

        //Проходимся по всем выбранным классам и подключаем их, чтобы для нас они были видны из этого файла
        foreach ($regex as $file => $value) {
            static::eventsClassesLoader($file);
        }

        $interface = '\App\Shared\Contracts\Events\EventsInterface';
        $eventManager = EventManager::getInstance();
        //Проходимся по всем подключенным классам, которые мы видим, чтобы получить не названия файлов, а классы с неймспейсами
        foreach(get_declared_classes() as $class) {
            //Собираем массив классов, наследуемых от интерфейса описания событий
            if (is_subclass_of($class, $interface)) {
                //Инициализируем методы описаний
                foreach (get_class_methods($class) as $method) {
                    if (method_exists($interface, $method)) {
                        continue;
                    }

                    //Регистрируем их в обработчике
                    $eventManager->addEventHandler(
                        $class::getModule(),
                        $method,
                        [$class, $method]
                    );
                }
            }
        }
    }

    /**
     * Метод подключает файлы классов описаний событий
     * @param $class
     * @return void
     */
    private static function eventsClassesLoader($class): void
    {
        if(is_file($class)) {
            include $class;
        }
    }
}
