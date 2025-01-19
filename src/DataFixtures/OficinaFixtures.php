<?php
namespace App\DataFixtures;

use App\Entity\Oficina;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OficinaFixtures extends Fixture
{
    public const OFICINA_REFERENCE = 'oficina_';

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $oficina = new Oficina();
            $oficina->setNumero($i);
            $oficina->setNombre("Oficina $i");
            $oficina->setDireccion("Calle $i");
            $oficina->setCiudad("Ciudad $i");
            $manager->persist($oficina);

            $this->addReference(self::OFICINA_REFERENCE .$i, $oficina);
        }

        $manager->flush();
    }
}

