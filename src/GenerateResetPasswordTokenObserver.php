<?php
namespace Nemesis\ResetPasswordObserver;

/**
 * Генерация токена сброса пароля при создании нового пользователя
 *
 * Class GenerateResetPasswordTokenObserver
 * @package ResetPasswordObserver
 * @author Bondarenko Kirill <bondarenko.kirill@gmail.com>
 * @version 1.0
 */
class GenerateResetPasswordTokenObserver
{
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
        }

        return true;
    }
}