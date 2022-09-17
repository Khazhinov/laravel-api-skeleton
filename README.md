# laravel-api-skeleton
Скелет Laravel проекта для разработки API


```bash
docker-compose -f docker-compose-dev.yaml build
```

```bash
docker-compose -f docker-compose-dev.yaml up -d
```

```bash
docker-compose -f docker-compose-dev.yaml down
```

```bash
docker-compose -f docker-compose-dev.yaml exec -T api php artisan migrate:refresh --seed
```
