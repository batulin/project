<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use http\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = (new Client())
            ->setFirstName('')
            ->setSecondName('');

        $manager->persist($client);

        $client2 = (new Client())
            ->setFirstName('')
            ->setSecondName('');

        $manager->persist($client2);

        $client3 = (new Client())
            ->setFirstName('')
            ->setSecondName('');

        $manager->persist($client3);

        $client4 = (new Client())
            ->setFirstName('')
            ->setSecondName('');

        $manager->persist($client4);

        $client5 = (new Client())
            ->setFirstName('')
            ->setSecondName('');

        $manager->persist($client5);




        $manager->flush();
    }
}
