# MikBiLL PHP SDK

MikBiLL PHP SDK для работы с клиентами. Получение токена, данных клиентов. Управление подписками: подписка, отписка.

## 📚 Ссылки

- [Исходники этого проекта](https://github.com/MKC-MKC/mikbill)
- [Подробности и состояние этого проекта](https://github.com/MKC-MKC/mikbill/blob/main/info.md)
- [API Личного кабинета](https://wiki.mikbill.pro/billing/external/api_cabinet)
- [Примеры использования API в Postman](https://documenter.getpostman.com/view/5969645/TVCfXTtK)

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

```php
$billing_uid = 13; # UID клиента в MikBiLL.
$token = $MikBiLL->billing->Users()->getUserToken(uid: $billing_uid);
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

$subs = $MikBiLL->cabinet->Subscriptions()->getSubscriptions();
foreach ($subs->getSubscriptions() as $sub) {
    echo "<hr><h2><code>[id:{$sub->getId()}] " . $sub->getName() . "</code></h2>";
    echo "<li>Цена: {$sub->getServicePrice()} {$sub->getCurrency()}.</li>";
    echo "<p>Описание: {$sub->getDescription()}</p>";
}
```

### 9. Подписка на услугу

Можно подписать клиента на услугу по её идентификатору.

- `1` - активировать услугу
- `0` - отключить услугу. (можно оставить пустым для отключения)

```php
$id = 101; # ID услуги в MikBiLL.
$status = $MikBiLL->cabinet->Subscriptions()->setSubscriptions(id: $id, activate: 1);

echo $status
	? "Успешно оформили подписку №$id."
	: "Не удалось оформить подписку №$id.";
```

### 10. Отписка от услуги

Пример как отписать клиента от услуги.

```php
$id = 101; # ID услуги в MikBiLL.
$status = $MikBiLL->cabinet->Subscriptions()->setSubscriptions(id: $id);

echo $status
	? "Успешно отписались от подписки №$id."
	: "Не удалось отписаться от подписки №$id.";
```

### 11. Авторизация по логину и паролю

Клиента можно авторизовать по логину и паролю: получить токен при успешной авторизации.

```php
$token = $MikBiLL->cabinet->Auth()
	->login("userLogin", "userPassword")
	->getToken();

echo $token
	? "Успешно авторизовались."
	: "Не удалось авторизоваться.";

#   Обязательно запоминаем полученный токен для последующих запросов.
$MikBiLL->setUserToken($token);
```

---

## 🛠 Обратная связь

Если нашёл баг, фичу или ошибку, или может ты хочешь внести предложение или улучшение — напиши на почту или в Telegram.
Контактные данные для связи можешь найти в `composer.json`.
