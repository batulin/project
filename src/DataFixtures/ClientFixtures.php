<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = (new Client())
            ->setFirstName('Мария')
            ->setSecondName('Ковылина');

        $manager->persist($client);

        $client2 = (new Client())
            ->setFirstName('Екатерина')
            ->setSecondName('Касько');

        $manager->persist($client2);

        $client3 = (new Client())
            ->setFirstName('Юлия')
            ->setSecondName('Шабалина');

        $manager->persist($client3);

        $client4 = (new Client())
            ->setFirstName('Ева')
            ->setSecondName('Якименко');

        $manager->persist($client4);

        $client5 = (new Client())
            ->setFirstName('Вика')
            ->setSecondName('Якименко');

        $manager->persist($client5);

        $client6 = (new Client())
            ->setFirstName('Олег')
            ->setSecondName('Ионин');

        $manager->persist($client6);

        $client7 = (new Client())
            ->setFirstName('Дмитрий')
            ->setSecondName('Кочкарев');

        $manager->persist($client7);

        $client8 = (new Client())
            ->setFirstName('Вадим')
            ->setSecondName('Елогвенко');

        $manager->persist($client8);

        $client9 = (new Client())
            ->setFirstName('Степан')
            ->setSecondName('Никонов');

        $manager->persist($client9);

        $client10 = (new Client())
            ->setFirstName('Юрий')
            ->setSecondName('Капанин');

        $manager->persist($client10);

        $manager->flush();
    }
}
