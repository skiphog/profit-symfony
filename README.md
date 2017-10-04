## [Современные PHP-фреймворки](#) - Symfony
**ДЗ №1** 
* [Изменение текста на главной странице](https://github.com/skiphog/profit-symfony/blob/master/app/Resources/views/default/index.html.twig)

**ДЗ №2**
* [Добавить Middleware](https://github.com/skiphog/profit-symfony/blob/master/src/AppBundle/EventSubscriber/TokenSubscriber.php)

**ДЗ №3**
* [Вывод текущей даты](https://github.com/skiphog/profit-symfony/blob/master/app/Resources/views/base.html.twig#L24)
* [Вывод новостей](https://github.com/skiphog/profit-symfony/blob/master/app/Resources/views/default/test-news.html.twig) с [переданным массивом](https://github.com/skiphog/profit-symfony/blob/master/src/AppBundle/Controller/DefaultController.php#L27)
* [Форма поиска](https://github.com/skiphog/profit-symfony/blob/master/app/Resources/views/base.html.twig#L16) (Подключение библиотеки _select2_ в этом же файле)

**ДЗ №4**
* Созданы сущности [Автор и Новости](https://github.com/skiphog/profit-symfony/tree/master/src/AppBundle/Entity), а так же связи между ними
* [Вывод новостей](https://github.com/skiphog/profit-symfony/blob/master/app/Resources/views/news/index.html.twig) с [переданными данными из БД](https://github.com/skiphog/profit-symfony/blob/master/src/AppBundle/Controller/NewsController.php)

 