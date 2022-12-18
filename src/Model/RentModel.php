<?php

namespace App\Model;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class RentModel
{
    private int $id;
    private DateTimeImmutable $beginDate;
    private DateTimeImmutable $endDate;
    private int $dayPrice;
    private Collection $payments;
    private string $status;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getBeginDate(): DateTimeImmutable
    {
        return $this->beginDate;
    }

    public function setBeginDate(DateTimeImmutable $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(DateTimeImmutable $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }


    public function getDayPrice(): int
    {
        return $this->dayPrice;
    }

    public function setDayPrice(int $dayPrice): self
    {
        $this->dayPrice = $dayPrice;

        return $this;
    }

    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function setPayments(Collection $payments): self
    {
        $this->payments = $payments;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

}
