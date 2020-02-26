<?php

namespace App\Controller;

use App\Entity\Lead;
use App\Repository\LeadRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function index(PageRepository $repository)
    {
        $page = $repository->findOneBy(['nom'=>'default']);
        return $this->render('front/index.html.twig', [
            'page' => $page,
        ]);
    }
    /**
     * @Route("/ma-pompe-a-chaleur", name="front_pap")
     */
    public function pap(PageRepository $repository)
    {
        $page = $repository->findOneBy(['nom'=>'pap']);
        return $this->render('front/pap/index.html.twig', [
            'page' => $page,
        ]);
    }
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request)
    {
        $lead = new Lead();


        if ($request->isMethod('POST')) {
            $datas = $request->request->get('lead');
            $lead->setLogement($datas['logement']);
            $lead->setChauffage($datas['chauffage']);
            $lead->setNom($datas['nom']);
            $lead->setPrenom($datas['prenom']);
            $lead->setAdresse($datas['adresse']);
            $lead->setVille($datas['ville']);
            $lead->setCodePostal($datas['codepostal']);
            $lead->setEmail($datas['email']);
            $lead->setTelephone($datas['telephone']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lead);
            $entityManager->flush();

            return $this->redirectToRoute('front');
        }

    }

}
