# MikBiLL PHP SDK

MikBiLL PHP SDK для работы с клиентами. Получение токена, данных клиентов. Управление подписками, отписками и т.д...

## ⚙️ Требования

Рекомендуемая версия PHP **>=8.0** и composer.

## 📦 Установка

```bash
composer require haikiri/mikbill
```

## 📚 Ссылки

- [Ссылка на этот SDK](https://github.com/MKC-MKC/mikbill)
- [Ссылка на этот SDK в Composer](https://packagist.org/packages/haikiri/mikbill)
- [Структура API сервера в Postman](https://documenter.getpostman.com/view/5969645/TVCfXTtK)
- [Установка и настройка API сервера](https://wiki.mikbill.pro/billing/external/api_cabinet)

---

## 📂 Структура

Проект построен на основе официальной структуры API MikBiLL с возможностью расширения и заменой частей кода.
Так как официальная документация и сам MikBiLL API не использует систему версирования,
данная библиотека будет всегда актуальной и по мере возможностей сохранять старые методы взаимодействия.

Эта SDK библиотека будет наполняться по мере необходимости, возможностей и откликов.
Теперь большинство методов и примеры их использования будут перечислены либо в папке тестирования `tests` либо в wiki.
Ниже в структуре будут перечислены ссылки на вики, классы или тесты...

---

На что вы можете рассчитывать:

- [F] - Функционал завершён.
- [MD] - Основной функционал завершён. (Дочерние методы, возможно, могут быть добавлены позднее)
- [P] - В приоритете. (По планам завершить в ближайшее время)
- [MP] - Средний приоритет. (Было бы хорошо иметь, но не критично, когда-нибудь...)
- [LP] - Низкий приоритет. (Возможно появление базового функционала для некоторых методов в будущем)
- [NP] - Не запланирован. (Может быть в будущем/По запросу)
- [??] - Требуется проверка.

Все запросы в Billing Api должны быть подписаны общим HMAC ключом. Пример [смотри ниже](#инициализация-проекта).

Все запросы в Cabinet Api должны быть подписаны Bearer токеном клиента.
Пример получения токена
[для бота](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/tests/BillingGetTokenTest.php#L36)
либо для
[личного кабинета](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/tests/CabinetLoginTest.php#L40).

- **Billing API**
    - Users [F]
        - [Получить токен клиента](https://github.com/MKC-MKC/mikbill/blob/main/tests/BillingGetTokenTest.php#L36) [F]
        - [Поиск клиента](https://github.com/MKC-MKC/mikbill/blob/main/tests/BillingSearchUsersTest.php#L34) [F]
        - [Kick User](https://github.com/MKC-MKC/mikbill/blob/main/src/Billing/UsersController.php#L81) [deprecated]
        - [Bind User](https://github.com/MKC-MKC/mikbill/blob/main/src/Billing/UsersController.php#L101) [deprecated]
- **Cabinet API**
    - Auth [F]
        - [Авторизация по логину и паролю](https://github.com/MKC-MKC/mikbill/blob/main/tests/CabinetLoginTest.php#L25)
        - [Авторизация по телефону](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/AuthController.php#L50)
            - [OTP-Код](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/AuthController.php#L70)
    - Tickets [F]
        - [Список тикетов](https://github.com/MKC-MKC/mikbill/blob/main/tests/TicketsTest.php#40)
        - [Создание тикета](https://github.com/MKC-MKC/mikbill/blob/main/tests/TicketsTest.php#L71)
        - [Смотреть переписку тикета](https://github.com/MKC-MKC/mikbill/blob/main/tests/TicketsTest.php#L113)
        - [Отправка сообщения](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/TicketsController.php#L86)
    - Common [F]
        - [Время сервера](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/tests/CommonTest.php#L43) [F]
        - [IP Клиента](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/tests/CommonTest.php#L36) [F]
        - [Версия MikBiLL](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/src/Cabinet/CommonController.php#L82) [F]
        - [Конфигурация](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/src/Cabinet/CommonController.php#L64) [MD]
        - [Контакты компании](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/src/Cabinet/CommonController.php#L100) [F]
        - [Меню сайта](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/src/Cabinet/CommonController.php#L118) [F]
    - Packet [MD]
        - [Доступные тарифы](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/PacketController.php#L24) [F]
        - [Информация об тарифе](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/PacketController.php#L45) [MD]
    - User [MD]
        - Contacts [MP]
        - [Данные Клиента](https://github.com/MKC-MKC/mikbill/blob/main/tests/CabinetUserTest.php#L13) [F]
        - [Напомнить пароль](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/UserController.php#L47) [F]
        - [Изменить пароль](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/UserController.php#L73) [??]
        - [Изменить тариф](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/UserController.php#L101) [??]
    - Register Hotpost [NP]
    - Payments [MD]
        - [Voucher](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/PaymentsController.php#L26) [F]
        - Прочие методы... [NP]
    - Services [MP]
        - [Услуга Турбо](https://github.com/MKC-MKC/mikbill/blob/main/tests/ServicesTurboInactiveTest.php#L29) [F]
        - [Услуга Заморозка](https://github.com/MKC-MKC/mikbill/blob/main/tests/ServicesFreezeInactiveTest.php#L28) [F]
        - Real IP [MP]
        - [Услуга Кредит](https://github.com/MKC-MKC/mikbill/blob/main/tests/ServicesCreditInactiveTest.php#L29) [F]
        - Change MAC [LP]
        - Money Transfers [LP]
    - Subscriptions [MD]
        - [Additional](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/SubscriptionsController.php#L87) [F]
        - [Middleware](https://github.com/MKC-MKC/mikbill/blob/main/tests/SubscriptionsTest.php#L84) [F]
        - [Other](https://github.com/MKC-MKC/mikbill/blob/main/tests/SubscriptionsTest.php#L40) [F]
        - Прочие методы... [NP]
    - Devices [NP]
    - Reports [F]
        - [Платежи](https://github.com/MKC-MKC/mikbill/blob/main/tests/ReportsPaymentsTest.php#L44) [F]
        - [Сессии](https://github.com/MKC-MKC/mikbill/blob/main/tests/ReportsSessionsTest.php#L44) [F]
    - News [F]
        - [Новости](https://github.com/MKC-MKC/mikbill/blob/main/src/Cabinet/NewsController.php#L24) [F]

---

## 🧯 Обработка ошибок

Проект поддерживает легкую обработку ошибок с помощью исключений.
Если вам необходимо более детальная возможность отлова ошибок, вы можете заменить входную точку этого SDK на свой класс.
Вы не в клетке. Пример с чего начать собственную реализацию входной точки SDK смотри по ссылке:
[Своя реализация sendRequest. Строка 100.](https://github.com/MKC-MKC/mikbill/blob/8dd48465332bc0a675ada26b199ce473c163040c/info.md?plain=1#L100)

- Исключения, которые могут быть выброшены в стандартной реализации SDK:
    - `BillApiException` — отлавливает ответы биллинга и возвращает оригинальный код и текст ошибки.
    - `UnauthorizedException` — вызывается если произошла ошибка получения данных в следствии ошибки авторизации.
    - `Throwable` — используйте с осторожностью для глубокого отлова всех остальных ошибок.

> [!IMPORTANT]
> Полный список исключений можете найти в `src/Exception`

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

---

# 🚀 Пример использования

## Инициализация проекта

Используй эту базовую конструкцию где-нибудь в своём проекте, чтобы инициализировать SDK:

```php
require "vendor/autoload.php";

use Haikiri\MikBiLL\MikBiLLApi;

$MikBiLL = new MikBiLLApi(
    url: "https://api.example.com/", # Твой Api сервер.
    key: "yourApiSignKey", # Твой Api ключ для подписи административных billing запросов.
//    debug: false, # Укажи `true` – чтобы включить отладку запросов.
);
```

## Проксирование

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

# 💬 Напоследок:

Не забывай после получения токена клиента
[ЗАПИСАТЬ ЕГО!](https://github.com/MKC-MKC/mikbill/blob/8e528f0fae097a38ff33dad306ebe9f3bdacb2b5/tests/BillingGetTokenTest.php#L36)

Токен нужно записывать в stateless хранилище каждый раз для отправки запросов к `Cabinet API`. Пример записи токена:

```php
$token = "Здесь Bearer токен клиента.";
$MikBiLL->setUserToken($token);
```

---

Обрати внимание, что почти над каждым методом в исходном коде были оставлены комментарии.
Но некоторые поля описаны неполно, либо вообще не описаны, потому что официальной документации на каждое поле БД – нет.
Будет круто, если ты поможешь заполнить пробелы и знаешь что за что отвечает...

Если в каком-то объекте нет нужной модели, нет времени ждать внесения изменений, ты можешь использовать метод:

`getAsArray` – он вернёт тебе традиционный response["data"] массив данных, напрямую из запроса.

`getData` - он позволит обращаться к вложенным массивам в стиле "точки.доступа", например `getData("data.info.user")`.

> Если хочешь дополнить библиотеку — напиши по контактам в `composer.json`.
