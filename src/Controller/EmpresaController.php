<?php

namespace App\Controller;

use App\Entity\Empleado;
use App\Entity\Oficina;
use App\Form\OficinaType;
use App\Form\EmpleadoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class EmpresaController extends AbstractController
{
    
    #[Route('/', name: 'app_home')]
    public function home(): RedirectResponse
    {
        return $this->redirectToRoute('app_inicio'); 
    }

    #[Route('/inicio', name: 'app_inicio')]
    public function inicio(Request $request): Response
    {
        $numeroEmpleado = $request->query->get('numero_empleado');
        
        if ($numeroEmpleado) {
            return $this->redirectToRoute('app_update_empleados', ['numero' => $numeroEmpleado]);
        }

        return $this->render('empresa/inicio.html.twig');
    }

    #[Route('/oficinas', name: 'app_oficinas')]
    public function oficinas(EntityManagerInterface $em): Response
    {
        $oficinas = $em->getRepository(Oficina::class)->findAll();
        return $this->render('empresa/oficinas.html.twig', [
            'oficinas' => $oficinas
        ]);
    }

    #[Route('/empleados', name: 'app_empleados')]
    public function empleados(EntityManagerInterface $em): Response
    {
        $empleados = $em->getRepository(Empleado::class)->findAll();
        return $this->render('empresa/empleados.html.twig', [
            'empleados' => $empleados
        ]);
    }

    #[Route('/crear_oficinas', name: 'app_crear_oficinas')]
    public function crearOficina(Request $request, EntityManagerInterface $em): Response
    {
        $oficina = new Oficina();
        $form = $this->createForm(OficinaType::class, $oficina);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($oficina);
            $em->flush();
            return $this->redirectToRoute('app_oficinas');
        }

        return $this->render('empresa/crear_oficinas.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update_empleados/{numero}', name: 'app_update_empleados')]
    public function updateEmpleado(Request $request, EntityManagerInterface $em, $numero): Response
    {
        $empleado = $em->getRepository(Empleado::class)->findOneBy(['numero' => $numero]);

        if (!$empleado) {
            $this->addFlash('error', 'Empleado no encontrado.');
            return $this->redirectToRoute('app_empleados');
        }

        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_empleados');
        }

        return $this->render('empresa/update_empleados.html.twig', [
            'form' => $form->createView(),
            'empleado' => $empleado
        ]);
    }
}
