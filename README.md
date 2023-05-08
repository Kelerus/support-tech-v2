<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center" style="font-size: 25px;">Техническая поддержка пользователей</p>

## Установка зависимостей

Должны быть установлены программы Docker & Docker-compose, Nodejs & Npm, PHP v8.1 & Composer\
Установим зависимости:
```
composer install
```
```
npm install
```
## Настройка Laravel

Скопируем файл **.env.example** и переменуем его в **.env**\
Выполним команду чтобы создать ключ для laravel:
```
php artisan key:generate
```
Поднимим тестовую базу данных с помощью Docker-compose:
### Windows
```
docker compose up -d
```
### Linux
```
docker-compose up -d
```

Выполним миграции и добавим тестовых пользователей, заявку и сообщения:
```
php artisan migrate --seed
```

## Сборка приложения и запуск приложения

Выполним следующие команды:
```
npm run build
```

Запустим приложения командой:
```
php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
