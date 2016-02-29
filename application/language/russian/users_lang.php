<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 */

// Titles
$lang['users title forgot']                   = "Забыт пароль";
$lang['users title login']                    = "Авторизация";
$lang['users title profile']                  = "Профиль";
$lang['users title register']                 = "Регистрация";
$lang['users title user_add']                 = "Добавление пользователя";
$lang['users title user_delete']              = "Подтвердите удаление пользователя";
$lang['users title user_edit']                = "Редактирование пользователя";
$lang['users title user_list']                = "Список пользователей";

// Buttons
$lang['users button add_new_user']            = "Добавить нового пользователя";
$lang['users button register']                = "Создать аккаунт";
$lang['users button reset_password']          = "Сбросить пароль";
$lang['users button login_try_again']         = "Попробуй еще раз";

// Tooltips
$lang['users tooltip add_new_user']           = "Создать нового пользователя.";

// Links
$lang['users link forgot_password']           = "Забыли свой пароль?";
$lang['users link register_account']          = "Регистрация аккаунта";

// Table Columns
$lang['users col first_name']                 = "Имя";
$lang['users col is_admin']                   = "Админ";
$lang['users col last_name']                  = "Фамилия";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Логин";

// Form Inputs
$lang['users input email']                    = "Email";
$lang['users input first_name']               = "Имя";
$lang['users input is_admin']                 = "Администратор";
$lang['users input language']                 = "Язык";
$lang['users input last_name']                = "Фамилия";
$lang['users input password']                 = "Пароль";
$lang['users input password_repeat']          = "Повторите пароль";
$lang['users input status']                   = "Статус";
$lang['users input username']                 = "Логин";
$lang['users input username_email']           = "Логин или Email";

// Help
$lang['users help passwords']                 = "* заполнять только при необходимости смены пароля";

// Messages
$lang['users msg add_user_success']           = "%s был успешно добавлен!";
$lang['users msg delete_confirm']             = "Вы уверены, что хотите удалить <strong>%s</strong>? Отменить данное действие будет невозможно.";
$lang['users msg delete_user']                = "Вы успешно удалили <strong>%s</strong>!";
$lang['users msg edit_profile_success']       = "Ваш профиль успешно обновлён!";
$lang['users msg edit_user_success']          = "%s успешно изменён!";
$lang['users msg register_success']           = "%s, спасибо за регистрацию! На указанный вами адрес выслано письмо для подтверждения регистрации.
                                                 После подтверждения вашей учётной записи, вы сможете авторизироваться с доступными вам полномочиями
                                                 ";
$lang['users msg password_reset_success']     = "Ваш пароль был сброшен, %s! Проверьте почту с вашим временным паролем.";
$lang['users msg validate_success']           = "Ваша учётная запись подтверждена. Вы можете войти в свою учётную запись";
$lang['users msg email_new_account']          = "<p>Спасибо за создание учётной записи %s. Нажмите ссылку ниже для подтверждения вашей почты
                                                 .<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "Новый аккаунт для  %s";
$lang['users msg email_password_reset']       = "<p>%s ваш пароль был сброшен. Нажмите ссылку ниже для авторизации с новым паролем
                                                 :<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Авторизировавшись, не забудьте изменить пароль, на тот, который сможете запомнить.</p>";
$lang['users msg email_password_reset_title'] = "Сброшен пароль для  %s";

// Errors
$lang['users error add_user_failed']          = "%s не может быть добавлен!";
$lang['users error delete_user']              = "<strong>%s</strong> не может быть удалён!";
$lang['users error edit_profile_failed']      = "Ваш профиль не может быть изменён!";
$lang['users error edit_user_failed']         = "%s не может быть изменён!";
$lang['users error email_exists']             = "<strong>%s</strong> такая почта уже используется!";
$lang['users error email_not_exists']         = "Неправильно указан адрес почты для восстановления!";
$lang['users error invalid_login']            = "Неправильный логин или пароль";
$lang['users error password_reset_failed']    = "Возникла проблема при сбросе пароля, повторите попытку.";
$lang['users error register_failed']          = "Ваш аккаунт не может быть создан на данный момент. Попробуйте снова.";
$lang['users error user_id_required']         = "Необходим числовой идентификатор пользователя!";
$lang['users error user_not_exist']           = "Такого пользователя не существует!";
$lang['users error username_exists']          = "Имя пользователя <strong>%s</strong> уже существует!";
$lang['users error validate_failed']          = "Возникла проблема при проверке аккаунта. Попробуйте снова.";
$lang['users error too_many_login_attempts']  = "Вы сделали слишком много попыток входа в систему слишком быстро. Пожалуйста, подождите %s секунд и повторите попытку.";
