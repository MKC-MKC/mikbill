# MikBiLL PHP SDK

MikBiLL PHP SDK для работы с клиентами. Получение токена, данных клиентов. Управление подписками, отписками и т.д...

## ⚙️ Рекомендации, зависимости, стандарты

- Рекомендуемая версия PHP: **8.0 и новее**
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

Проект построен на основе официальной структуры API MikBiLL с возможностью расширения и замен частей кода.
Пример официальной структуры и заполненности в процентах на примере данного проекта:

```plaintext
├─ Billing API
│  └─ Users (100%)
├─ Cabinet API
│  ├─ Auth (100%)
│  │  ├─ Login (100%)
│  │  └─ Phone (100%)
│  ├─ Tickets (100%)
│  ├─ Common
│  ├─ Packet
│  ├─ User (>=50%)
│  │  └─ Contacts (0%)
│  ├─ Register Hotpost
│  │  ├─ type 1
│  │  └─ type 2
│  ├─ Payments
│  ├─ Services
│  │  ├─ Turbo
│  │  ├─ Freeze
│  │  ├─ Real IP
│  │  ├─ Credit
│  │  └─ Change MAC
│  ├─ Subscriptions (100%)
│  ├─ Reports
│  ├─ News
│  └─ Omnicell
```

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
>
> P.S. Ваш список middleware, скорее всего, будет доступен через:
> `$MikBiLL->cabinet->Subscriptions()->getMiddlewares()`;

---

### Ошибки и исключения

