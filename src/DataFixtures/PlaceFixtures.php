<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\TypeOfPlace;
use App\Entity\Place;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $place = (new Place())
            ->setNumber('1-1');

        $manager->persist($place);

        $place2 = (new Place())
            ->setNumber('1-2');

        $manager->persist($place2);

        $place3 = (new Place())
            ->setNumber('2-1');

        $manager->persist($place3);

        $place4 = (new Place())
            ->setNumber('2-2');

        $manager->persist($place4);


        $place5 = (new Place())
            ->setNumber('3-1');

        $manager->persist($place5);

        $place6 = (new Place())
            ->setNumber('3-2');

        $manager->persist($place6);


        $place7 = (new Place())
            ->setNumber('4-1');

        $manager->persist($place7);

        $place8 = (new Place())
            ->setNumber('4-2');

        $manager->persist($place8);

        $place9 = (new Place())
            ->setNumber('4-3');

        $manager->persist($place9);

        $place10 = (new Place())
            ->setNumber('4-4');

        $manager->persist($place10);


        $place11 = (new Place())
            ->setNumber('5-1');

        $manager->persist($place11);

        $place12 = (new Place())
            ->setNumber('5-2');

        $manager->persist($place12);

        $place13 = (new Place())
            ->setNumber('5-3');

        $manager->persist($place13);

        $place14 = (new Place())
            ->setNumber('5-4');

        $manager->persist($place14);

        $place15 = (new Place())
            ->setNumber('5-5');

        $manager->persist($place15);

        $place16 = (new Place())
            ->setNumber('5-6');

        $manager->persist($place16);


        $place17 = (new Place())
            ->setNumber('6-1');

        $manager->persist($place17);

        $place18 = (new Place())
            ->setNumber('6-2');

        $manager->persist($place18);

        $place19 = (new Place())
            ->setNumber('6-3');

        $manager->persist($place19);

        $place20 = (new Place())
            ->setNumber('6-4');

        $manager->persist($place20);


        $place21 = (new Place())
            ->setNumber('7-1');

        $manager->persist($place21);

        $place22 = (new Place())
            ->setNumber('7-2');

        $manager->persist($place22);

        $place23 = (new Place())
            ->setNumber('7-3');

        $manager->persist($place23);

        $place24 = (new Place())
            ->setNumber('7-4');

        $manager->persist($place24);

        $place25 = (new Place())
            ->setNumber('7-5');

        $manager->persist($place25);


        $place25 = (new Place())
            ->setNumber('8-1');

        $manager->persist($place25);

        $place26 = (new Place())
            ->setNumber('8-2');

        $manager->persist($place26);

        $place27 = (new Place())
            ->setNumber('8-3');

        $manager->persist($place27);

        $place28 = (new Place())
            ->setNumber('8-4');

        $manager->persist($place28);

        $place29 = (new Place())
            ->setNumber('8-5');

        $manager->persist($place29);

        $place30 = (new Place())
            ->setNumber('8-6');

        $manager->persist($place30);


        $place31 = (new Place())
            ->setNumber('9-1');

        $manager->persist($place31);


        $place32 = (new Place())
            ->setNumber('10-1');

        $manager->persist($place32);


        $place33 = (new Place())
            ->setNumber('11-1');

        $manager->persist($place33);



        $manager->flush();
    }


}
