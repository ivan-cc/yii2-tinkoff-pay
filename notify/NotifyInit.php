<?php
/**
 * Created by PhpStorm.
 * User: ivan-cc
 * Date: 29.12.2018
 * Time: 13:04
 */

namespace ivan_cc\tinkoffPay\notify;


class NotifyInit extends AbstractNotify
{
    /**
     * Сумма в копейках
     * @return null|bool
     */
    public function checkToken(): ?bool
    {
        $actualToken = $this->getToken();
        $expectedToken = $this->generateToken();

        return (
            ! empty( $actualToken )
            && ! empty( $expectedToken )
            && $actualToken  == $expectedToken);
    }

    /**
     * Генерация токена на основе пришедших данных
     * @return null|string
     */
    public function generateToken(): ?string
    {
        $token = '';
        $fields = $this->_response;
        //добавляем пароль из настроек
        $fields['Password'] = $this->_secretKey;
        //удаляем пришедший токен
        unset($fields['Token']);
        ksort($fields);


        foreach ($fields as $field) {

            if($field === true) $field = 'true';
            else if($field === false) $field = 'false';

            $token .= $field;
        }

        return hash('sha256', $token);
    }
}