Проект поддерживает легкую обработку ошибок с помощью исключений.
Если вам необходимо более детальная возможность отлова ошибок, вы можете заменить входную точку этого SDK на свой класс.
Пример с чего начать собственную реализацию входной точки SDK смотри по ссылке:
[Своя реализация sendRequest. Строка 100.](https://github.com/MKC-MKC/mikbill/blob/8dd48465332bc0a675ada26b199ce473c163040c/info.md?plain=1#L100)

- Исключения, которые могут быть выброшены в стандартной реализации SDK:
    - `InvalidJsonException` — ошибка JSON или ответа от сервера
    - `InvalidTokenException` — отсутствует токен от кабинета
    - `Throwable` — более глубокая мера отлова ошибок

## 🧯 Обработка ошибок

Оборачивай вызовы в `try-catch` чтобы отловить исключения:

```php
try {
    $response = $MikBiLL->billing->Users()->getUserToken();
} catch (InvalidJsonException $e) {
    // Действия при проблемах с json-ответом
} catch (InvalidTokenException $e) {
    // Действия при отсутствии токена
} catch (\Throwable $e) {
    // Действия при всех остальных исключениях
    echo $e->getMessage(); # Выводим текст ошибки.
}
```

## 📚 Ссылки

- [Исходники этого SDK проекта](https://github.com/MKC-MKC/mikbill)
- [Примеры использования API в Postman](https://documenter.getpostman.com/view/5969645/TVCfXTtK)
- [Установка и настройка API сервера](https://wiki.mikbill.pro/billing/external/api_cabinet)

---

## 💬 Напоследок:

Изначально, метод `sendRequest` основан на идее из `kagatan/mb-client-api`, но там он `private`,
даже не `protected`, и это ломает всю прелесть composer и не даёт расширятся...
Здесь же `sendRequest` – публичный, абстрактный и на интерфейсах, что позволяет неограниченно взаимодействовать с API.
В целом, я думаю, `kagatan/mb-client-api` изначально был сделан как пример и быстрый старт для новичка, и исходной целью
не являлось писать полноценный, крупный и тяжёлый SDK, а базовый минимальный пример получения данных клиента.

> Если хочешь дополнить библиотеку — напиши по контактам в `composer.json`.

Почти над каждым методом оставлены комментарии.
Но, некоторые поля описаны неполно, либо вообще не описаны, потому что официальной документации на каждое поле БД – нет.
Будет круто, если ты поможешь заполнить пробелы и знаешь что за что отвечает...
Если в каком-то объекте нет нужной модели, нет времени ждать внесения изменений, ты можешь использовать:
Метод: `getAsArray` – вернёт тебе полный response["data"] массив данных, напрямую из запроса.

---

# 🚀 Пример использования

### 1. Инициализация проекта

Используй `use` для объявления использования MikBiLL Api:

```php
require "vendor/autoload.php";

use Haikiri\MikBiLL\MikBiLLApi;

$MikBiLL = new MikBiLLApi(
    url: "https://api.example.com/", # Твой Api сервер.
    key: "yourApiSignKey", # Твой Api ключ для подписи запросов.
);
```

### 2. Логирование

Есть возможность записывать все json ответы в стандартный вывод error_log:

```php
$MikBiLL::$debug = true;
```

### 3. Проксирование

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

### 4. Пример получения токена

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

### 5. Хранение и использование токена

Токен необходимо сразу-же обязательно сохранить во внутреннем хранилище которое реализуется интерфейсом:

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

### 6. Получение данных клиента

Ты можешь получить данные клиента используя ранее полученный токен.

```php
$user = $MikBiLL->cabinet->User()->getUser();
echo "<h2>[{$user->getUserFirstName()} {$user->getUserMiddleName()}]</h2>";
echo "<h3>Массив данных клиента:</h3>";
echo "<pre>" . print_r($user->getAsArray(), true) . "</pre><hr>";
```

### 7. Поиск клиента

Ты можешь искать клиентов по определённому критерию и обработать их. Если надо работать не с моделями, а с массивами,
то смотри инструкцию в [blob/1.0.0/README.md#L169](https://github.com/MKC-MKC/mikbill/blob/1.0.0/README.md?plain=1#L169)

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

```php
echo "<h3>Данные конкретного клиента:</h3>";
$billing_uid = 13; # UID клиента в MikBiLL.
$user = $MikBiLL->billing->Users()->searchUser(value: $billing_uid)->getOne();
echo "<h2>[uid: {$user->getUserId()}] – {$user->getUserFirstName()} {$user->getUserMiddleName()}</h2>";
```

### 8. Список доступных подписок

Ты можешь увидеть список всех доступных подписок клиенту на данный момент.

```php
echo "<h3>Доступные подписки клиенту:</h3>";
$service = "other"; # Название сервиса. Используйте "other" чтобы получить все доступные пользовательские подписки.

$subs = $MikBiLL->cabinet->Subscriptions()->getSubscriptions(service: $service);
foreach ($subs->getSubscription() as $sub) {
    echo "<hr><h2><code>[id:{$sub->getId()}] " . $sub->getName() . "</code></h2>";
    echo "<li>Цена: {$sub->getServicePrice()} {$sub->getCurrency()}.</li>";
    echo "<p>Описание: {$sub->getDescription()}</p>";
}
```

### 9. Управление подписками на услуги

Можно подписать клиента на услугу по её идентификатору и названию сервиса.

- `1` - активировать услугу
- `0` - отключить услугу. (можно оставить пустым для отключения)

🆕 В аргументе service: необходимо указывать название услуги.
Актуальный список middleware можно узнать в официальном MikBiLL API:
[Ссылка на документацию](https://documenter.getpostman.com/view/5969645/TVCfXTtK#aa0c7b39-2525-44a7-a1f6-d8aa7f9b8677)

Пример как подписать клиента на услугу:

```php
$id = 123; # ID услуги в MikBiLL.
$service = "wink"; # Название сервиса.
$status = $MikBiLL->cabinet->Subscriptions()->setSubscription(id: $id, activate: 1, service: $service);

echo $status
	? "Успешно оформили подписку №$id сервиса $service."
	: "Не удалось оформить подписку №$id сервиса $service.";
```

Пример как отписать клиента от услуги:

```php
$id = 123; # ID услуги в MikBiLL.
$service = "wink"; # Название сервиса.
$status = $MikBiLL->cabinet->Subscriptions()->setSubscription(id: $id, service: $service);

echo $status
	? "Успешно отписались от подписки №$id сервиса $service."
	: "Не удалось отписаться от подписки №$id сервиса $service.";
```

### 10. Подписки: Middleware

> Появилась возможность получить список доступных Middleware подписок.

Пример использования модели:

```php
echo "<h3>Доступные Middleware как модель:</h3>";
$wares = $MikBiLL->cabinet->Subscriptions()->getMiddlewares();
foreach ($wares->getMiddleware() as $ware) {
	echo "<hr><h2><code>[id:{$ware->getId()}] " . $ware->getName() . "</code></h2>";
}
```

Обработка как массив:

```php
echo "<h3>Доступные Middleware как массив:</h3>";
$subs = $MikBiLL->cabinet->Subscriptions()->getMiddlewares();
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

### 10. Тикеты: Создание, отправка, чтение

Клиент может увидеть все свои тикеты:

```php
echo "<h3>Тикеты клиента:</h3>";
$tickets = $MikBiLL->cabinet->Tickets()->getTickets();
foreach ($tickets->getMessages() as $ticket) {
	$status = $ticket->isClosed() ? "📛[закрыто]" : "⏳ [открыто]";
	echo "<hr><h2><small>$status</small> Обращение: <code>[id:{$ticket->getId()}]</code> | открыто " . ($ticket->getDate()?->format("d.m.Y в H:i:s") ?? "") . "</h2>";
	echo "<p>Последнее сообщение:</p><code>{$ticket->getMessage()}</code>";
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
echo "<h3>Сообщения в тикете:</h3>";
$id = 3; # ID тикета.
$ticket = $MikBiLL->cabinet->Tickets()->getTicketsDialog(ticketId: $id);
echo "<pre>" . print_r($ticket->getAsArray(), true) . "</pre>";
```
