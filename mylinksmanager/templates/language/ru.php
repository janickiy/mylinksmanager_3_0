<?php

$language["title"]["admin_page_index"] = "Новые ссылки";
$language["title"]["admin_index"] = "Панель администрирования My Links Manager | Новые ссылки";
$language["info"]["admin_index"] = 'Ссылки, добавленные в каталог попадают в этот раздел только, если в разделе "Настройки" выбрана соответствующая опция. Ссылки будут доступны в каталоге, только после проверки и одобрения администратора. Администратору доступны следующие действия: проверить вручную и проверить автоматически. При выборе опции &quot;проверить вручную&quot; открывается окно, с описанием ссылки, а также в низу находится фрейм, в которой отображается страница с ответной ссылкой. Администратор решает, что дальше делать с ссылкой. Добавить, удалить или занести в черный список. При выборе опции "проверить автоматически" скрипт в соответствии с правилам заданным в настройках, проверяет качество ссылки, и в зависимости от результата, ссылка попадает в каталог, удаляется или заносится в черный список.';

$language["title"]["admin_page_addcategory"] = "Добавить категорию";
$language["title"]["admin_addcategory"] = "Панель администрирования My Links Manager | Добавить категорию";
$language["info"]["admin_addcategory"] = 'Чтобы добавить новую категорию в поле "Категория", укажите её название. Поля &quot;Описание в META&quot; и &quot;Ключевые слова в META&quot; не являются обязательными и будут отображаться только в мета тэгах.';

$language["title"]["admin_page_addlink"] = "Добавить сайт";
$language["title"]["admin_addlink"] = "Панель администрирования My Links Manager | Добавить сайт";
$language["info"]["admin_addlink"] = "В этом разделе Вы можете самостоятельно добавить сайт в каталог. Заполните все поля помеченные звездочкой. Снимите флажок, если Вы не хотите проводить проверку для добавляемого сайта.";

$language["title"]["admin_page_blacklist"] = "Чёрный список";
$language["title"]["admin_blacklist"] = "Панель администрирования My Links Manager | Чёрный список";
$language["info"]["admin_blacklist"] = "В этом разделе Вы можете просматривать все ссылки, находящиеся в черном списке. Чтобы восстановить ссылку, кликните на кнопку &quot;<b>Восстановить</b>&quot;. Удалить из базы каталога - соответсвенно &quot;<b>Удалить</b>&quot;";

$language["title"]["admin_page_categories"] = "Категории";
$language["title"]["admin_categories"] = "Панель администрирования My Links Manager | Категории";
$language["info"]["admin_categories"] = "В этом находятся список каталогов и подкаталогов. Чтобы просмотреть список подкаталогов для каталога, перейдите по ссылке названия каталога, после это внизу появиться список подкаталогов. Чтобы добавить новую категорияю, кликните по ссылке &quot;Добавить категорию&quot;, чтобы добавить подкаталог, кликните по ссылке &quot;Добавить подкаталог&quot;";

$language["title"]["admin_page_check_links"] = "Проверка ссылок";
$language["title"]["admin_check_links"] = "Панель администрирования My Links Manager | Проверка ссылки";
$language["info"]["admin_check_links"] = "";

$language["title"]["admin_page_password"] = "Пароль";
$language["title"]["admin_password"] = "Панель администрирования My Links Manager | Пароль";
$language["info"]["admin_password"] = "";

