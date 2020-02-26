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
        return $this->render('front/page/index.html.twig', [
            'page' => $page,
        ]);
    }
    /**
     * @Route("/legal/cookie-policy", name="legal")
     */
    public function legal()
    {
        return $this->render('front/legal/policy.html.twig');
    }
    /**
     * @Route("/{name}", name="front_page")
     */
    public function pap(PageRepository $repository,$name)
    {
       if( $page = $repository->findOneBy(['nom'=>$name])){
           return $this->render('front/page/index.html.twig', [
               'page' => $page,
           ]);
       }
       return $this->redirectToRoute('front');

    }
    /**
     * @Route("/_/register", name="register",methods={"POST"})
     */
    public function register(Request $request,PageRepository $repository)
    {

        $lead = new Lead();
        if ($request->isMethod('POST')) {
            $datas = $request->request->get('lead');
            $lead->setNom($datas['nom']);
            $lead->setPrenom($datas['prenom']);
            $lead->setAdresse($datas['adresse']);
            $lead->setVille($datas['ville']);
            $lead->setCodePostal($datas['codepostal']);
            $lead->setEmail($datas['email']);
            $lead->setTelephone($datas['telephone']);
            if($page = $repository->find($datas['page'])){
                $lead->setIsFrom($page);
            }
            if (isset($datas['custom']) && $datas['custom'] != '') {

                foreach ($datas['custom'] as $k => $v){
                    $ctn[] = [$k=>$v];
                }
                $lead->setCustomFields($ctn);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lead);
            $entityManager->flush();

            return $this->redirectToRoute('front');
        }

    }

}
