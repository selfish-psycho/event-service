# event-service
Сервис событий Bitrix24 на архитектуре DDD

Сервис, регистрирующий классы с помощью <code>\Bitrix\Main\EventManager::getInstace()->addEventHandler()</code>. <b>Важно:</b> методы классов описаний событий должны называться так же, как и сами события.
