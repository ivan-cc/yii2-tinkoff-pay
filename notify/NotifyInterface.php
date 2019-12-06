<?php
/**
 * Created by PhpStorm.
 * User: ivan-cc
 * Date: 29.12.18
 * Time: 17:26
 */

namespace ivan-cc\tinkoffPay\notify;


/**
 * Interface NotifyInterface
 * @package chumakovanton\tinkoffPay\notify
 */
interface NotifyInterface
{
    /**
     * Успешность операции
     * @return bool
     */
    public function getSuccess(): bool;

    /**
     * Получить ошибку, которую вернул сервис оплаты
     * @return string|null
     */
    public function getError(): ?string;

    /**
     * Получить статус транзакции
     * @return string
     */
    public function getStatus(): ?string;

    /**
     * Уникальный идентификатор транзакции в сервисе оплаты
     * @return int
     */
    public function getPaymentId(): ?int;

    /**
     * Идентификатор терминала
     * @return string
     */
    public function getTerminalKey(): ?string;

    /**
     * Номер заказа в системе
     * @return string
     */
    public function getOrderId(): ?string;

    /**
     * Сумма заказа
     * @return string
     */
    public function getAmount(): ?int;

    /**
     * Массив со всеми данными
     * @return string
     */
    public function getRAW(): ?array;
}
