<?php

namespace App\Controller;

use App\Entity\Simulator;
use App\Form\SimulatorType;
use App\Repository\SimulatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/simulator")
 */
class SimulatorController extends AbstractController
{
    /**
     * @Route("/", name="simulator_index", methods={"GET"})
     */
    public function index(SimulatorRepository $simulatorRepository): Response
    {
        return $this->render('admin/simulator/index.html.twig', [
            'simulators' => $simulatorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="simulator_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $simulator = new Simulator();
        $form = $this->createForm(SimulatorType::class, $simulator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($simulator);
            $entityManager->flush();

            return $this->redirectToRoute('simulator_index');
        }

        return $this->render('admin/simulator/new.html.twig', [
            'simulator' => $simulator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="simulator_show", methods={"GET"})
     */
    public function show(Simulator $simulator): Response
    {
        return $this->render('admin/simulator/show.html.twig', [
            'simulator' => $simulator,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="simulator_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Simulator $simulator): Response
    {
        $form = $this->createForm(SimulatorType::class, $simulator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('simulator_index');
        }

        return $this->render('admin/simulator/edit.html.twig', [
            'simulator' => $simulator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="simulator_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Simulator $simulator): Response
    {
        if ($this->isCsrfTokenValid('delete'.$simulator->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($simulator);
            $entityManager->flush();
        }

        return $this->redirectToRoute('simulator_index');
    }
}
