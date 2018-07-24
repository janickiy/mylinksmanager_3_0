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

$language['menu']['update_title'] = 'Обновление';
$language['menu']['update'] = 'Обновление';

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

$language["str"]["pnumber"] = 'Кол-во строк';;



$language["str"]["links_waiting_checks"] = "Ссылки в очереди на проверку";
$language["str"]["links_for_check"] = "Ссылки на проверку";


$language["str"]["subject_add"] = "Ваш сайт добавлен в каталог ссылок";

$language["str"]["subject_hide"] = "Ваша ссылка времено скрыта";


$language["str"]["import_links"] = "Импорт";
$language["str"]["export_links"] = "Экспорт";

$language["str"]["apply"] = "Применить";


$language["str"]["check"] = "Проверить";


$language["str"]["status"] = "Статус";

$language["str"]["show"] = "Отобразить";
$language["str"]["black"] = "В черный список";

$language["str"]["selected_links_added"] = "Выбранные ссылки добавлены";
$language["str"]["selected_links_black"] = "Выбранные ссылки добавлены в чёрный список";
$language["str"]["selected_links_ckecked"] = "Выбранные ссылки проверены";


$language["str"]["new_links"] = 'Новые ссылки';

$language["str"]["add_url"] = 'Добавить ссылку';

$language["str"]["read_more"] = "Подробнее...";






$language["status"]["new"] = "Новые";
$language["status"]["show"] = "Проверено";
$language["status"]["hide"] = "На проверке";
$language["status"]["black"] = "В черном списке";






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
$language["msg"]["selected_links_deleted"] = "Ссылка удалена";
$language["msg"]["reason_closed_for_index_robot"] = "Закрыта для индексации в robots.txt";

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