# Dev server

### Система контейнеров для быстрого развертывания
 
> Стек:
```
    php-fpm
    nginx
    redis
```

#### Установить докер.

```
    https://docs.docker.com/engine/installation/
```

#### Установка docker-compose.

```
    https://docs.docker.com/compose/install/
```

### Сборка контейнера для проекта
##### Перейти в директорию с проектом и выполнить.

```
    docker-compose up
    docker-compose up -d 
    docker-compose build
```

##### Подключиться внутрь контейнера.

```
    docker exec -it some_container_name /bin/bash
```

###### Будьте внимательны может потребоваться ввести github token, необходимо зайти в настройки своего акка на гитхабе, сгенерить, скопировать и вставить в консоль

