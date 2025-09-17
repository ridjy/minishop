<?php

namespace App\Factory;

use App\Entity\Produit;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Produit>
 */
final class ProduitFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Produit::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     */
    protected function defaults(): array|callable
    {
        $images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg'];
        return [
            'nom' => self::faker()->unique()->regexify('[A-Za-z0-9]{3,15}'),
            'description' => self::faker()->paragraph(),
            'prix' => self::faker()->randomFloat(2, 5, 200),
            'stock' => self::faker()->numberBetween(0, 50),
            'categorie' => CategorieFactory::random(),
            'image' => 'fixtures/' . $images[array_rand($images)],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Produit $produit): void {})
        ;
    }
}
