Domstor Template Standard
========================
Требования
--------------
PHP>=7.0

Установка
--------------
1. `composer create-project domstor-project/template-standard`
2. Обязательно указать параметр `mailer_user`
3. Параметр `mailer_request_recipients` вводится в формате ['email@email1.ru', 'email@email2.ru']
4. Выставить права на var/logs и var/cache. Подробнее [Symfony Documentation](https://symfony.com/doc/current/setup/file_permissions.html).
5. Выполнить `php bin/console d:d:c` для создания базы данных
6. Выполнить `php bin/console d:s:u --force` для обновления схемы базы
7. Выполнить `php bin/console cache:clear` для очистки кэша
8. Выполнить `php bin/console fos:js-routing:dump` для выгрузки роутов Symfony в JS
9. Выполнить `php bin/console assetic:dump` для выгрузки ассетов
10. Создать папку web/uploads и установить права `sudo chown -R www-data:www-data /path/to/project-folder/web/uploads` `sudo chmod -R 755 /path/to/project-folder/web/uploads`
11. Создать пользователя для доступа к системе администрирования `php bin/console fos:user:create` и `php bin/console fos:user:promote admin_user_name ROLE_SUPER_ADMIN`

Настройка
--------------
Для настройки блока меню недвижимости необходимо настроить DomstorTemplateBundle. Пример настроек:
```yaml
domstor_template:
    domstorlib:
        builder:
            org_id: 13 #Идентификатор вашей организации в системе Домстор
            location_id: 2004 #Идентификатор города в системе Домстор. 2004 - Кемерово, 2006 - Новокузнецк, 2236 - Новосибирск
            template: 'DomstorTemplateBundle:Block:realtyicons.html.twig' #Шаблон блока меню недвижимости
            cache_dir: '%kernel.cache_dir%' #Директория, где хранится кэш объектов
            cache_type: 'file' #Тип кэширования. Поддерживаются: file, apc, array, xcache, memcache
            cache_time: 86400 #Время жизни кэша
    mailer:
        request: 
            service: 'default' #mailer-сервис, через который будут отправляться сообщения о поступлении новых заявок
            to: '%mailer_request_recipients%' #Получатели рассылки о новых заявках
            from: '%mailer_request_from%' #От кого будут приходить заявки
            subject: '%mailer_request_subject%' #Тема письма для заявки
            email_template: 'DomstorTemplateBundle:Email:email_request.html.twig' #Шаблон письма
```

Блоки на главной странице
--------------
Все доступные в системе блоки представлены в `AppBundle:Home:index.html.twig`
```twig
{% block content %}
    {{ sonata_block_render({'type':'domstor.template.block.home.slider.service'}) }}
    {{ sonata_block_render({'type':'domstor.template.block.home.special_offer.service'}) }}
    {{ sonata_block_render({'type':'domstor.template.block.home.urgent_sale.service'}) }}
    {{ sonata_block_render({'type':'domstor.template.block.home.review.service'}) }}
    {{ sonata_block_render({'type':'domstor.template.block.home.employee.service'}) }}
    {{ sonata_block_render({'type':'domstor.template.block.home.partner.service'}) }}
    {{ sonata_block_render({'type':'domstor.template.block.home.vacancy.service'}) }}
    {{ sonata_block_render({'type':'domstor.template.block.home.post.service'}) }}
{% endblock %}
```
Что бы убрать блок с главной страницы, достаточно удалить строку с его вызовом. В этом случае запросов к БД идти не будет. В системе администрирования, однако, останется возможность добавлять записи в этот блок.
По-умолчанию, блок выводит 100 записей. Для того, что бы настроить количество отображаемых блоком записей, необходимо вызвать блок вот так:
```twig
{{ sonata_block_render({'type':'domstor.template.block.home.vacancy.service'},  {'count':1}) }}
```
В этом случае в блоке будет выведена только одна запись.

Статические страницы без контроллера
--------------
Существует возможность добавлять статические страницы, без создания контроллера. Достаточно сделать twig-шаблон и прописать необходимые настройки в конфигурацию. В качестве примера используется страница "О компании":
Добавим запись в `AppBundle/Resources/config/static_routing.yml`
```yaml
app_static_about: #Название роута для Symfony Routing
    path: /about #Путь к странице в адресной строке
    defaults:
        _controller: FrameworkBundle:Template:template #Обязательная строка для страницы без контроллера
        template:    AppBundle:Static:about.html.twig #Шаблон страницы
```

Управление отображением разделов в системе администрирования
--------------
Существует возможность скрыть раздел из системы администрирования. Все доступные разделы находятся в файле `app/config/sonata/admin.yml`. Для того, что бы скрыть раздел, достаточно закомментировать строку.
```yaml
sonata_admin:   
    security:
        handler: sonata.admin.security.handler.role
    title:      Кано
    title_logo: /../bundles/app/images/template/logo.png
    templates:
        # default global templates
        layout:    SonataAdminBundle::layout.html.twig

    dashboard:
        blocks:
            # display a dashboard block
            - { position: left, type: sonata.admin.block.admin_list }
        groups:
        domstor_template:
                keep_open:            true
                label_catalogue:      messages
                items:
                    - domstor.template.admin.slider #Слайдер
                    - domstor.template.admin.special_offer #Специальные предложения
                    - domstor.template.admin.urgent_sale #Срочная продажа
                    - domstor.template.admin.review #Отзывы
                    - domstor.template.admin.employee #Сотрудники
                    - domstor.template.admin.partner #Партнеры
                    - domstor.template.admin.vacancy #Вакансии
                    - domstor.template.admin.post #Новости
```