$language["title"]["admin_page_settings"] = "Настройки";
$language["title"]["admin_settings"] = "Панель администрирования My Links Manager | Настройки";
$language["info"]["admin_settings"] = '<font color="#FFFFFF"><b>Настройки интерфейса.</b></font><br />
В этом пункте доступны только те настройки, отвечающие за интерфейс и набор данных в каталоге. Внимание! Для того, чтобы использовать статический вид ссылок каталога, необходимо, чтобы на вашем сервере был подключен модуль mode_rewrite. Не забудьте выставить права на запись 0755 (CHMOD) для settings.php. Это необходимо для того, чтобы скрипт имел возможность запись в .htaccess<br />
<font color="#FFFFFF"><b>Шаблоны писем</b></font><br />
В этом пункте Вы можете редактировать шаблоны писем, отправляемые администратору каталога и пользователям в определенных случаях.
В фигурных скобках {[ ]} это: <b>NAME</b> - название ссылки, <b>EMAIL</b> - email пользователя, <b>URL</b> - url адрес ссылки, <b>URL_LINK</b> - url адрес страницы с ответной ссылкой, <b>DESCRIPTION</b> - описание ссылки, <b>DATE</b> - дата добавления ссылки в каталог, <b>URL_EDIT</b> - url адрес, где пользователь может редактировать ссылку, <b>DATE_LIMIT</b> - Минимальный интервал проверки наличия обратной ссылки в днях, <b>HTTP_HOST</b> - хост каталога, <b>REASON</b> - причина по которой была скрыта ссылка. <br />
<font color="#FFFFFF"><b>Настройки работы каталога</b></font><br />
В этом пункте находятся настройки, отвечающие за порядок проверки входных данных оправляемых пользователями, при добавлении ссылки. А так же в этом пункте можно задавать параметры и действия каталога во время проверки ответных ссылок.';

$language["title"]["admin_page_design"] = "Правка дизайна";
$language["title"]["admin_design"] = "Панель администрирования My Links Manager | Правка дизайна";
$language["info"]["admin_design"] = 'В этом разделе Вы можете редактировать дизайн каталога. Для редактирования доступны файлы, посредствам которых происходит смена дизайна.<br />
Файл &quot;<b>style.css</b>&quot; подключается в качестве файлов таблиц каскадных стилей и задает дизайн каталога.<br />
Файлы &quot;<b>header.tpl</b>&quot; и &quot;<b>footer.tpl</b>&quot; включают в себя HTML-код, отвечающий за оригинальное оформление каталога.';

$language["title"]["admin_page_edit"] = "Панель администрирования My Links Manager |";
$language["title"]["admin_edit"] = "Панель администрирования My Links Manager |";
$language["info"]["admin_edit"] = "Панель администрирования My Links Manager |";

$language["title"]["admin_page_links"] = "Ссылки";
$language["title"]["admin_links"] = "Панель администрирования My Links Manager | Ссылки";
$language["info"]["admin_links"] = "";

$language["title"]["page_help"] = '';
$language["title"]["help"] = '';

$language["title"][""] = 'Каталог сайтов My Links Manager | добавить сайт';
$language["title"]["addurl"] = 'Каталог сайтов My Links Manager | добавить сайт';

$language["title"]["page_page403"] = 'Доступ запрещен';
$language["title"]["page403"] = 'Доступ запрещен 403';

$language["title"]["page_page404"] = 'Страница не найдена';
$language["title"]["page404"] = 'Страница не найдена 404';

$language["title"]["page_page500"] = 'Ошибка сервера';
$language["title"]["page500"] = 'Ошибка сервера 500';


$language['menu']['index_title'] = 'Новые ссылки';
$language['menu']['index'] = 'Новые ссылки';

$language['menu']['addurl_title'] = 'Добавить сайт';
$language['menu']['addurl'] = 'Добавить сайт';

$language['menu']['check_title'] = '';
$language['menu']['check'] = '';

$language['menu']['categories_title'] = 'Категории';
$language['menu']['categories'] = 'Категории';

$language['menu']['check_links_title'] = 'Проверка ссылок';
$language['menu']['check_links'] = 'Проверка ссылок';

$language['menu']['links_title'] = 'Ссылки';
$language['menu']['links'] = 'Ссылки';


$language['menu']['edit_title'] = '';
$language['menu']['edit'] = '';

$language['menu']['settings_title'] = 'Настройки';
$language['menu']['settings'] = 'Настройки';

$language['menu']['black_title'] = 'Чёрный список';
$language['menu']['black'] = 'Чёрный список';

$language['menu']['password_title'] = 'Пароль';
$language['menu']['password'] = 'Пароль';



