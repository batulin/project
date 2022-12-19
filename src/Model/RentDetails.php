<?php

namespace App\Model;

use App\Entity\Client;
use App\Entity\Payment;
use App\Entity\Place;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

class RentDetails
{
    private int $id;

    private DateTimeImmutable $beginDate;

    private DateTimeImmutable $endDate;

    private Client $client;

    private Collection $places;

    private int $dayPrice;

    private Collection $payments;

    private int $rentPrice;

    private int $paymentsSoum;

    private int $diff;

    private string $payedStatus;


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

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function setPlaces(Collection $places): self
    {
        $this->places = $places;

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

    public function getRentPrice(): int
    {
        return $this->rentPrice;
    }

    public function setRentPrice(int $rentPrice): self
    {
        $this->rentPrice = $rentPrice;

        return $this;
    }


    public function getPaymentsSoum(): int
    {
        return $this->paymentsSoum;
    }

    public function setPaymentsSoum(int $paymentsSoum): self
    {
        $this->paymentsSoum = $paymentsSoum;

        return $this;
    }

    public function getDiff(): int
    {
        return $this->diff;
    }

    public function setDiff(int $diff): self
    {
        $this->diff = $diff;

        return $this;
    }

    public function getPayedStatus(): string
    {
        return $this->payedStatus;
    }

    public function setPayedStatus(string $payedStatus): self
    {
        $this->payedStatus = $payedStatus;

        return $this;
    }
}