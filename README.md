
<p align="center"><img src="/art/header.png" alt="Social Card of Laravel API Skeleton"></p>

# Laravel API Skeleton ☠️

Скелет Laravel проекта для разработки API

## Создание приложения

Для создания приложения с нуля запускай следующую команду:

```bash
$ composer create-project khazhinov/laravel-api-skeleton my-awesome-project
```

Затем после установки всех зависимостей перейдём в папку с созданным проектом:

```bash
$ cd ./my-awesome-project
```

Обязательно выполни:
```bash
$ git init
```

После этого запустим необходимое для работы окружение:

```bash
$ docker-compose up -d
```

Подождём пару минут, пока инициализируется база данных. Обязательно дождитесь, чтобы контейнер PostgreSQL выдал в свои логи что-то вроде:

```log
2022-09-25 11:45:22.790 UTC [1] LOG:  database system is ready to accept connections
```

Затем выполним инициализацию базы данных:
```bash
$ php artisan migrate --seed
```

Осталось совсем чуть-чуть, чтобы увидеть магию 🌃

Теперь запускаем веб-сервер:

```bash
$ php artisan serve
```

И теперь переходим по [ссылке](http://127.0.0.1:8000/fly-docs/latest)!

Документация была получена исходя из волшебной обработки классов внутри кода. Взгляни на контроллер: ```App\Http\Controllers\Api\V1_0\ExampleEntity\ExampleEntityCRUDController```

Для генерации новых сущностей просто используй:

```bash
$ php artisan lighty:generator AnotherEntity v1.0 --migration
```

## Управление контейнером с PHP

В данном варианте реализации предполагается использование Roadrunner. Примеры контейнеров, описанные в dockerfile и docker-compose могут применяться для первичного запуска окружения. Всё, что требуется для запуска приложение - это Docker. Просто попробуй!

Сборка контейнера осуществляется с помощью:

```bash
docker-compose -f docker-compose-containerized.yaml build
```

Запуск требуемого окружения осуществляется с помощью:

```bash
docker-compose -f docker-compose-containerized.yaml up -d
```

Для остановки используй:

```bash
docker-compose -f docker-compose-containerized.yaml down
```

А это пример запуска команды внутри контейнера, когда в твоём локальном окружении сейчас нет PHP:

```bash
docker-compose -f docker-compose-containerized.yaml exec -T api php artisan migrate:refresh --seed
```