$language["str"]["action"] = "Действия";
$language["str"]["required_fields"] = "Обязательные поля";
$language["str"]["category"] = "Категория";
$language["str"]["choose_category"] = "Выберите категорию";
$language["str"]["website_name"] = "Название сайта";
$language["str"]["url"] = "Адрес сайта";
$language["str"]["address_of_recip_link_page"] = "Адрес страницы с ответной ссылкой";
$language["str"]["email"] = "E-mail";
$language["str"]["name"] = "Название";
$language["str"]["description"] = "Описание";
$language["str"]["views"] = "Просмотры";
$language["str"]["created"] = "Добавлено";
$language["str"]["action"] = "Действие";

$language["str"]["only_text_not_html"] = "Только текст, не html код";
$language["str"]["keywords"] = "Ключевые слова в META";
$language["str"]["list_separated_by_commas"] = "Перечислить через запятую";
$language["str"]["brief_description"] = "Краткое описание сайта";
$language["str"]["to_check_this_link"] = "Проводить проверку для этой ссылки";
$language["str"]["full_description"] = "Полное описание сайта";
$language["str"]["html_code_of_banner"] = "HTML-код баннера";
$language["str"]["logo"] = "© 2011-2018 <a href=\"http://janicky.com/\">Бесплатный скрипт обмена ссылками My Links Manager</a>";
$language["str"]["author"] = "Яницкий Александр";
$language["str"]["website"] = "Веб сайт";
$language["str"]["helppage"] = "Помощь";
$language["str"]["interface_settings"] = "Настройки интерфейса";
$language["str"]["language"] = "Язык";
$language["str"]["lang_ru"] = "Русский (Russian)";
$language["str"]["lang_en"] = "English (English)";
$language["str"]["all_number_links"] = "Количество ссылок на странице каталога в юзерской и админской части";
$language["str"]["all_number_new"] = "Количество новых ссылок на главной странице каталога";
$language["str"]["columns_number"] = "Количество колонок каталогов";
$language["str"]["order_views"] = "Сортировать ссылок";
$language["str"]["by_date"] = "По дате добавления";
$language["str"]["by_number"] = "По количеству кликов";
$language["str"]["order_links"] = "Порядок сортировки ссылок";
$language["str"]["by_increace"] = "По возрастанию";
$language["str"]["by_decrease"] = "По убыванию";
$language["str"]["show_cy"] = "Отображать тИЦ Яндекса";
$language["str"]["show_pr"] = "Отображать PageRank Google";
$language["str"]["catalog_url"] = "URL адрес каталога";
$language["str"]["admin_email"] = "Email администратора каталога";
$language["str"]["catalog_rule"] = "Правила каталога";
$language["str"]["msg_for_user_after_addition"] = "Сообщения, который будет выводится пользователям после добавление его ссылки";
$language["str"]["htmlcode_site1"] = "Код ссылки сайта 1";
$language["str"]["htmlcode_site2"] = "Код ссылки сайта 2";
$language["str"]["htmlcode_site3"] = "Код ссылки сайта 3";
$language["str"]["htmlcode_banner1"] = "Код баннера сайта 1";
$language["str"]["htmlcode_banner2"] = "Код баннера сайта 2";
$language["str"]["htmlcode_banner3"] = "Код баннера сайта 3";
$language["str"]["letters_templates"] = "Шаблоны писем";
$language["str"]["email_for_user_add_moder"] = "Уведомление отправляемое пользователю при добавлении его ссылки на модерацию";
$language["str"]["email_for_user_add_catalog"] = "Уведомление отправляемое пользователю при добавлении его ссылки в каталог";
$language["str"]["email_for_user_hide_absense"] = "Уведомление отправляемое пользователю, если его ссылка была временно скрыта в каталоге по причине отсутствия ответной";
$language["str"]["email_for_user_hide_prohib"] = "Уведомление отправляемое пользователю, если его ссылка скрыта в каталоге по причине запрета индексации в мета тэгах и robot.txt";
$language["str"]["email_for_user_passed"] = "Уведомление отправляемое пользователю, если его ссылка не прошла проверки администратором каталога";
$language["str"]["email_for_user_remove"] = "Уведомление отправляемое пользователю, если его ссылка была удалена из каталога";
$language["str"]["email_for_user_add_new"] = "Уведомление отправляемое администратору каталога при добавлении новой ссылки";
$language["str"]["catalog_settings"] = "Настройки работы каталога";
$language["str"]["check_interval"] = "Минимальный интервал между проверками ссылок (дней)";
$language["str"]["number_check"] = "Количество проверок ответной ссылки, по истечению которых ссылка будет удаленна";
$language["str"]["number_chars_description"] = "Количество символов в кратком описание сайта";
$language["str"]["number_chars_fulldescription"] = "Количество символов в полном описание сайта";
$language["str"]["number_html_chars"] = "Количество символов в HTML-коде ссылки и баннера";
$language["str"]["request_captcha"] = "Запрашивать секюрити код (CAPTCHA)";
$language["str"]["add_links_without_check"] = "Добавлять ссылки в каталог минуя проверку администратора";
$language["str"]["check_links"] = "Проверка обратной ссылки в момент добавления";
$language["str"]["common_host"] = "Запретить добавление ссылок расположенных на той же хостинг площадке, что и каталог";
$language["str"]["check_get_parameter"] = "Запретить в url адреса обратной ссылки для значения arg=value указывать url адрес каталога";
$language["str"]["limit_reciprocal_links"] = "Запрет на добавление ссылки, если количество внешних ссылок на странице, где ответной ссылки превышает";
$language["str"]["add_to_blacklist"] = "Заносить в черный список ссылки не прошедшие проверку";
$language["str"]["new_links_notification"] = "Отправлять уведомление на email администратора каталога о добавление новых ссылок";
$language["str"]["links_in_catalog"] = "Ссылок в каталоге";
$language["str"]["logout"] = "Выйти";
$language["str"]["from_add_message"] = "Сообщения, который будет выводится пользователям после добавление его ссылки";
$language["str"]["common_host"] = "Запретить добавление ссылок расположенных на той же хостинг площадке, что и каталог";
$language["str"]["file"] = "Файл";
$language["str"]["current_password"] = "Текущий пароль";
$language["str"]["new_password"] =  "Пароль";
$language["str"]["new_password_again"] = "Повтор пароля";
$language["str"]["identified_following_errors"] = "Выявлены следующие ошибки";
$language["str"]["add_subcategory"] = "Добавить подкатегорию";
$language["str"]["remove"] = "Удалить";
$language["str"]["edit"] = "Редактировать";
$language["str"]["back"] = "Вернуться обратно";
$language["str"]["added"] = "Добавлен";
$language["str"]["cy_yandex"] = "тИЦ Яндекса";
$language["str"]["pr_google"] = "PageRank Google";
$language["str"]["not_new_links"] = "Нет новых ссылок";
$language["str"]["recip_url_link"] = "Адрес обратной ссылки";
$language["str"]["required_field"] = "Обязательные поля";
$language["str"]["choose_your_category"] = "Выберите категорию";
$language["str"]["form_name"] = "Название сайта";
$language["str"]["form_url"] = "Адрес сайта";
$language["str"]["form_email"] = "Ваш email";
$language["str"]["form_keywords"] = "Ключевые слова";
$language["str"]["separated_by_commas"] = "Перечислите через запятую";
$language["str"]["form_description"] = "Краткое описание сайта";
$language["str"]["only_text_not_htmlcode"] = "Только текст, не html код.";
$language["str"]["from"] = "От";
$language["str"]["to"] = "до";
$language["str"]["if_any"] = "Если есть.";
$language["str"]["no_more"] = "Не более";
$language["str"]["characters"] = "символов";
$language["str"]["form_full_description"] = "Полное описание";
$language["str"]["left"] = "осталось";
$language["str"]["from_total"] = "из";
$language["str"]["html_code_banner"] = "HTML код баннера";
$language["str"]["script_link_catalog"] =  "Скрипт каталога ссылок My Links Manager";

