<?php

namespace Dena\IranPayment\Traits;

use Dena\IranPayment\Helpers\Currency;
use Dena\IranPayment\Exceptions\InvalidDataException;

trait PaymentData
{
    /**
     * Payment Amount variable
     *
     * @var int
     */
	protected int $amount;

    /**
     * Payment Currency variable
     *
     * @var string
     */
    protected string $currency = Currency::IRR;

    /**
     * Gateway Currency variable
     *
     * @var string
     */
    protected string $gateway_currency;

    /**
     * Set Amount function
     *
     * @param int $amount
     * @return $this
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get Amount function
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set Payment Currency function
     *
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): self
    {
        $currency = strtoupper($currency);

		if (!in_array($currency, [Currency::IRR, Currency::IRT])) {
			throw InvalidDataException::invalidCurrency();
        }

        $this->currency = $currency;

        return $this;
    }

    /**
     * Get Payment Currency function
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Set Gateway Currency function
     *
     * @param string $currency
     * @return $this
     */
    public function setGatewayCurrency(string $gateway_currency): self
    {
        $gateway_currency = strtoupper($gateway_currency);

		if (!in_array($gateway_currency, [Currency::IRR, Currency::IRT])) {
			throw InvalidDataException::invalidCurrency();
        }

        $this->gateway_currency = $gateway_currency;

        return $this;
    }

    /**
     * Get Payment Currency function
     *
     * @return string
     */
    public function getGatewayCurrency(): string
    {
        return $this->gateway_currency;
    }

    /**
     * Get Prepared Amount function
     *
     * @return int
     */
    public function getPreparedAmount(): int
    {
        if ($this->currency === $this->gateway_currency) {
            return $this->amount;
        } elseif ($this->currency === Currency::IRR && $this->gateway_currency === Currency::IRT) {
            return Currency::RialToToman($this->amount);
        } elseif ($this->currency === Currency::IRT && $this->gateway_currency === Currency::IRR) {
            return Currency::TomanToRial($this->amount);
        }

        return $this->amount;
    }
}
