<?php
namespace App\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Categories;

class CategorieData extends AbstractFixture implements OrderedFixtureInterface {
	public function load(ObjectManager $manager)
	{
		$categorie1 = new Categories();
		$categorie1->setCategorie('Pressing');

		$categorie2 = new Categories();
		$categorie2->setCategorie('Retouche');

		$categorie3 = new Categories();
		$categorie3->setCategorie('Ambulement');

		$categorie4 = new Categories();
		$categorie4->setCategorie('Blanchessire');

		$manager->persist($categorie1);
		$manager->persist($categorie2);
		$manager->persist($categorie3);
		$manager->persist($categorie4);

		$manager->flush();

		$this->addReference('categorie1', $categorie1);
		$this->addReference('categorie2', $categorie2);
		$this->addReference('categorie3', $categorie3);
		$this->addReference('categorie4', $categorie4);


	}

	public function getOrder()
	{
		return 2;
	}
}