$language["str"]["go_back"] = "Вернуться в каталог";
$language["str"]["keywords_searchform"] = "Ключевые слова";
$language["str"]["keywords"] = "Ключевые слова";
$language["str"]["search_in_catalog_searchform"] = "Искать в каталоге";
$language["str"]["meeting_of_keywords_searchform"] = "Встреча ключевых слов";
$language["str"]["at_least_once"] = "хотя бы один раз";
$language["str"]["it_doesnt_matter_searchform"] = "Не имеет значение";
$language["str"]["all_words_together"] = "все слова одновременно";
$language["str"]["add_category"] = "Добавить категорию";
$language["str"]["add_subcategory"] = "Добавить подкатегорию";
$language["str"]["no"] = "Нет";
$language["str"]["category_name"] =  "Название";
$language["str"]["category_description"] = "Описание в META";
$language["str"]["category_keywords"] = "Ключевые слова в META";
$language["str"]["category"] = "Категория";
$language["str"]["category_image"] = "Картинка (не более 100 кб)";
$language["str"]["remove_pic"] = "Удалить картинку";
$language["str"]["home"] = "На главную";
$language["str"]["number_of_clicks"] = "Количество кликов";
$language["str"]["pages"] = "Страницы";


$language["str"]["links_waiting_checks"] = "Ссылки в очереди на проверку";
$language["str"]["links_for_check"] = "Ссылки на проверку";


