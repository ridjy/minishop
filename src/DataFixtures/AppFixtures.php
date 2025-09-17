<?php

namespace App\DataFixtures;

use App\Factory\CategorieFactory;
use App\Factory\ProduitFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        //$manager->flush();
        CategorieFactory::createMany(15);
        ProduitFactory::createMany(50);
        UserFactory::createMany(15);
    }
}
