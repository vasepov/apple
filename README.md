<p align="center">
    ТЗ выполнено с использованием докера. В связи с этим стоит выполнить следующее для развёртывание проекта:
</p>
<p>
    ./init/config/main-local измнить строку подключения к базе на <br>
    'dsn' => 'mysql:host=mariadb;dbname=apple',
    
    в файле ./common/
    sudo docker-compose build
    sudo docker-compose up
    composer install
    cd ./dev-server/
    sudo docker-compose exec apple_php ./yii migrate
</p>
<p>
    Основная страница огородом http://127.0.0.1:8011 <br>
    Маленькая админка http://127.0.0.1:8022/ доступ по admin:admin <br>
    phpMyAdmin доступен по http://127.0.0.1:8765 root:qwerty
</p>
