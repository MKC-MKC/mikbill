# MikBiLL PHP SDK

MikBiLL PHP SDK для работы с клиентами. Получение токена, данных клиентов. Управление подписками, отписками и т.д...

## ⚙️ Рекомендации, зависимости, стандарты

- Рекомендуемая версия PHP: **>=8.0**
- Необходимые расширения:
    - `curl`
    - `json`

- Код полностью соответствует стандартам:
    - [PSR-1](https://www.php-fig.org/psr/psr-1/)
    - [PSR-4](https://www.php-fig.org/psr/psr-4/)

## 📦 Установка

```bash
composer require haikiri/mikbill
```

---

## 📂 Структура

Проект построен на основе официальной структуры API MikBiLL с возможностью расширения и заменой частей кода.

- На что вы можете рассчитывать:
    - [F] - Функционал завершён.
    - [MD] - Основной функционал завершён. (Дочерние методы, возможно, могут быть добавлены позднее)
    - [P] - В приоритете. (По планам завершить в ближайшее время)
    - [MP] - Средний приоритет. (Было бы хорошо иметь, но не критично, когда-нибудь...)
    - [LP] - Низкий приоритет. (Возможно появление базового функционала для некоторых методов в будущем)

Пример официальной API структуры и заполненности этого SDK в процентах:

- **Billing API** [F]
    - Users [F]
- **Cabinet API**
    - [Auth](#4-получение-токена) [F]
    - [Tickets](#9-тикеты-создание-отправка-чтение) [F]
    - [Common](#10-common) [F]
    - [Packet](#12-тарифы) [MD]
    - [User](#6-получение-данных-клиента) (>=50%) [MD]
        - Contacts (0%) [MP]
    - Register Hotpost [LP]
        - type 1
        - type 2
    - Payments [LP]
    - Services [MP]
        - Turbo
        - Freeze
        - Real IP
        - Credit
        - Change MAC
        - Money Transfers 🆕
    - [Subscriptions](#8-подписки) [F]
    - Devices 🆕 [LP]
    - Reports [LP]
    - [News](#11-новости) [F]

Эта SDK библиотека будет наполняться по мере необходимости, возможностей и откликов.
Готовые методы и примеры использования будут перечислены в этом файле после проверок и реальных отзывов.
Не стесняйтесь сообщать про работоспособность методов, которые не были перечислены здесь. Контакты в `composer.json`.

> Данное SDK реализуется на интерфейсах, что позволяет при должной сноровке легко заменить реализации кода вашими!

> Обрати внимание:
> Что нет физической возможности всегда следить за всеми изменениями в API, особенно учитывая что оно обновляется тихо.
>
> Например:
> Subscriptions->Other(); был тихо перемещён в директорию MikBiLL Api Subscriptions->All();
> Были добавлены новые методы, без соответствующего уведомления в change log.
> Не смотря на это изменение, API метод ->All() по-прежнему принимает запросы на ->Other()...
>
> Можете посмотреть на официальный список Middleware в документации:
> [Ссылка на документацию](https://documenter.getpostman.com/view/5969645/TVCfXTtK#b7e82f1a-c4d7-4c9b-a126-a23d67de8c6f)

> P.S. Ваш используемый список middleware для клиентов доступен через следующий метод:
> `$MikBiLL->cabinet->Subscriptions()->getMiddlewares()`;

---

### Ошибки и исключения

Проект поддерживает легкую обработку ошибок с помощью исключений.
Если вам необходимо более детальная возможность отлова ошибок, вы можете заменить входную точку этого SDK на свой класс.
Пример с чего начать собственную реализацию входной точки SDK смотри по ссылке:
[Своя реализация sendRequest. Строка 100.](https://github.com/MKC-MKC/mikbill/blob/8dd48465332bc0a675ada26b199ce473c163040c/info.md?plain=1#L100)

- Исключения, которые могут быть выброшены в стандартной реализации SDK:
    - `BillApiException` — отлавливает ответы биллинга и возвращает оригинальный код и текст ошибки.
    - `UnauthorizedException` — вызывается если произошла ошибка получения данных в следствии ошибки авторизации.
    - `Exception` или `Throwable` — используйте их для отлова всех остальных ошибок.

## 🧯 Обработка ошибок

Оборачивай вызовы в `try-catch` чтобы отловить исключения:

```php
try {
    /**
    * Здесь выполняйте запросы к API, чтобы отлавливать ошибки.
    */

} catch (\Haikiri\MikBiLL\Exception\UnauthorizedException $e) {
    // Сами придумаете как обрабатывать такие ошибки...
	echo "<hr><h2>Не удалось авторизовать запрос: <code>[{$e->getCode()}]</code></h2>";
	echo $e->getMessage();
} catch (\Haikiri\MikBiLL\Exception\BillApiException $e) {
	echo "<hr><h2>MikBiLL прислал в ответ ошибку: <code>[{$e->getCode()}]</code></h2>";
	echo $e->getMessage();
} catch (\Exception $e) {
	echo "<hr><h2>Неизвестная ошибка: <code>[{$e->getCode()}]</code></h2>";
	echo $e->getMessage();
}
```

## 📚 Ссылки

- [Ссылка на этот SDK проект](https://github.com/MKC-MKC/mikbill)
- [Примеры использования API в Postman](https://documenter.getpostman.com/view/5969645/TVCfXTtK)
- [Установка и настройка API сервера](https://wiki.mikbill.pro/billing/external/api_cabinet)

---

## 💬 Напоследок:

Изначально, метод `sendRequest` основан на идее из `kagatan/mb-client-api`, но там он `private`,
даже не `protected`, и это ломает всю прелесть composer и не даёт возможности расширятся...

Здесь же `sendRequest` – публичный, абстрактный и на интерфейсах, что позволяет неограниченно взаимодействовать с API.
В целом, я думаю, `kagatan/mb-client-api` изначально был сделан как пример и быстрый старт для новичка, и исходной целью
не являлось писать полноценный, крупный и тяжёлый SDK, а всего лишь базовый минимальный пример получения данных клиента.

Обрати внимание, что почти над каждым методом в исходном коде были оставлены комментарии.
Но некоторые поля описаны неполно, либо вообще не описаны, потому что официальной документации на каждое поле БД – нет.
Будет круто, если ты поможешь заполнить пробелы и знаешь что за что отвечает...

Если в каком-то объекте нет нужной модели, нет времени ждать внесения изменений, ты можешь использовать метод:
`getAsArray` – он вернёт тебе полный response["data"] массив данных, напрямую из запроса.

> Если хочешь дополнить библиотеку — напиши по контактам в `composer.json`.

---

# 🚀 Пример использования

## 1. Инициализация проекта

Используй эту базовую конструкцию где-нибудь в своём проекте, чтобы инициализировать SDK:

```php
require "vendor/autoload.php";

use Haikiri\MikBiLL\MikBiLLApi;

$MikBiLL = new MikBiLLApi(
    url: "https://api.example.com/", # Твой Api сервер.
    key: "yourApiSignKey", # Твой Api ключ для подписи запросов.
);
```

## 2. Логирование

Есть возможность записывать все json ответы в стандартный вывод error_log:

```php
$MikBiLL::$debug = true;
```

## 3. Проксирование

Если по какой-либо причине есть необходимость в прокси-сервере:

```php
$MikBiLL->isProxy = false; # true чтобы включить
$MikBiLL->proxy_addr = "10.11.12.13";
$MikBiLL->proxy_port = 8080;
$MikBiLL->proxy_user = "userName";
$MikBiLL->proxy_pass = "userPassword";
```

> [!NOTE]  
> По умолчанию используется socks5. Ты можешь добавить следующий параметр для использования других версий, например 4:

```php
$MikBiLL->proxy_type = CURLPROXY_SOCKS4;
```

## 4. Получение токена

Токен можно получить двумя вариантами:

- По UID клиента — через подписанный запрос в Billing API.
- По логину и паролю — через Cabinet API.

> [!IMPORTANT]
> Обрати внимание, что:
> Для работы с клиентом через `cabinet` сначала необходимо получить и записать токен клиента через setUserToken.
> Для работы с админ запросами через `billing` нужен ключ для подписи billing запросов (см. ШАГ 1 - использования SDK).

Пример получения токена клиента по его UID:

```php
$billing_uid = 13; # UID клиента в MikBiLL.
$token = $MikBiLL->billing->Users()->getUserToken(uid: $billing_uid);
```

Пример получения токена по логину и паролю:

```php
$token = $MikBiLL->cabinet->Auth()
	->login("userLogin", "userPassword")
	->getToken();

echo $token
	? "Успешно авторизовались."
	: "Не удалось авторизоваться.";
```

## 5. Хранение и использование токена

Токен необходимо сразу-же сохранить во внутреннем хранилище которое реализуется интерфейсом:

```php
$MikBiLL->setUserToken(token: $token);
```

Ты можешь запросить токен в любой момент используя следующий геттер:

```php
$MikBiLL->getUserToken();
```

Пример как увидеть токен на странице php:

```php
echo "<h3>token:</h3>";
echo "<code style='font-size: 18px;'>{$MikBiLL->getUserToken()}</code><hr>";
```

## 6. Получение данных клиента

Ты можешь получить данные клиента используя ранее полученный токен:

```php
$user = $MikBiLL->cabinet->User()->getUser();
echo "<h2>[{$user->getUserFirstName()} {$user->getUserMiddleName()}]</h2>"; # Пример использования модели.
echo "<h3>Массив данных клиента:</h3>";
echo "<pre>" . print_r($user->getData(), true) . "</pre><hr>"; # Пример просмотра массива, если не устраивают модели.
```

## 7. Поиск клиента

Ты можешь искать клиентов по определённому критерию и обработать их:

```php
# Пример поиска всех клиентов у которых 'state' равен (=) '4' (то есть удалён):
$searchResult = $MikBiLL->billing->Users()->searchUser(
    key: "state",     # Указываем ключ 'state'
    value: "4",       # state - это статус клиента: (1 - обычный, 2 - заморожен, 3 - отключен, 4 - удален)
    operator: "=",    # Возможные операторы: ['<', '=', '>', '>=', '!='] или ['меньше', 'равно', 'больше', 'больше или равно', 'не равно']
);

echo "<h3>Список удалённых клиентов:</h3>";
foreach ($searchResult->getUsers() as $user) {
    echo "<h2>[uid: {$user->getUserId()}] – {$user->getUserFirstName()} {$user->getUserMiddleName()}</h2>";
}
```

Простой вариант, если тебе нужны данные только конкретного клиента по его UID:

> Обрати внимание, что биллинг через поиск возвращает только основные данные, нежели по токену через API кабинета.
> Это значит, что большая часть возвращаемой модели окажется пустой.

```php
echo "<h3>Данные конкретного клиента:</h3>";
$billing_uid = 13; # UID клиента в MikBiLL.
$user = $MikBiLL->billing->Users()->searchUser(value: $billing_uid)->getOne();
echo "<h2>[uid: {$user->getUserId()}] – {$user->getUserFirstName()} {$user->getUserMiddleName()}</h2>";
```

## 8. Подписки

Ты можешь увидеть список всех доступных подписок клиенту на данный момент.

> После обновления API, появилась возможность прописывать в аргументе сервис, чтобы работать с определённым middleware.

```php
echo "<h3>Доступные подписки клиенту:</h3>";
$middleware = "other"; # Название сервиса. Используйте "other" чтобы получить все доступные пользовательские подписки.

$subs = $MikBiLL->cabinet->Subscriptions()->getSubscriptions(service: $middleware);
foreach ($subs->getSubscription() as $sub) {
    echo "<hr><h2><code>[id:{$sub->getId()}] " . $sub->getName() . "</code></h2>";
    echo "<li>Цена: {$sub->getServicePrice()} {$sub->getCurrency()}.</li>";
    echo "<p>Описание: {$sub->getDescription()}</p>";
}
```

Можно подписать клиента на услугу по её идентификатору и названию сервиса.

- `1` - активировать услугу
- `0` - отключить услугу. (можно оставить пустым для отключения)

🆕 В аргументе service: необходимо указывать название услуги.
Актуальный список middleware можно узнать в официальном MikBiLL API:
[Ссылка на документацию](https://documenter.getpostman.com/view/5969645/TVCfXTtK#aa0c7b39-2525-44a7-a1f6-d8aa7f9b8677)

> К сожалению, нет возможности проверить middleware подписки. Однако, "other" возвращает все доступные подписки клиента.

Объяви переменные:

```php
$id = 123; # ID услуги.
$middleware = "wink"; # Название сервиса. Используйте "other" чтобы получить все доступные пользовательские подписки...
```

Вот пример как подписать клиента на услугу:

```php
$status = $MikBiLL->cabinet->Subscriptions()->setSubscription(id: $id, activate: 1, service: $middleware);

echo $status
	? "Успешно оформили подписку №$id сервиса $service."
	: "Не удалось оформить подписку №$id сервиса $service.";
```

Пример как отписать клиента от услуги:

```php
$status = $MikBiLL->cabinet->Subscriptions()->setSubscription(id: $id, service: $middleware);

echo $status
	? "Успешно отписались от подписки №$id сервиса $service."
	: "Не удалось отписаться от подписки №$id сервиса $service.";
```

> Появилась возможность получить список доступных Middleware подписок для клиента.
> Для удобства были сделаны модели и массивы. Можешь использовать вариант "как-есть" для ручной обработки данных.

Пример получения списка доступных Middleware:

```php
echo "<h3>Доступные Middleware как модель:</h3>";
$wares = $MikBiLL->cabinet->Subscriptions()->getMiddlewares();
foreach ($wares->getMiddleware() as $ware) {
	echo "<hr><h2><code>[id:{$ware->getId()}] " . $ware->getName() . "</code></h2>";
}
```

Пример использования после преобразования в массив:

```php
echo "<h3>Доступные Middleware как массив:</h3>";
$wares = $MikBiLL->cabinet->Subscriptions()->getMiddlewares();
foreach ($wares->getAsArray() as $ware) {
	echo "<hr><h2><code>[id:{$ware["id"]}}] " . $ware["name"] . "</code></h2>";
}
```

У данного метода есть вариант вернуть данные "как-есть" для более ручной обработки:

```php
echo "<h3>Массив Middleware как-есть:</h3>";
$wares = $MikBiLL->cabinet->Subscriptions()->getMiddlewares()->getAsIs();
echo "<pre>" . print_r($wares, true) . "</pre>";
```

## 9. Тикеты: Создание, отправка, чтение

Клиент может увидеть все свои тикеты:

```php
echo "<h3>Тикеты клиента:</h3>";
$tickets = $MikBiLL->cabinet->Tickets()->getTickets();
foreach ($tickets->getMessages() as $ticket) {
	$status = $ticket->isClosed() ? "📛 [закрыто]" : "⏳ [открыто]";
	echo "<hr><h2><small>$status</small> Обращение: <code>[id:{$ticket->getId()}]</code> | открыто " . ($ticket->getDate()?->format("d.m.Y в H:i:s") ?? "") . "</h2>";
	echo "<p>Первое сообщение:</p><code>{$ticket->getMessage()}</code>";
}
//echo "<pre>" . print_r($tickets->getAsArray(), true) . "</pre>";
```

Клиент может создать новый тикет:

```php
$text = "Это сообщение с которым будет создан тикет.";
$ticket = $MikBiLL->cabinet->Tickets()->newTicket($text);

echo $ticket->getId()
	? "<hr><h2><code>Зарегистрировано новое обращение [id:{$ticket->getId()}]</code></h2>"
	: "<hr><h2><code>Не удалось зарегистрировать обращение.</code></h2>";

//echo "<pre>" . print_r($ticket->getData(), true) . "</pre>";
```

Клиент может отправлять сообщения в тикет:

```php
$id = 3; # ID тикета.
$text = "Это сообщение будет дополнено в тикет.";
$sentStatus = $MikBiLL->cabinet->Tickets()->sendMessage(ticketId: $id, message: $text);
echo $sentStatus
	? "<hr><h2><code>Сообщение отправлено.</code></h2>"
	: "<hr><h2><code>Не удалось отправить сообщение.</code></h2>";
```

Клиент может видеть переписку в выбранном тикете:

```php
$id = 3; # ID тикета.
$tickets = $MikBiLL->cabinet->Tickets()->getTicketsDialog(ticketId: $id);
foreach ($tickets->getMessages() as $ticket) {
	$type = $ticket->isMessageFromClient() ? "клиент" : "оператор";

	$name = $ticket->isMessageFromClient()
		? trim("{$ticket->getUserFirstName()} {$ticket->getUserMiddleName()}") # Обращаемся к клиенту по Имени и Отчеству.
		: $ticket->getOperatorLogin();

	echo "<hr><p>[Сообщение №{$ticket->getMessageId()}] написал $type <b>$name</b></p>";
	echo "<p>Сообщение:</p><code>{$ticket->getMessageTest()}</code>";
}
```

Для большей гибкости, ты можешь посмотреть массив сообщений выбранного тикета:

```php
$id = 3; # ID тикета.
echo "<h3>Массив сообщений тикета #$id:</h3>";
$ticket = $MikBiLL->cabinet->Tickets()->getTicketsDialog(ticketId: $id);
echo "<pre>" . print_r($ticket->getAsArray(), true) . "</pre>";
```

## 10. Common

Ты можешь получить IP адрес клиента:

```php
$getIp = $MikBiLL->cabinet->Common()->getIp();
echo "<h3>Получаем: IP клиента</h3>";
echo "<ul>";
echo "<li>IP из модели: <code>{$getIp->getIp()}</code></li>";
echo "<li>IP из массива: <code>" . $getIp->getData()["ip"] . "</code></li>";
echo "</ul>";
//echo "<pre>" . print_r($getIp->getData(), true) . "</pre>";
```

Ты можешь получить время сервера:

```php
$getDate = $MikBiLL->cabinet->Common()->getDate();
echo "<h3>Получаем: Дата и Время</h3>";
echo "<ul>";
echo "<li>Управляемая дата и время: <code>" . $getDate->getDateTime()->format("d.m.Y H:i:s") . "</code></li>";
echo "<li>Дата из массива: <code>" . $getDate->getData()["format"] . "</code></li>";
echo "<li>Time Stamp: <code>" . $getDate->getTimeStamp() . "</code></li>";
echo "</ul>";
//echo "<pre>" . print_r($getDate->getData(), true) . "</pre>";
```

Ты можешь узнать версию MikBiLL:

```php
$getVersion = $MikBiLL->cabinet->Common()->getVersion();
echo "<h3>Получаем: Версия MikBiLL</h3>";
echo "<ul>";
echo "<li>Версия: <code>$getVersion</code></li>";
echo "</ul>";
```

Ты можешь получить меню личного кабинета:

```php
$getMenu = $MikBiLL->cabinet->Common()->getMenu();
echo "<h3>Получаем: Меню</h3>";
echo "<ul>";
foreach ($getMenu->getMenus() as $menu) {
	echo "<li><a id='{$menu->getId()}' href='{$menu->getUri()}' class='{$menu->getIcon()}'>{$menu->getName()}</a></li>";
}
echo "</ul>";
//echo "<pre>" . print_r($getMenu->getAsArray(), true) . "</pre>";
```

Ты можешь получить данные организации:

```php
$getContact = $MikBiLL->cabinet->Common()->getContact();
echo "<h3>Получаем: Контактные данные организации</h3>";
echo "<ul>";
echo "<li>Компания: <code>{$getContact->getName()}</code></li>";
echo "<li>Адрес: <code>{$getContact->getAddress()}</code></li>";
echo "<li>Сайт: <code>{$getContact->getSite()}</code></li>";
echo $getContact->getEmail() ? "<li>Email: <code>{$getContact->getEmail()}</code></li>" : "";
echo $getContact->getPhoneName1() ? "<li>{$getContact->getPhoneName1()}: <code>{$getContact->getPhoneNumber1()}</code></li>" : "";
echo $getContact->getPhoneName2() ? "<li>{$getContact->getPhoneName2()}: <code>{$getContact->getPhoneNumber2()}</code></li>" : "";
echo $getContact->getPhoneName3() ? "<li>{$getContact->getPhoneName3()}: <code>{$getContact->getPhoneNumber3()}</code></li>" : "";
echo "<li>Показать карту: <code>" . ($getContact->isShowMap() ? "Да" : "Нет") . "</code></li>";
echo "</ul>";
//echo "<pre>" . print_r($getContact->getData(), true) . "</pre>";
```

Ты можешь получить некую конфигурацию:

> Метод не реализован полностью, и возможно, вряд ли появится желание заполнять эту модель.
> Используйте getAsArray() для ручной работы с массивами.

```php
$getConfig = $MikBiLL->cabinet->Common()->getConfig();
echo "<h3>Получаем: Конфигурацию (массив)</h3>";
echo "<pre>" . print_r($getConfig->getAsArray(), true) . "</pre>";
```

## 11. Новости

Клиент может увидеть (персональные) новости:

```php
$getNews = $MikBiLL->cabinet->News()->getNews();
echo "<h3>Получаем: Новости</h3>";
foreach ($getNews->getAllNews() as $news) {
	echo "<hr><ul>";
	echo "<li>ID: <code>{$news->getId()}</code></li>";
	echo "<li>Тема: <code>{$news->getSubject()}</code></li>";
	echo "<li>Новость:<br><textarea maxlength=\"50\">{$news->getText()}</textarea></li>";
	echo "</ul>";
}
```

## 12. Тарифы

Клиент может получить список доступных тарифов:

```php
$getPackets = $MikBiLL->cabinet->Packet()->getPackets();
echo "<h3>Получаем: Список тарифов</h3>";
foreach ($getPackets->getPacket() as $packet) {
	echo "<hr><ul>";
	echo "<li>Тариф <code>{$packet->getName()} [{$packet->getId()}]</code></li>";
	echo "<li>Цена: <code>{$packet->getPrice()} {$packet->getCurrency()}.</code></li>";
	echo "<li>Цена со скидкой: <code>{$packet->getPriceDiscounted()} {$packet->getCurrency()}.</code></li>";
	echo "</ul>";
}
```

Можно посмотреть детали тарифа по его ID:

> Метод не реализован полностью, и возможно, вряд ли появится желание заполнять эту модель.
> Используйте getAsArray() для ручной работы с массивами.

```php
$id = 31; #	ID Тарифа.
$packet = $MikBiLL->cabinet->Packet()->getPacketInfo(packetId: $id);
echo "<h3>Получаем: Детали тарифа #$id</h3>";
echo "<ul>";
echo "<li>Тариф: <code>{$packet->getName()} [id:{$packet->getId()}]</code></li>";
echo "<li>Цена: <code>{$packet->getAsArray()["fixed_cost"]} {$packet->getAsArray()["currency"]}.</code></li>";
echo "<li>Суточная цена: <code>{$packet->getDailyCost()} {$packet->getCurrency()}.</code></li>";
echo "<li>Скорость: <code>{$packet->getSpeedRate()}</code></li>";
echo "</ul>";
echo "<pre>" . print_r($packet->getAsArray(), true) . "</pre>";
```