$language["str"]["subject_add"] = "Ваш сайт добавлен в каталог ссылок";

$language["str"]["subject_hide"] = "Ваша ссылка времено скрыта";







$language["str"]["help"] = '<h2 align="left">Требование</h2>
<p align="justify">- Для корректной работы "My Links Manager" необходимо, чтобы на Вашем сервере был установлен PHP 5.3 или выше;<br />
- База данных MySQL 5.1.0 или выше;<br />
- Для того, чтобы проводить проверку наличие ответных ссылок, на Вашем хостинге должны быть разрешены исходящие коннекты с Вашего веб сервера;<br />
- Чтобы иметь возможность использовать статический URL вид каталога ссылок, на Вашем веб сервере должен быть установлен модуль mod_rewrite;<br />
- Чтобы использовать проверку ссылок по расписанию, на Вашем сервере должен быть установлен CronTab;<br />
- Для отправки уведомления на email, необходима поддержка mail();<br />
- Чтобы использовать защиту от автоматического добавления программами ботами с вводом кода с картинки, необходима наличие графической библиотеки GD2.</p>
<br />
<h2 align="left">Описание.</h2>
<p align="justify"><b>admin</b><br />
  В этой папке находятся все, что связано с админкой.<br />
  <br />
  <b>class</b><br />
  В этой папке находятся вспомогательные классы.<br />
  <br />
  <b>templates</b><br />
  Тут лежат шаблоны, отвечающие за дизайн каталога.<br />
  <br />
  <b>style</b><br />
  Каскадные таблицы стилей (CSS).<br />
  <br />
  <b>lib</b><br />
  Файлы библиотек и настроек.<br />
  <br />
  <b>fonts</b><br />
  Шрифты для капчи.</p>
<br />
<h2 align="left">Установка и настройка.</h2>
<h3 align="left">Установка.</h3>
<p align="justify">Распаковываем архив с скриптом и загружаем содержимое папки
  links на веб сервер в любую папку, в котором будет находится скрипт.
  Например в папку links. После окончания закачки выставите права доступа (CHMOD) для папок и файлов:<br />
  templates - 0755<br />
  lib - 0755<br />
  lib/config.inc - 0755<br />
  admin/settings.php - 0755<br />
  C следующим этапом будет запуск
  инсталлятора, который создаст основной файл конфигурации, а также в указанной
  базе данных MySQL все необходимые таблицы для хранения данных. Для этого
  открываем браузер и в адресной строке набираем url адрес страницы инсталлятора.
  Например: http://www.mysite.com/links/install.php Далее следуйте всем
  инструкциям инсталлятора и завершаем установку скрипта. После завершения, <span class=msg>не
  забудьте удалить файл инсталлятора install.php!</span></p>
<p align="justify">Если у Вас возникли проблемы с установкой сркипта через
  <span class=msg>инсталлятор</span>, имеется возможность&nbsp; установить скрипт в ручную. Откройте и
  отредактируйте файл connect.inc, который находится в папке lib. В нем
  прописываются параметры подключения к базе данных MySQL. Пропишите свои
  настройки подключения к базе данных, сохраните и закачайте обратно на Ваш веб
  сервер. Создайте базу данных и разместите в нее таблицы. Обычно на многих
  хостингах это делается посредством web-интерфейса, через phpMyAdmin. Дам базы
  каталога находится в файле links.sql </p>
