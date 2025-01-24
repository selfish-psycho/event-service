<?php

use App\Shared\Enums\EventManager\ServicesEnums;
use App\Shared\Services\EventManager\EventManagerService;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

require_once(dirname(__DIR__) . '/vendor/autoload.php');

try {
    //Регистрируем пространство имен сервисов
    Loader::registerNamespace(
        "App",
        Loader::getDocumentRoot() . "/local/App"
    );
} catch (LoaderException $e) {
    //log error
}

/*****
 * Events
 * Зарегистрировать классы событий
 *****/
$eventContainer = EventManagerService::create(ServicesEnums::BASE->value);
$eventContainer->actions()->initEvents();