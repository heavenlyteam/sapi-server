# sapi-server
Simple API server

Простой PHP API сервер.

**Базовая настройка**

Инициализация приожения произодит в _app.php_

Для начала работы с приложением необзодимо настроить подключение
к базе данных в файле /app/config.php

```
private $params = [
        'hashSalt' => 'vkwejroiewurn8o2y34obi23n4ybiyu23r427834tyo2j8hrtb2o3784ho2873p4234',
        'mysql' => [
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'vfhbyjxrf123',
            'dbname' => 'sapi',
        ],
     ];
```

Для работы сервера необзодимо настроить NGINX сервер.
Пример конфигурационного файла

```
server {
    listen 80;

    root /var/www/sapi;

    index app.php;

    server_name sapi.app www.sapi.app;
    
    rewrite ^/([^/]*)/([^/]*)$ /app.php?controller=$1&action=$2 break;    

    location / {
        try_files $uri $uri/ /app.php?$args;
    }


    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.1-fpm.sock;
    }
}
```

Все запросы приложения должны быть направлены на _app.php_

**Написание контроллеров**

Все контроллеры приложения находятся в папке _/app/Controllers_
Спиль написания контроллеров должен соответствовать _indexController.php_

Каждый экземпляр контроллера должен быть наследован от родительского класса BaseGuestController

**Работа с базой данных**

После настройки приложения в _config.php_

В каждом контроллере будет доступен обьект класса _DB_ который позволит более простым
способом регерировать простые запросы в mysql. 
Вызов db обьект в контроллере проиодит следующим образом.
```php
   $this->app->store
      ->select(['login', 'password'])
      ->from('users')
      ->where('id', '=', '1')
      ->where('login', '=', 'lorem')
      ->getQuery();
```
Метод `getQuery()` возвращает Mysql запрос в чистом виде как строку. Для выполенения
запроса вместо метода `getQuery()` выполнить `->exec()->all() ` чтобы получить все поля которые соответствуют запросу.
или `->exec()->one()` чтобы получить только первое совпадение. 