<h3 align="left">Настройка.</h3>
<p align="justify">Наберите в адресной строке своего браузера url-адрес панели
  администрирования. Например: http://www.mysite.ru/links/admin. Пароль для
  входа по умолчанию: 1111 Если авторизация прошла успешна, Вы сразу
  попадаете в панель администратора. Все настройки находятся по в разделе
  “Настройки”. Подсказки к каждому разделу находятся непосредственно в самом
  разделе, в правой части страницы. После того как Вы завершите настройку, <span class=msg>не
  забудьте поменять стандартные пароль на свой!</span></p>
<h3 align="left">Интеграция в дизайн.</h3>
<p align="justify">&quot;My Links Manager&quot; предоставляет гибкую возможность
  интеграции в любой дизайн и сайт. Максимальную удобность не отнимет много
  времени. Для этого Вам не обязательно знать программирование на PHP. Все, что
  для этого нужно, это только знание основ HTML и CSS (Каскадные таблицы стилей).
  Редактирование дизайн можно как через панель администрирования. В разделе
  “Дизайн” Вы можете прочитать подробную инструкцию и описание. А также Вы можете
  в ручную произвести интеграцию дизайна, отредактировав в любом текстовом
  редакторе соответствующие файлы. В корне скрипта находится папка templates. В
  ней лежат файлы элементов шаблона. Вам нужно отредактировать файлы header.html и
  footer.html, которые отвечают за дизайн каталога. И links.html отвечающий за оформление&nbsp; индивидуальной карточки ссылки. Каскадные таблицы стилей
  находится в файле style.css, который лежит в папке style в самом корне.</p>
<br />
<h2 align="left">Возможности.</h2>
<p align="justify">- Удобный многоязыковый интерфейс управления каталогом ссылок на Вашем сайте;<br />
- Все данные хранятся в базе данных MySQL;<br />
- Автообен ссылками;<br />
- Возможность перекрестного обмена;<br />
- Проверка ответной ссылки в момент добавления;<br />
- Проверка вводимых данных;<br />
- Проверка ответной ссылки на запрет индексирования в robots.txt;<br /> 
- Проверка ответной ссылки на запрет индексирования с помощью mata тегов и тега <noindex>;<br />
- Автоматическая проверка ссылок по расписанию (cron);<br />
- Защита от повторного добавления ссылки в каталог;<br />
- Защита от автоматической регистрации генерацией картинки (CAPTCHA);<br />
- Создание поддиректорий (двухуровневая вложенность);<br />
- Возможность задавать статический или динамический вид url каталога;<br />
- Отображение тИЦ Яндекс и PR Google;<br />
- Каждая ссылка имеет отдельную страницу с её описание и постоянный url адрес в каталоге;<br />
- Подсчет количества просмотров информации о сайтах и переходы на них.<br />
- Постраничная навигация вывода ссылок;<br />
- Категории неограниченной степени вложенности;<br />
- Поиск по каталогу;<br />
- Уведомление об обмене на е-майл;<br />
- Админка защищенная паролем;<br />
- Добавление, редактирование, удаление сайтов через админку;<br />
- Комплекс шаблонов для конфигурации дизайна;<br />
- Удобный инсталлятор;<br />
- Полностью бесплатный;<br />
- Открытый исходный код.</p><br />
<h2 align="left">Вопросы и предложения.</h2>
<p align="justify">Если у Вас возникнут вопросы или предложения пишите мне на
  e-mail: janickiy@mail.ru<br />
  Skype: janickiy<br />
  На сайте http://janicky.com Вы можете найти подробную информацию по данному
  программному продукту, а также скачать последнюю версию.<br />
  Если Вам понравился мой скрипт и у Вас есть желание отблагодарить меня рублем,
  то вот мои реквизиты WebMoney:<br />
  <br />
  E304999306239<br />
  R198597198920<br />
  Z917380288657<br />
  <br />
  Спасибо за использование моего скрипта!</p>
