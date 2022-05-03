<?php

namespace App\DataFixtures;

use App\Entity\Servicio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $servicio1 = new Servicio();
        $servicio1->setNombre('Cambio de Aceite')->setCosto(1000);
        $manager->persist($servicio1);

        $servicio2 = new Servicio();
        $servicio2->setNombre('Cambio de Filtro')->setCosto(2000);
        $manager->persist($servicio2);

        $servicio3 = new Servicio();
        $servicio3->setNombre('Cambio de Correa')->setCosto(3000);
        $manager->persist($servicio3);

        $servicio4 = new Servicio();
        $servicio4->setNombre('Revisión General')->setCosto(4000);
        $manager->persist($servicio4);

        $servicio5 = new Servicio();
        $servicio5->setNombre('Pintura')->setCosto(5000);
        $manager->persist($servicio5);

        $servicio6 = new Servicio();
        $servicio6->setNombre('Otro')->setCosto(0);
        $manager->persist($servicio6);

        $manager->flush();
    }
}
