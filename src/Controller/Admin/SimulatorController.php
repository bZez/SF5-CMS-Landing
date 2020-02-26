<?php

namespace App\Controller\Admin;

use App\Entity\Simulator;
use App\Form\SimulatorType;
use App\Repository\SimulatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/simulator")
 */
class SimulatorController extends AbstractController
{
    /**
     * @Route("/", name="simulator_index", methods={"GET"})
     */
    public function index(SimulatorRepository $simulatorRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        return $this->render('administration/simulator/index.html.twig', [
            'simulators' => $simulatorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="simulator_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        $simulator = new Simulator();
        $form = $this->createForm(SimulatorType::class, $simulator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($simulator);
            $entityManager->flush();

            return $this->redirectToRoute('simulator_index');
        }

        return $this->render('administration/simulator/new.html.twig', [
            'simulator' => $simulator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="simulator_show", methods={"GET"})
     */
    public function show(Simulator $simulator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        return $this->render('administration/simulator/show.html.twig', [
            'simulator' => $simulator,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="simulator_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Simulator $simulator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        $form = $this->createForm(SimulatorType::class, $simulator);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('simulator_index');
        }
        return $this->render('administration/simulator/edit.html.twig', [
            'simulator' => $simulator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="simulator_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Simulator $simulator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        if ($this->isCsrfTokenValid('delete'.$simulator->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($simulator);
            $entityManager->flush();
        }

        return $this->redirectToRoute('simulator_index');
    }
}
