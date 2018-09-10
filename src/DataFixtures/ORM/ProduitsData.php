<?php
namespace App\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Produits;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface{
	public function load(ObjectManager $manager)
	{
		$produits1 = new Produits();
		$produits1->setCategorie($this->getReference('categorie1'));
		$produits1->setNom('Chemise');
		$produits1->setPrix('2.30');
		$produits1->setDisponible('1');

		$produits2 = new Produits();
		$produits2->setCategorie($this->getReference('categorie2'));
		$produits2->setNom('Veste');
		$produits2->setPrix('5.30');
		$produits2->setDisponible('1');

		$produits3 = new Produits();
		$produits3->setCategorie($this->getReference('categorie3'));
		$produits3->setNom('Pantalon');
		$produits3->setPrix('5.30');
		$produits3->setDisponible('1');

		$produits4 = new Produits();
		$produits4->setCategorie($this->getReference('categorie1'));
		$produits4->setNom('Rob');
		$produits4->setPrix('15.30');
		$produits4->setDisponible('1');

		$produits5 = new Produits();
		$produits5->setCategorie($this->getReference('categorie2'));
		$produits5->setNom('Chemisier');
		$produits5->setPrix('10.30');
		$produits5->setDisponible('1');

		$manager->persist($produits1);
		$manager->persist($produits2);
		$manager->persist($produits3);
		$manager->persist($produits4);
		$manager->persist($produits5);

		$manager->flush();


	}
	public function getOrder()
	{
		return 3;
	}
}