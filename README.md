Domstor Template Standard
========================
Требования
--------------
PHP>=7.1

Установка
--------------
1. `composer create-project domstor-project/template-standard`
2. Обязательно указать параметр `mailer_user`
3. Параметр `mailer_request_recipients` вводится в формате ['email@email1.ru', 'email@email2.ru']
4. Указать параметр `default_timezone`. Например: `Asia/Krasnoyarsk`, `Asia/Novosibirsk`
5. Отредактировать файл `app/AppKernel.php`. В строчке `date_default_timezone_set('Asia/Novosibirsk');` заменить временную зону на соответствующую введеной в предыдущем пункте
6. Выставить права на var/logs и var/cache. Подробнее [Symfony Documentation](https://symfony.com/doc/current/setup/file_permissions.html).
7. Выполнить `php bin/console d:d:c` для создания базы данных
8. Выполнить `php bin/console d:s:u --force` для обновления схемы базы
9. Выполнить `php bin/console cache:clear` для очистки кэша
10. Выполнить `php bin/console fos:js-routing:dump` для выгрузки роутов Symfony в JS
11. Выполнить `php bin/console assetic:dump` для выгрузки ассетов
12. Создать папку web/uploads и установить права `sudo chown -R www-data:www-data /path/to/project-folder/web/uploads` `sudo chmod -R 755 /path/to/project-folder/web/uploads`
13. Создать пользователя для доступа к системе администрирования `php bin/console fos:user:create` и `php bin/console fos:user:promote admin_user_name ROLE_SUPER_ADMIN`

Настройка
--------------
Необходимо настроить DomstorTemplateBundle. Пример настроек:
```yaml
domstor_template:
    domstorlib:
        builder:
            org_id: 13 #Идентификатор вашей организации в системе Домстор
            location_id: 2004 #Идентификатор города в системе Домстор. 2004 - Кемерово, 2006 - Новокузнецк, 2236 - Новосибирск
            cache:
              type: 'file' #Тип кэширования. Поддерживаются: file, apc, array, xcache, memcache
              time: 86400 #Время жизни кэша
              uniq_key: '13' #Уникальный ключ хэша
              options:
                directory: '%kernel.cache_dir%' #Директория, где хранится кэш объектов
            filter:
              template_dir: '%kernel.root_dir%/../src/AppBundle/Resources/views/Filters'
        links: #Список населенных пунктов для поиска недвижимости
            2004: 'Недвижимость в Кемерово'
            43: 'Недвижимость в Кемеровской области'
    mailer:
        request: 
            service: 'default' #mailer-сервис, через который будут отправляться сообщения о поступлении новых заявок
            to: '%mailer_request_recipients%' #Получатели рассылки о новых заявках
            from: '%mailer_request_from%' #От кого будут приходить заявки
            subject: '%mailer_request_subject%' #Тема письма для заявки
            email_template: 'DomstorTemplateBundle:Email:email_request.html.twig' #Шаблон письма
    
    title: 
        objects: #Заголовки пунктов для меню недвижимости
            flat: 'Квартиры'
            house: 'Дома и коттеджи'
            land: 'Земля и дачи'
            garage: 'Гаражи и парковки'
            office: 'Офисная'
            trade: 'Торговая'
            product: 'Производственная'
            storehouse: 'Складская'
            landcom: 'Земля'
            other: 'Прочее'
            complex: 'Имущественные'
        objectsHtml: #Заголовки пунктов для меню недвижимости с возможностью использовать html теги
            flat: 'Квартиры'
            house: 'Дома<br>Коттеджи'
            land: 'Дачи<br>Земля'
            garage: 'Гаражи<br>Парковки'
            office: 'Офисная'
            trade: 'Торговая'
            product: 'Производственная'
            storehouse: 'Складская'
            landcom: 'Земля'
            other: 'Прочее'
            complex: 'Имущественные'
        actions: #Заголовки разделов
            sale: 'Продают'
            rent: 'Сдают'
            purchase: 'Купят'
            rentuse: 'Снимут'
            exchange: 'Обмен'
            new: 'Новостройки'
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

Существует возможность вывести блок формы поиска недвижимости:
```twig
{{ sonata_block_render(
        { 'type':'domstor.template.block.domstor_filter.service' },
        { 'object':'flat', 'action':'sale', 'form_action_route':'app_objects_list', 'filter_template_dir': '@AppBundle/Resources/views/HomeFilters' }
    ) }}
```
`object` - тип недвижимости, `action` - категория, `form_action_route` - имя роута страницы поиска недвижимости. `filter_template_dir` - опциональный параметр, позволяет указать отдельную папку с шаблонами формы поиска, если не передан этот параметр в блок, то берется значение из `domstor_template.domstorlib.builder.filter_template_dir`. Поддерживается указание пути с @.

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