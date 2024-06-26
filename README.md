# Тестовое задание

## Вторая часть

### Команды для создания сущностей

Создание аккаунта
```bash
php artisan create:account {companyId} {tokenId} {username} {password}
```

Создание апи сервиса
```bash
php artisan create:apiservice {name} {tokenTypeId}
```

Создание компании
```bash
php artisan create:company {name}
```

Создание токена
```bash
php artisan create:token {tokenTypeId} {apiServiceId} {token}
```

Создание типа токена
```bash
php artisan create:tokentype {type}
```

### Ежедневное обновление
Для запуска планировщика ежедневного обновления в час ночи и час дня нужно ввести эту команду
```bash
php artisan schedule:work
```

### Команды для выгрузки данных
Претерпели изменения из-за добавления Api сервисов и получения данных по времени

```bash
php artisan fetch:all {apiServiceId?} {date?}
```

```bash
php artisan fetch:orders {apiServiceId} {date?}
```

```bash
php artisan fetch:incomes {apiServiceId} {date?}
```

```bash
php artisan fetch:sales {apiServiceId} {date?}
```

```bash
php artisan fetch:stocks {apiServiceId}
```

## Данные для доступа к БД

- **База**: `semenmocha`
- **Логин**: `semenmocha`
- **Пароль**: `3ZY2EnXX7YRJ_SN8`
- **URL**: `https://fvh1.spaceweb.ru/phpMyAdmin/index.php?route=/database/structure&db=semenmocha`

*Название базы и логин таковы из-за политики сайта, что первая, и **единственная доступная**, бд имеет имя пользователя, ну и
образает его для полного
счастья :)*

## Таблицы

- **orders**
- **sales**
- **incomes**
- **stocks**

## Установка и настройка

### Настройка окружения

1. Создайте файл `.env` из `.env.example` в корневой директории проекта со следующим содержимым:

```dotenv
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

2. Создайте файл `.env` из `.env.example` в директории `src/` и укажите следующие переменные:

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

OCTANE_SERVER=swoole
API_KEY=E6kUTYrYwZq2tN4QEtyzsbEBk3ie
```

### Поднятие docker-контейнеров

Для запуска проекта выполните следующие команды:

```bash
docker-compose up -d
```

Перейдите в терминал контроллера

```bash
docker-compose exec -ti php bash
```

Установите зависимости

```bash
composer install 
```

Для генерации ключа Laravel выполните следующую команду:

```bash
php artisan key:generate
```

Запустите миграции

```bash
php artisan migrate
```

Для запуска сервера

```bash
php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000
```

Для ежедневного обновления данных

```bash
php artisan schedule:work
```

После выполнения этих шагов ваш проект должен быть готов к работе.

### Доступ к приложению

После запуска контейнеров, приложение будет доступно по адресу [http://localhost:8000](http://localhost:8000).

### Парсинг данных

Для парсинга есть следующие команды:

```bash
php artisan fetch:all
```

```bash
php artisan fetch:orders
```

```bash
php artisan fetch:incomes
```

```bash
php artisan fetch:sales
```

```bash
php artisan fetch:stocks
```