&nbsp;<h2 align="left">Примечание.</h2>
<p align="justify">Скрипт каталога ссылок My Links Manager, далее просто
  программа, является полностью бесплатная. Вы можете свободно распространять,
  копировать, в носить свои изменения в исходном коде программы, лишь при условии
  сохранения копирайта автора. <br />
  Использование программы My Links Manager в коммерческих целях без разрешения
  автора запрещено.<br />
  Вы используете эту программу на свой собственный страх и риск. Автор не несет
  никакой ответственности за работоспособность программы, а также за потери,
  повреждения данных или чего либо другого, связанного с использованием и работой
  этой программы.<br />
  <br />
  </p>';

$language["str"]["faq"] = '<h2 align=left>FAQ по скрипту</h2>
  Так часто бывает, когда у Вас в настройках не правильно прописана кодировка
  подключения к базе данных. Или указанная кодировка не поддерживается Вашим
  хостинг провайдером.
  Откройте в любом текстовом редакторе lib/connect.inc
  Найдите следующею строчку $db_charset = . Укажите другую кодировку поддерживаемую Вашим хостинг провайдеров или закомментируйте её.<br />
  <br />
  <b>2. Во время инсталляции скрипт пишет ошибку &quot;Невозможно установить соединение с
  сервером базы данных.&quot;</b><br />
  <br />
  Вероятно всего, Вы неправильно указали данные для подключение к базе данных. 
Проверьте, правильно ли Вы указали параметры подключения (хост базы данных или
  IP, имя базы данных, логин и пароль).&nbsp;Все 4 значения Вам должен предоставить ваш хостинг провайдер. Также возможно,
  что сервер базы данных временно недоступен по техническим причинам.<br />
  <br />
  <b>3. Во время инсталляции появляется ошибка "Не удалось создать таблицы в базе данных". Таблица setting пустая. В чем проблема?</b><br />
  <br />
  Скорей всего база данных, куда Вы устанавливаете, не поддерживает кодировку. По умолчанию utf8.
  Укажите другую поддерживаемую кодировку или обратитесь к своему хостинг провайдеру.<br />
  <br />
  <b>4. Скрипт установлен в кодировке utf-8. Но браузер воспринимать страницу в windows-1251 кодировке.</b><br />
  <br />
  Это связано с тем, что веб сервер сообщает кодировку windows-1251 в заголовках. Откройте файл .htaccess и добавьте строчку:
  AddDefaultCharset utf-8<br />
  <br />
  <b>5. Не отображается капча (секюрити код)</b><br />
  <br />
  Возможно, отсутствует графической библиотеки GD2 или не работают некоторые её
  функции. А также возможная из причин, отсутствие самого файла security.php,
  отвечающий&nbsp;за вывод капчи.<br />
  <br />
    <b>7. Не оправляются уведомления пользователям об обмене на email. В чем причина?</b><br />
  <br />
  Проверьте, разрешено ли хостером оправки email с Вашего сервера. А также наличие
  поддержки mail(). Вероятно письмо могут не отправляется, также по техническим
  причинам.<br />
  <br />
  <b>8. Не отображается PR Google для всех ссылок.</b><br />
  <br />
  Одна из основных причин, что Google установил запрет на получение информации о
  PR с IP Вашего веб сервера.<br />
  &nbsp;<br />
  <b>9. Я хочу сделать проверку ссылок по расписанию?</b><br />
  <br />
  Для организации проверки ссылок по расписанию необходимо настроить работу
  планировщика заданий Cron. Cron - это программа, выполняющая задания по
  расписанию. Задание можно запустить в определенное время или через определенный
  промежуток времени.&nbsp;Вам необходимо прописать путь к check.php, который лежит в
  основной папке, а также указать время запуска.<br />
  Информацию о настройке Cron Вы можете получить у своего хостер провайдера. Как правило
  большинство хостеров предоставляют свой инструмент для настройки работы <br />
  <br />
  <b>10. Могу ли я вернуть первоначальные настройки каталога?</b><br />
  <br />
  Да, конечно. Такая возможность имеется. Зайдите в админку в раздел &quot;Настройки&quot;.
  В самом низу кликните на кнопку &quot;По умолчанию&quot;, а затем обновите информацию.
  После этого все настройки&nbsp;примут значения по умолчанию.<br />
  <br />
  <b>11. Вы оказываете услуги по установке и настройке каталога?</b><br />
  <br />
  Если Вы не уверены в своих силах или испытываете некоторые затруднения по
  установке, настройке и интеграции скрипта в дизайн в Ваш сайт, Я могу
  предоставить Вам такую помощь.<br />
  А также доработать скрипт под конкретные задачи. Все предложение отправляйте на
  мои контактные данные для связи.';


