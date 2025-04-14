# MikBiLL PHP SDK

MikBiLL PHP SDK для работы с клиентами. Получение токена, данных клиентов. Управление подписками: подписка, отписка.

## 📚 Ссылки

- [Исходники этого проекта](https://github.com/MKC-MKC/mikbill)
- [Подробности и состояние этого проекта](https://github.com/MKC-MKC/mikbill/blob/main/info.md)
- [Примеры использования API в Postman](https://documenter.getpostman.com/view/5969645/TVCfXTtK)
- [Установка и настройка API сервера](https://wiki.mikbill.pro/billing/external/api_cabinet)

---

## ✅ Рекомендации

- Рекомендуемая версия PHP: **8.0 и новее**
- Необходимые расширения:
    - `curl`
    - `json`

## 📦 Установка

```bash
composer require haikiri/mikbill
```

---

## 🚀 Пример использования

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

> [!IMPORTANT]
> Обрати внимание, что:
> Для работы с клиентом через `$this->cabinet` сначала необходимо получить и записать токен клиента через setUserToken.
> Для работы с админ запросами через `$MikBiLL->billing` нужен ключ для подписи billing запросов (см. ШАГ 1).

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

В аргументе service: необходимо указывать название услуги.
Актуальный список сервисов можно узнать в официальном MikBiLL API:
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

### 9. Подписки: Middleware

> Появилась возможность получить список доступных Middleware подписок.

Пример использования модели:

```php
echo "<h3>Доступные Middleware как модель:</h3>";
$subs = $MikBiLL->cabinet->Subscriptions()->getMiddlewares();
foreach ($subs->getMiddleware() as $sub) {
	echo "<hr><h2><code>[id:{$sub->getId()}] " . $sub->getName() . "</code></h2>";
}
```

Обработка как массив:

```php
echo "<h3>Доступные Middleware как массив:</h3>";
$subs = $MikBiLL->cabinet->Subscriptions()->getMiddlewares();
foreach ($subs->getAsArray() as $sub) {
	echo "<hr><h2><code>[id:{$sub["id"]}}] " . $sub["name"] . "</code></h2>";
}
```

У данного метода есть вариант вернуть данные "как-есть" для более ручной обработки:

```php
echo "<h3>Массив Middleware как-есть:</h3>";
$subs = $MikBiLL->cabinet->Subscriptions()->getMiddlewares()->getAsIs();
echo "<pre>" . print_r($subs, true) . "</pre>";
```

---

## 🛠 Обратная связь

Если нашёл баг, фичу или ошибку, или может ты хочешь внести предложение или улучшение — напиши на почту или в Telegram.
Контактные данные для связи можешь найти в `composer.json`.
