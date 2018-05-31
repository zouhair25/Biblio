<?php

namespace PFE\DashBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PFE\DashBundle\Entity\Catalogue;
use PFE\DashBundle\Entity\Province;
use PFE\DashBundle\Entity\Typeanimation;
use PFE\DashBundle\Entity\Typeespace;
use PFE\DashBundle\Entity\Typeequipement;
use PFE\DashBundle\Entity\Typefondoc;
use PFE\DashBundle\Entity\Typepret;

class basis implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $this->insertCatalogues($manager);
        $this->insertProvinces($manager);
        $this->insertTypeanimation($manager);
        $this->insertTypeequipement($manager);
        $this->insertTypeespace($manager);
        $this->insertTypefondoc($manager);
        $this->insertTypepret($manager);

    }

    public function insertCatalogues(ObjectManager $manager)
    {
        $c1 = new Catalogue();
        $c1->setNom("Papier");
        $manager->persist($c1);
        $c2 = new Catalogue();
        $c2->setNom("Informatisé");
        $manager->persist($c2);
        $c3 = new Catalogue();
        $c3->setNom("Papier et informatisé");
        $manager->persist($c3);
        $manager->flush();
    }

    public function insertProvinces(ObjectManager $manager)
    {
        $p1 = new Province();
        $p1->setNom("Kenitra");
        $manager->persist($p1);
        $p2 = new Province();
        $p2->setNom("Sidi Slimane");
        $manager->persist($p2);
        $p3 = new Province();
        $p3->setNom("Sidi Kacem");
        $manager->persist($p3);
        $manager->flush();
    }

    public function insertTypeanimation(ObjectManager $manager)
    {
        $t1 = new Typeanimation();
        $t1->setNom("Expositions");
        $manager->persist($t1);
        $t2 = new Typeanimation();
        $t2->setNom("Heures du conte");
        $manager->persist($t2);
        $t3 = new Typeanimation();
        $t3->setNom("Visites ecoles");
        $manager->persist($t3);
        $t4 = new Typeanimation();
        $t4->setNom("Clubs lecture");
        $manager->persist($t4);
        $t5 = new Typeanimation();
        $t5->setNom("Signatures livres");
        $manager->persist($t5);
        $t6 = new Typeanimation();
        $t6->setNom("Conférences");
        $manager->persist($t6);
        $t7 = new Typeanimation();
        $t7->setNom("Lectures");
        $manager->persist($t7);
        $t8 = new Typeanimation();
        $t8->setNom("Ateliers");
        $manager->persist($t8);
        $manager->flush();
    }

    public function insertTypeequipement(ObjectManager $manager)
    {
        $t1 = new Typeequipement();
        $t1->setNom("Ordinateur");      $t1->setIsRayonnage(false);
        $manager->persist($t1);
        $t2 = new Typeequipement();
        $t2->setNom("Imprimante");      $t2->setIsRayonnage(false);
        $manager->persist($t2);
        $t3 = new Typeequipement();
        $t3->setNom("Imprimante couleur");$t3->setIsRayonnage(false);
        $manager->persist($t3);
        $t4 = new Typeequipement();
        $t4->setNom("Photocopieuse");   $t4->setIsRayonnage(false);
        $manager->persist($t4);
        $t5 = new Typeequipement();
        $t5->setNom("Rétro-projecteur");$t5->setIsRayonnage(false);
        $manager->persist($t5);
        $t6 = new Typeequipement();
        $t6->setNom("Rayonnage enfant");$t6->setIsRayonnage(true);
        $manager->persist($t6);
        $t7 = new Typeequipement();
        $t7->setNom("Rayonnage adulte");$t7->setIsRayonnage(true);
        $manager->persist($t7);
        $manager->flush();
    }

    public function insertTypeespace(ObjectManager $manager)
    {
        $t1 = new Typeespace();
        $t1->setNom("Espace enfant");
        $manager->persist($t1);
        $t2 = new Typeespace();
        $t2->setNom("Espace jeune");
        $manager->persist($t2);
        $t3 = new Typeespace();
        $t3->setNom("Espace adulte");
        $manager->persist($t3);
        $t4 = new Typeespace();
        $t4->setNom("Espace multimedia");
        $manager->persist($t4);
        $t5 = new Typeespace();
        $t5->setNom("Espace audiovisuel");
        $manager->persist($t5);
        $t6 = new Typeespace();
        $t6->setNom("Espace animation");
        $manager->persist($t6);
        $t7 = new Typeespace();
        $t7->setNom("Espace lecture");
        $manager->persist($t7);
        $manager->flush();
    }

    public function insertTypefondoc(ObjectManager $manager)
    {
        $t1 = new Typefondoc();
        $t1->setNom("Documents en langue arabe"); $t1->setIsMultimedia(false);
        $manager->persist($t1);
        $t2 = new Typefondoc();
        $t2->setNom("Documents en langue étrangère"); $t2->setIsMultimedia(false);
        $manager->persist($t2);
        $t3 = new Typefondoc();
        $t3->setNom("Documents en langue amazighe");$t3->setIsMultimedia(false);
        $manager->persist($t3);
        $t4 = new Typefondoc();
        $t4->setNom("Fonds multimédia"); $t4->setIsMultimedia(true);
        $manager->persist($t4);
        $manager->flush();
    }

    public function insertTypepret(ObjectManager $manager)
    {
        $c1 = new Typepret();
        $c1->setNom("Interne");
        $manager->persist($c1);
        $c2 = new Typepret();
        $c2->setNom("Externe");
        $manager->persist($c2);
        $manager->flush();
    }
}