$language["button"]["apply"] = "Применить";
$language["button"]["add"]  = "Добавить";
$language["button"]["edit"]  = "Редактировать";
$language["button"]["save"] = "Сохранить";
$language["button"]["save_changes_in"] = "сохранить изменения в";
$language["button"]["handcheck"] = "Проверить вручную";
$language["button"]["autocheck"] = "Проверить автоматически";
$language["button"]["remove"] = "Удалить";
$language["button"]["add_to_blacklist"] = "Добавить в черный спискок";
$language["button"]["reset"] = "Сброс";
$language["button"]["find"] = "найти";

$language["button"]["check_all_links_automatically"] = "Проверить все ссылки автоматически";





$language["msg"]["notfound"] = "По вашему запросу ничего не найдено!";
$language["msg"]["link_added"] = "Ссылка добавлена";
$language["msg"]["changes_added"] = "Изменения внесены";
$language["msg"]["password_changed"] = "Пароль был изменен";
$language["msg"]["link_removed"] = "Ссылка была удалена";
$language["msg"]["reason_admin"] = "По усмотрению администратора";
$language["msg"]["link_added_to_blacklist"] = "Ссылка добавлена в черный список";
$language["msg"]["reason_absense_reciprocal"] = "Отсутствие ответной или ссылка не доступна.";


$language["msg"]["subject_del"] = "Ваша ссылка удалена";

$language["msg"]["reason_closed_for_index_meta"] = "Закрыта для индексации метатэгом &lt;meta&nbsp;name=robot&gt;";









$language["msg"]["check_is_completed"] = "Проверка закончена";




















//errors
$language["error"]["wait_verification"] = "Этот сайт уже есть в каталоге!";
$language["error"]["already_exists"] = "Этот сайт уже есть в каталоге!";
$language["error"]["choose_category"] = "Выберите категорию!";
$language["error"]["wrong_url"] = "Неверно введен адрес сайта! Введите адрес сайта в виде <i>my-domain.com</i> или <i>www.my-domain.com</i>";
$language["error"]["same_hosting"] = "Добавляемый сайт находится на той же хостинг площадке, что и каталог!";
$language["error"]["wrong_email"] = "Неверно введен еmail! Введите email в виде <i>yourname@my-domain.com</i>";
$language["error"]["short_desc_without_spaces"] = "Текст краткое описания содержит слишком много символов без пробелов!";
$language["error"]["full_desc_without_spaces"] = "Текст полного описания содержит слишком много символов без пробелов!";
$language["error"]["wrong_html_banner"] = "HTML кода баннера введен не верно!";
$language["error"]["size_banner"] = "Размер баннера должен быть 88Х31!";
$language["error"]["nofill_name"] = "Введите название сайта!";
$language["error"]["nofill_url"] = "Введите адрес сайта!";
$language["error"]["nofill_briefdesc"] = "Введите краткое описание!";
$language["error"]["nofill_fulldesc"] = "Введите полное описание!";
$language["error"]["failed_add_changes_design"] = "Не удалось добавить изменения! Файл %FILE% недоступен для записи";
$language["error"]["fill_current_password"] = "Введите текущий пароль!";
$language["error"]["fill_password"] = "Пароль не введен!";
$language["error"]["fill_again_password"] = "Введите повторно пароль!";
$language["error"]["passwords_dont_match"] = "Пароли не совпадают!";
$language["error"]["wrong_password"] = "Текущий пароль не верен!";
$language["error"]["change_password"] = "Пароль не был сменён!";
$language["error"]["fill_cat_name"] = "Введите название категории!";
$language["error"]["filesize"] = "Размер файла больше %LIMIT% кб!";
$language["error"]["web_apps_error"] = "Ошибка веб приложения! Действия не были выполнены.";