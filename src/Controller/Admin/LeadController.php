<?php

namespace App\Controller\Admin;

use App\Repository\LeadRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/lead")
 */
class LeadController extends AbstractController
{
    private $departements;

    public function __construct()
    {
        $this->departements = [
            0 => 'Ain',
            1 => 'Aisne',
            2 => 'Allier',
            3 => 'Alpes-de-Haute-Provence',
            4 => 'Hautes-Alpes',
            5 => 'Alpes-Maritimes',
            6 => 'Ardèche',
            7 => 'Ardennes',
            8 => 'Ariège',
            9 => 'Aube',
            10 => 'Aude',
            11 => 'Aveyron',
            12 => 'Bouches-du-Rhône',
            13 => 'Calvados',
            14 => 'Cantal',
            15 => 'Charente',
            16 => 'Charente-Maritime',
            17 => 'Cher',
            18 => 'Corrèze',
            19 => 'Corse-du-Sud',
            20 => 'Haute-Corse',
            21 => 'Côte-d\'Or',
            22 => 'Côtes d\'Armor',
            23 => 'Creuse',
            24 => 'Dordogne',
            25 => 'Doubs',
            26 => 'Drôme',
            27 => 'Eure',
            28 => 'Eure-et-Loir',
            29 => 'Finistère',
            30 => 'Gard',
            31 => 'Haute-Garonne',
            32 => 'Gers',
            33 => 'Gironde',
            34 => 'Hérault',
            35 => 'Ille-et-Vilaine',
            36 => 'Indre',
            37 => 'Indre-et-Loire',
            38 => 'Isère',
            39 => 'Jura',
            40 => 'Landes',
            41 => 'Loir-et-Cher',
            42 => 'Loire',
            43 => 'Haute-Loire',
            44 => 'Loire-Atlantique',
            45 => 'Loiret',
            46 => 'Lot',
            47 => 'Lot-et-Garonne',
            48 => 'Lozère',
            49 => 'Maine-et-Loire',
            50 => 'Manche',
            51 => 'Marne',
            52 => 'Haute-Marne',
            53 => 'Mayenne',
            54 => 'Meurthe-et-Moselle',
            55 => 'Meuse',
            56 => 'Morbihan',
            57 => 'Moselle',
            58 => 'Nièvre',
            59 => 'Nord',
            60 => 'Oise',
            61 => 'Orne',
            62 => 'Pas-de-Calais',
            63 => 'Puy-de-Dôme',
            64 => 'Pyrénées-Atlantiques',
            65 => 'Hautes-Pyrénées',
            66 => 'Pyrénées-Orientales',
            67 => 'Bas-Rhin',
            68 => 'Haut-Rhin',
            69 => 'Rhône',
            70 => 'Haute-Saône',
            71 => 'Saône-et-Loire',
            72 => 'Sarthe',
            73 => 'Savoie',
            74 => 'Haute-Savoie',
            75 => 'Paris',
            76 => 'Seine-Maritime',
            77 => 'Seine-et-Marne',
            78 => 'Yvelines',
            79 => 'Deux-Sèvres',
            80 => 'Somme',
            81 => 'Tarn',
            82 => 'Tarn-et-Garonne',
            83 => 'Var',
            84 => 'Vaucluse',
            85 => 'Vendée',
            86 => 'Vienne',
            87 => 'Haute-Vienne',
            88 => 'Vosges',
            89 => 'Yonne',
            90 => 'Territoire de Belfort',
            91 => 'Essonne',
            92 => 'Hauts-de-Seine',
            93 => 'Seine-St-Denis',
            94 => 'Val-de-Marne',
            95 => 'Val-D\'Oise',
        ];
    }

    /**
     * @Route("/", name="lead_index")
     */
    public function admin(PageRepository $pageRepository)
    {
        $pages = $pageRepository->findAll();
        return $this->render('administration/lead/index.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("/stats", name="lead_stats")
     */
    public function stats(Request $request, LeadRepository $repository,PageRepository $pageRepository)
    {
        $valid = false;
        $sources = array();
        $deps = array();
        $dateDeb = $request->request->get('dateDebut', "");
        $dateFin = $request->request->get('dateFin', "");
        $page = $request->request->get('page', "");
        $leads = $repository->getByDept($dateDeb, $dateFin, $page);
        $valid = true;
        foreach ($leads as $lead) {
            if (!isset($sources[$lead["sourceId"]])) {
                $sources[$lead["sourceId"]] = array("id" => $lead["sourceId"], "nom" => $lead["sourceNom"], "deps" => array());
            }
            $deps[$lead["DEP"]] = $lead["DEP"];
            $sources[$lead["sourceId"]]["deps"][$lead["DEP"]] = $lead["Nb"];
        }
        return $this->render('administration/lead/stats.html.twig', [
            'valid' => $valid,
            'leads' => $leads,
            'deps' => $deps,
            'departements' => $this->departements,
            'sources' => $sources,
            'pages' => $pageRepository->findAll()
        ]);
    }

    /**
     * @Route("/export", name="lead_export")
     */
    public function export(Request $request, LeadRepository $leadRepository, PageRepository $pageRepository)
    {
        if ($request->isMethod('POST')) {
            $this->denyAccessUnlessGranted('ROLE_LEAD');
            $em = $this->getDoctrine()->getManager();
            $i = 1;
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="LEADS.csv"');
            $fp = fopen('php://output', 'wb');
            $user_CSV[0] = ['PROVENANCE', 'EMAIL', 'NOM', 'PRENOM', 'TELEPHONE', 'ADRESSE', 'VILLE', 'CODE_POSTAL', 'DATE_ENREGISTREMENT'];
            foreach ($leadRepository->findThis($request->get('page', false), $request->get('dateDebut', false), $request->get('dateFin', false), $request->get('dep', false),$request->get('count', false)) as $lead) {
                if ($request->get('new')) {
                    if ($lead->getExported() === true) {
                        continue;
                    }
                    $lead->setExported(1);
                    $em->persist($lead);
                    $em->flush();
                }
                $user_CSV[$i] = [strtoupper($lead->getIsFrom()->getTitle()), $lead->getEmail(), $lead->getNom(), $lead->getPrenom(), $lead->getTelephone(), $lead->getAdresse(), $lead->getVille(), $lead->getCodePostal(), $lead->getRegisterAt()->format('d/m/Y')];
                if ($lead->getCustomFields()) {
                    foreach ($lead->getCustomFields() as $fields) {
                        foreach ($fields as $k => $v) {
                            if(!in_array(strtoupper($k), $user_CSV[0])){
                                array_push($user_CSV[0],strtoupper($k));
                            }
                            array_push($user_CSV[$i],strtoupper($v));
                        }
                    }
                }
                $i++;
            }
            foreach ($user_CSV as $user) {
                fputcsv($fp, $user, ';');
            }
            fclose($fp);
            die;
        }
        return $this->render('administration/lead/export.html.twig', [
            'pages' => $pageRepository->findAll(),
            'deps' => $leadRepository->getDepList(),
        ]);
    }
}

