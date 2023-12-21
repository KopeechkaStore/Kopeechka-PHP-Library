# Kopeechka PHP library

[![PHP version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg)](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg) /   [Documentation EN](#documentation-en) / [Документация RU](#документация-ru)

## Documentation EN

-----
### 1. [Kopeechka Api](https://faq.kopeechka.store/api_page/)

---
### 2. [Installing](#installation)
   * [For exists vendor](#for-exists-vendor)
   * [For file](#for-file)
---
### 3. [Work with Library](#work-with-library--работа-с-библиотекой)
   *  [Create class](#create-class--создание-класса)
   * [Basic Requests](#basic-requests--основные-запросы)
      * [user-balance](#user-balance)
   * [Work with email](#work-with-mail--работа-с-почтой)
      * [Get email for site](#get-email-for-site--запрос-почты)
      *  [Get message](#get-message-for-activation-id--запрос-письма)
      *  [Cancel email](#cancel-email-activation--отменить-почту)
      *  [Reorder email](#reorder-email-activation--повторный-запрос-активации-с-этой-почтой)
      *  [Fresh id for email](#fresh-activation-id--узнать-id-активации-по-почте-и-сайту)
   * [Work with domain lists](#work-with-domain-lists--работа-со-списками-доменов)
     * [List of all service domains](#list-of-all-service-domains--получить-наши-домены)
     * [Get prices and zones](#get-prices-and-zones--получить-цены-и-зоны)
----

## Документация RU

----

-----
### 1. [Работа с копеечкой api](#работа-с-копеечкой-api)

-----
### 2. [Установка](#установка)
   * [Для существующей папки vendor](#для-существующей-папки-vendor)
   * [Для отдельного файла/скрипта](#для-отдельного-файласкрипта)

### 3. [Работа с Библиотекой](#work-with-library--работа-с-библиотекой)
   * [Создание класса](#create-class--создание-класса)
   * [Базовые запросы](#basic-requests--основные-запросы)
     * [user-balance](#user-balance)
   * [Работа с почтой](#work-with-mail--работа-с-почтой)
      * [Запрос почты](#get-email-for-site--запрос-почты)
      *  [Запрос письма](#get-message-for-activation-id--запрос-письма)
      *  [Отменить почту](#cancel-email-activation--отменить-почту)
      *  [Повторный запрос активации с этой почтой](#reorder-email-activation--повторный-запрос-активации-с-этой-почтой)
      *  [Узнать id активации по почту и сайту](#fresh-activation-id--узнать-id-активации-по-почте-и-сайту)
   * [Работа со списками доменов](#work-with-domain-lists--работа-со-списками-доменов)
      * [Получить наши домены](#list-of-all-service-domains--получить-наши-домены)
      * [Получить цены и зоны](#get-prices-and-zones--получить-цены-и-зоны)

-----

-----

# Work with kopeechka api

Click for [api documentation]()

## Installation

-----
### For exists vendor
1. Add `/KopeechkaLib` to folder **/vendor/**.
2. Add `"KopeechkaLib\\": "KopeechkaLib/"` to `composer.json`
like:
~~~
{
"autoload": {
    "psr-4": {
      "KopeechkaLib\\": "KopeechkaLib/"
    }
  }
}
~~~
3. Include or required `.../vendor/autoload.php` at file usage.
-----

### For file
1. Download at folder **.../kopeechka**.
2. Use command at this folder:
~~~
compser dump-autoload --optimize
~~~
3. Include or required `.../vendor/autoload.php` at file usage.

-----

-----
# Работа с копеечкой api

Кликните, чтобы прочитать [api документацию](https://faq.kopeechka.store/api_page/)

## Установка

-----
### Для существующей папки vendor
1. Добавьте `"KopeechkaLib\\": "KopeechkaLib/"` в `composer.json`, где `....` - уже добавленные пакеты, как показано ниже:
~~~
{
   "autoload": {
       "psr-4": {
         ....,
         "KopeechkaLib\\": "KopeechkaLib/"
      }
   }
}
~~~
2. Include или require файл `.../vendor/autoload.php` в нужный вам.
-----

### Для отдельного файла/скрипта
1. Скачать в папку **.../kopeechka**.
2. Необходимо установить авто-загрузчик через композер командой:
~~~
compser dump-autoload --optimize
~~~
3. Include или require файл `.../vendor/autoload.php` в нужный вам.

-----

-----

# Work with Library | Работа с Библиотекой

------
## [Create class / Создание класса](https://faq.kopeechka.store/api_page/)
~~~
$token = 'WFAgJqysjqFXbWyjXPOCBmEnimdKVURm';
$api_version = '2';
$response_type = 'json';
    
$kopeechka = new KopeechkaApi($token, $api_version,$response_type);
~~~
-----
## [Basic Requests / Основные запросы](https://faq.kopeechka.store/api_page/)

-----
## Get balance by token  | Запрос баланса:
### [user-balance](https://faq.kopeechka.store/api_page/#user_balance)

~~~
$response_balance = $kopeechka
        ->user()
        ->balance();

$response_decoded = json_decode($response_balance, true);

if ($response_decoded['status'] == 'OK') {
   echo $response_decoded_balance['balance'];
} else {
   echo "\n" . $response_decoded['value'];
}
~~~

-----
## [Work with mail / Работа с почтой.](https://faq.kopeechka.store/api_page/)

-----
## Get email for site | Запрос почты:
### [mailbox-get-email](https://faq.kopeechka.store/api_page/#mailbox_get_email)

~~~
$site = 'test.com';
$mail_type = 'all';
$password = 0;
$regex = null;
$subject = null;
$investor = null;
$soft = null;

$response_get_email = $kopeechka
   ->mailbox()
   ->getEmail($site, $mail_type, $password, $regex, $subject, $investor, $soft);

if ($response_get_email) {
   $response_get_email = json_decode($response_get_email, true);
} else {
   die("\nEmpty response_get_email");
}

$email = null;
$id = null;

if ($response_get_email['status'] == 'OK') {
   $email = $response_get_email['mail'];
   $id = $response_get_email['id'];

   exit("\n" . $response_get_email['mail']);
} else {
   die("\nBad response: " . $response_get_email['value']);
}
~~~

-----
## Get Message for activation ID | Запрос письма:
### [mailbox-get-message](https://faq.kopeechka.store/api_page/#mailbox_get_message)

~~~
$id = 223512;
$full = true;

$response_get_message = $kopeechka
   ->mailbox()
   ->getMessage($id, $full);

if ($response_get_message) {
   $response_get_message = json_decode($response_get_email, true);
} else {
   die("\nEmpty response_get_message");
}

if ($response_get_message['status'] == 'OK') {
   exit("\n" . $response_get_message['fullmessage']);
} elseif ($response_get_message['value'] == 'WAIT_LINK') {
   exit("\nWait message");
} else {
   die("\nBad response: " . $response_get_message['value']);
}
~~~

-----
## Cancel email activation | Отменить почту:
### [mailbox-cancel](https://faq.kopeechka.store/api_page/#mailbox_cancel)

~~~
$id = 223512;

$response_cancel_activation = $kopeechka
   ->mailbox()
   ->cancel($id);
~~~
-----

## Reorder email activation | Повторный запрос активации с этой почтой:
### [mailbox-reorder](https://faq.kopeechka.store/api_page/#mailbox_reorder)

~~~
$site = 'test.com';
$email = 'test@email.com';
$password = 0;
$regex = null;
$subject = null;
$investor = null;
$soft = null;

$response_get_email = $kopeechka
   ->mailbox()
   ->reorder($site, $email, $password, $regex, $subject, $investor, $soft);
~~~
-----

## Fresh activation id | Узнать ID активации по почте и сайту:
### [mailbox-get-fresh-id](https://faq.kopeechka.store/api_page/#mailbox_get_fresh_id)

~~~
$site = 'test.com';
$email = 'test@email.com';

$response_get_email = $kopeechka
   ->mailbox()
   ->getFreshId($site, $email);
~~~
-----
## [Work with domain lists /  Работа со списками доменов](https://faq.kopeechka.store/api_page/)

-----
## List of all service domains | Получить наши домены:
### [mailbox-get-domains](https://faq.kopeechka.store/api_page/#mailbox_get_domains)

~~~
$response_domains = $kopeechka
        ->mailbox()
        ->getDomains();

    if ($response_domains) {
        $response_domains = json_decode($response_domains, true);

        echo print_r($response_domains['domains'],1);
    } else {
        throw new Exception("\nEmpty response_balance");
    }
~~~

-----

## Get prices and zones | Получить цены и зоны:
### [mailbox-zones](https://faq.kopeechka.store/api_page/#mailbox_get_domains_zones)

~~~
$site = 'test.com';
$popular = true;

$response_domains = $kopeechka
   ->mailbox()
   ->zones($popular, $site);

if ($response_domains) {
   $response_domains = json_decode($response_domains, true);
   
   exit(print_r($response_domains['zones'], 1));
} else {
   die("\nEmpty response_balance");
}
~~~