<?php
namespace Nemesis\ResetPasswordObserver;

/**
 * Генерация токена сброса пароля при создании нового пользователя, и отправка ссылки для сохдания нового пароля на
 * почту
 *
 * Class GenerateResetPasswordTokenObserver
 * @package ResetPasswordObserver
 * @author Bondarenko Kirill <bondarenko.kirill@gmail.com>
 * @version 1.0
 */
class GenerateResetPasswordTokenObserver
{
    /**
     * Адрес страницы ввода нового пароля
     *
     * @var string
     */
    protected $urlToSetPassword = 'users/new-password/';

    /**
     * Тема письма
     *
     * @var string
     */
    protected $subject = 'Создание пароля';

    /**
     * @param $model
     * @return bool
     * @since 1.0
     */
    public function created($model)
    {
        if (!$model->password) {
            $model->reset_password_token = hash('md5', microtime());
            $model->save();

            mail($model->email, $this->subject, link_to($this->urlToSetPassword . $model->reset_password_token));
        }

        return true;
    }
}