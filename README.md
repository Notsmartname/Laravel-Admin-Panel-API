# Laravel Admin Panel + API

Небольшой проект на Laravel с админ-панелью и REST API для управления страницами, категориями и товарами.

## Стек

- PHP 8.3
- Laravel 13
- MySQL
- Laravel Breeze
- Laravel Sanctum
- Blade

## Установка

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run build
```

Для хранения загружаемых изображений:

```bash
php artisan storage:link
```

Запуск проекта:

```bash
php artisan serve
```

## Админ-панель

Авторизация:

```text
/login
```

После авторизации доступны:

```text
/dashboard
/admin/users
/admin/pages
/admin/categories
/admin/products
/profile
```

Админ-панель позволяет создавать, просматривать, редактировать и удалять страницы, категории и товары.

## API

API доступен по адресу:

```text
/api
```

### Авторизация

Вход:

```http
POST /api/login
```

Выход:

```http
POST /api/logout
```

Для защищённых запросов используется Bearer Token:

```text
Authorization: Bearer TOKEN
```

Информация о текущем пользователе:

```http
GET /api/user
```

### Категории

Получить список:

```http
GET /api/categories
```

Получить категорию:

```http
GET /api/categories/{category}
```

Создать:

```http
POST /api/categories
```

Изменить:

```http
PUT /api/categories/{category}
```

Удалить:

```http
DELETE /api/categories/{category}
```

Создание, изменение и удаление требуют авторизации.

### Товары

Получить список:

```http
GET /api/products
```

Получить товар:

```http
GET /api/products/{product}
```

Создать:

```http
POST /api/products
```

Изменить:

```http
PUT /api/products/{product}
```

Удалить:

```http
DELETE /api/products/{product}
```

Создание, изменение и удаление требуют авторизации.

## Тестирование

Проект использует PHPUnit для автоматического тестирования функциональности аутентификации, управления пользователями, профиля и смены пароля.

Запуск всех тестов:

```bash
php artisan test
```
