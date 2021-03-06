<?php


namespace System\library\acc;


use JetBrains\PhpStorm\Pure;

class Acc
{
    private int $initialSumDebit = 0;
    private int $initialSumCredit = 0;
    private int $finalBalanceDebit;
    private int $finalBalanceCredit;


    public function getSumDebit(): int
    {
        return $this->initialSumDebit;
    }


    public function getSumCredit(): int
    {
        return $this->initialSumCredit;
    }


    public function setSumDebit($inputSumDebit): void
    {
        $this->initialSumDebit = $inputSumDebit;
    }


    public function setSumCredit($inputSumCredit): void
    {
        $this->initialSumCredit = $inputSumCredit;
    }

    public function plusDebit($inputSum): int
    {
        return $this->initialSumDebit + $inputSum;
    }

    public function minusDebit($inputSum): int
    {

        return $this->initialSumDebit - $inputSum;
    }

    public function plusCredit($inputSum): int
    {
        return $this->initialSumCredit + $inputSum;
    }

    public function minusCredit($inputSum): int
    {
        return $this->initialSumCredit - $inputSum;
    }


    /**
     * Оборот по Дебиту Активные счета
     *
     *
     */

    public function debitTurnoverActiveAccounts($activeAccounts)
    {

    }

    /**
     * Оборот по кредиту Пассивные счета
     *
     */
    public function creditTurnoverPassiveAccounts($passiveAccounts)
    {

    }




    /**
     * Определить Сальдо-конечное в Активном счете:
     * С-доН + итог оборота по Дебету(+) и минус итог оборота по Кредиту
     *
     * @param $InitialDebitBalance
     * @return int
     */
    #[Pure] public function finalBalanceActive($InitialDebitBalance): int
    {
        return $this->initialSumDebit + $this->plusDebit($InitialDebitBalance) - $this->plusCredit($InitialDebitBalance);
    }

    /**
     * Определить Сальдо-конечное в Пассивном счете:
     * С-доН + итог оборота по Кредиту(+) и минус итог оборота по Дебиту
     *
     * @param $InitialCreditBalance
     * @return int
     */

    #[Pure] public function finalBalancePassive($InitialCreditBalance): int
    {
        return $this->initialSumCredit + $this->plusCredit($InitialCreditBalance) - $this->plusCredit($InitialCreditBalance);
    }

    /**
     * Создает  и  записывает  бухгалтерскую  проводку
     *
     * @param mixed $paramDebit код дебетового  счета или null
     * @param mixed $paramCredit код кредитового  счета или null
     * @param mixed $amount Сумма (в копейках)  Отрицательное  значение выполняет сторнирование.
     * @param mixed $document_id документ-основание
     *
     */

    public function accEntry($paramDebit, $paramCredit)
    {
        $sqlDebit = '';
        $sqlCredit = '';



    }

}