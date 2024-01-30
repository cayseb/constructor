Пререквизиты

php 8.0.2 (json, pdo, pgsql, pdo_pgsql, zip, xmlreader, dom)
composer
postgresql 14.6+
redis 7.0

в .env указать
APP_NAME=
APP_ENV=production
APP_DEBUG=false

APP_URL=http://example.com

Указать соединение с бд

DB_CONNECTION=pgsql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

Для корректной работы админки по https установить параметр в true в .env файле:  
ADMIN_HTTPS=true

Указать соединение с redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis

в .env указать
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

Указать соединие с почтовым сервисом
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_TO_ADDRESS=

Далее нужно установить зависимости composer

composer install

Сгенерировать ключ

php artisan key:generate

Создать ссылку на папку с ресурсами

php artisan storage:link

Ввыполнить миграции

php artisan migrate

Установка ролей и прав:

php artisan db:seed --class=PermissionSeeder

Сгенерировать меню для панели управления:

php artisan db:seed --class=AdminNavigationSeeder

Создать пользователя администратора (следовать указаниям в консоли):

php artisan admin:create-user

Настроить в супервизоре процесс на команду:

php artisan queue:work
