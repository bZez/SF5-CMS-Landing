<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\LeadRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/lead")
 */
class LeadController extends AbstractController
{
    /**
     * @Route("/", name="lead_index")
     */
    public function admin(LeadRepository $repository)
    {
        return $this->render('admin/lead/index.html.twig', [
            'leads' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/export", name="export_lead")
     */
    public function export(LeadRepository $repository)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="LEADS.csv"');
        $fp = fopen('php://output', 'wb');
        $user_CSV[0] = ['LOGEMENT','CHAUFFAGE','EMAIL', 'NOM', 'PRENOM','TELEPHONE','ADRESSE','VILLE','CODE_POSTAL','DATE_ENREGISTREMENT'];
        fputcsv($fp, $user_CSV[0], ';');
        $i=1;
        foreach ($repository->findAll() as $lead) {
            $user_CSV[$i] = [$lead->getLogement(),$lead->getChauffage(),$lead->getEmail(),$lead->getNom(),$lead->getPrenom(),$lead->getTelephone(),$lead->getAdresse(),$lead->getVille(),$lead->getCodePostal(),$lead->getRegisterAt()->format('d/m/Y')];
            fputcsv($fp, $user_CSV[$i], ';');
            $i++;
        }
        fclose($fp);
        die;
    }
}
