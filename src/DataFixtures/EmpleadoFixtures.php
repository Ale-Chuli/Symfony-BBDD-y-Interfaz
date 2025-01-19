<?php
namespace App\DataFixtures;

use App\Entity\Empleado;
use App\Entity\Oficina;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Node\Expr\Cast\Object_;

class EmpleadoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $empleado = new Empleado();
            $empleado->setNumero($i);
            $empleado->setNombre("Empleado $i");
            $empleado->setApellidos("Apellido $i");
            $empleado->setEdad(20 + $i);
            $empleado->setPuesto("Puesto $i");
            $empleado->setEmail("empleado$i@example.com");

            $empleado->setOficina($this->getReference(OficinaFixtures::OFICINA_REFERENCE .$i,Oficina::class));
           
            $manager->persist($empleado);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OficinaFixtures::class,
        ];
    }
} 


