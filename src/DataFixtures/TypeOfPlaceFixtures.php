<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\TypeOfPlace;

class TypeOfPlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type = (new TypeOfPlace())
            ->setTypeName('Гостевой')
            ->setSlug('guest')
            ->setTypePrice(100);

        $manager->persist($type);

        $type2 = (new TypeOfPlace())
            ->setTypeName('Стфндартный')
            ->setSlug('standart')
            ->setTypePrice(120);

        $manager->persist($type2);

        $type3 = (new TypeOfPlace())
            ->setTypeName('Президентский')
            ->setSlug('vip')
            ->setTypePrice(200);

        $manager->persist($type3);

        $manager->flush();

        $this->addReference('guest', $type);
        $this->addReference('standart', $type2);
        $this->addReference('vip', $type3);

    }
}
