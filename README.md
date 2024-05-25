# Тестовое задание

## Данные для доступа к БД

- **Хост**: `mysql`
- **Пользователь**: `laravel`
- **Пароль**: `secret`

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
docker-compose exec -ti app bash
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
