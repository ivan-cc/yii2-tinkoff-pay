<?php
/**
 * Created by PhpStorm.
 * User: ivan-cc
 * Date: 29.12.18
 * Time: 17:24
 */

namespace ivan-cc\tinkoffPay\notify;


use yii\helpers\Json;

abstract class AbstractNotify implements NotifyInterface
{
    /**
     * Секретный ключ терминала
     * @var string
     */
    protected $_secretKey;

    /**
     * @var array
     */
    protected $_response;

    public function __construct(string $secretKey)
    {
        $this->_secretKey = $secretKey;
        $this->_response = \Yii::$app->getRequest()->getBodyParams();
    }

    /**
     * Успешность операции
     * @return bool
     */
    public function getSuccess(): bool
    {
        return !empty($this->_response) && $this->_response['Success'];
    }

    /**
     * Получить ошибку, которую вернул сервис оплаты
     * @return string|null
     */
    public function getError(): ?string
    {
        $error = null;
        if ($this->_response['ErrorCode'] !== '0') {
            $error = new ErrorNotify($this->_response['ErrorCode']);
            return $error->getDescription();
        }
        return $error;
    }

    /**
     * Получить статус транзакции
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->_response['Status'];
    }

    /**
     * Уникальный идентификатор транзакции в сервисе оплаты
     * @return null|int
     */
    public function getPaymentId(): ?int
    {
        return $this->_response['PaymentId'];
    }

    /**
     * Идентификатор терминала
     * @return null|string
     */
    public function getTerminalKey(): ?string
    {
        return $this->_response['TerminalKey'];
    }

    /**
     * Номер заказа в системе
     * @return null|string
     */
    public function getOrderId(): ?string
    {
        return $this->_response['OrderId'];
    }



    /**
     * Код ошибки, если произошла ошибка
     * @return null|string
     */
    public function getErrorCode(): ?string
    {
        return $this->_response['ErrorCode'];
    }

    /**
     * Текущая сумма транзакции в копейках
     * @return null|string
     */
    public function getAmount(): ?int
    {
        return $this->_response['Amount'];
    }

    /**
     * Идентификатор рекуррентного платежа
     * @return null|string
     */
    public function getRebillId(): ?int
    {
        return $this->_response['RebillId'];
    }

    /**
     * Идентификатор привязанной карты
     * @return null|string
     */
    public function getCardId(): ?int
    {
        return $this->_response['CardId'];
    }

    /**
     * Маскированный номер карты
     * @return null|string
     */
    public function getPan(): ?string
    {
        return $this->_response['Pan'];
    }

    /**
     * Дополнительные параметры платежа, переданные при создании заказа
     * @return null|string
     */
    public function getDATA(): ?array
    {
        return $this->_response['DATA'];
    }

    /**
     * Подпись запроса.
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->_response['Token'];
    }

    /**
     * Срок действия карты
     * @return null|string
     */
    public function getExpDate(): ?string
    {
        return $this->_response['ExpDate'];
    }

    /**
     * Массив со всеми данными
     * @return null|string
     */
    public function getRAW(): ?array
    {
        return $this->_response;
    }
      
}
