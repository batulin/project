<?php

namespace App\Service;

use App\Entity\Rent;
use App\Model\RentModel;
use App\Exception\SelectedPlacesIsBusyOnThisTimeException;
use App\Exception\UnCorrectDateForRentException;
use App\Model\Day;
use App\Model\CalendarModel;
use App\Model\PlaceModel;
use App\Repository\PlaceRepository;
use App\Repository\RentRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use App\Entity\Place;
use DateInterval;
use DatePeriod;

class RentService
{
    public function __construct(private EntityManagerInterface $em,
                                private RentRepository $rents,
                                private PlaceRepository $places)
    {
    }

    public function allRents(): array
    {
        return $this->rents->findAll();
    }

    public function createRent(Rent $rent):void
    {
        $beginDate = $rent->getBeginDate();
        $endDate = $rent->getEndDate();
        if($beginDate > $endDate) {
            throw new UnCorrectDateForRentException();
        }
        $places = $rent->getPlaces();
        $places_ids = [];
        foreach ($places as $place) {
            array_push($places_ids, $place->getId());
        }
        $busy = $this->rents->isBusy($places_ids, $beginDate, $endDate);
        if($busy) {
            throw new SelectedPlacesIsBusyOnThisTimeException();
        }
        $dayPrice = 0;
        foreach ($places as $place) {
            $price = $place->getType()->getTypePrice();
            $dayPrice += $price;
        }
        $rent->setDayPrice($dayPrice);

        $this->rents->save($rent, true);
    }

    public function placesWithRents(array $dateInfo):CalendarModel
    {
        $currentDate = new DateTimeImmutable();
        $places = $this->places->findBy([], ['number'=>'ASC']);
        $rents = $this->rents->getRentsByMonth($dateInfo['firstDay'], $dateInfo['lastDay']);
        // все, что ниже вставить в цикл мест
        // перед циклом с датами сделать массив заказов (пустой) и сделать ципл проверки заказов
        // по месту и поместить в массив, а в цикле с датами вместо заказов всех вставить заказы места
        $items = [];
        foreach ($places as $place) {

            $placeModel = new PlaceModel($place->getId(), $place->getNumber());
            $placeRents = [];
            foreach ($rents as $rent) {
                foreach ($rent->getPlaces() as $rentPlace) {
                    if($rentPlace->getId() === $place->getId()){
                        $rentModel = (new RentModel())
                            ->setId($rent->getId())
                            ->setBeginDate($rent->getBeginDate())
                            ->setEndDate($rent->getEndDate())
                            ->setDayPrice($rent->getDayPrice())
                            ->setPayments($rent->getPayments());
                        array_push($placeRents, $rentModel);
                    }
                }
            }
            // проверка статуса выбранных заказов
            foreach ($placeRents as $rentItem) {
                $soum = 0;
                foreach ($rentItem->getPayments() as $payment) {
                    $soum += $payment->getSoum();
                }
                $dayCount = intval($rentItem->getBeginDate()->diff($rentItem->getEndDate())->days + 1);
                $rentPrice = $rentItem->getDayPrice() * $dayCount;
                if($soum === $rentPrice) {
                    $rentItem->setStatus('payed');
                } elseif($soum <= $rentPrice) {
                    if ($currentDate <= $rentItem->getEndDate()) {
                        $rentItem->setStatus('current');
                    } elseif ($currentDate > $rentItem->getEndDate()) {
                        $rentItem->setStatus('notPayed');
                    }
                }

            }

            foreach ($dateInfo['period'] as $calendarDay) {
                $day = new Day($calendarDay->format('d'));

                if (!empty($placeRents)) {
                    foreach ($placeRents as $placeRent) {
                        if ($placeRent->getBeginDate() <= $calendarDay && $placeRent->getEndDate() >= $calendarDay) {
                            $day->setRentId($placeRent->getId());
                            $day->setRentStatus($placeRent->getStatus());
                            $day->setDate(null);
                            break;
                        } else {
                            if (null === $day->getRentId()) {
                                $day->setDate($calendarDay);
                            } else {
                                break;
                            }
                        }
                    }
                } else {
                    $day->setDate($calendarDay);

                }
                $placeModel->addDay($day);

            }
            array_push($items, $placeModel);
        }

        return new CalendarModel($items);
    }

//    public function showRent($rentId): RentShowModel
//    {
//        $rent = $this->rents->find($rentId);
//        $rentPrice = $this->getFullPrice($rent);
//    }
    public function getDateInfo($month): array
    {
        $dateString = $month . '-01 00:00:00';
        $firstDay = new DateTimeImmutable($dateString);
        $lastDay = new DateTimeImmutable(sprintf('last day of %s', $firstDay->format('Y-m')));
        $interval = new DateInterval('P1D');
        $period = iterator_to_array(new DatePeriod($firstDay, $interval, $lastDay->modify('+1 day')));
        $nextMonth = $firstDay->add(new DateInterval('P1M'));
        $prevMonth = $firstDay->sub(new DateInterval('P1M'));

        return $monthInfo = [
            'period' => $period,
            'firstDay' => $firstDay,
            'lastDay' => $lastDay,
            'nextMonth' => $nextMonth,
            'prevMonth' => $prevMonth
        ];
    }

    public function getFullPrice(Rent $rent): int
    {
        $dayCount = intval($rent->getBeginDate()->diff($rent->getEndDate())->days + 1);
        return $rent->getDayPrice() * $dayCount;
    }

//    public function getRentPayments(Rent $rent): int
//    {
//        $dayCount = intval($rent->getBeginDate()->diff($rent->getEndDate())->days + 1);
//        return $rent->getDayPrice() * $dayCount;
//    }
}