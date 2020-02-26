<?php

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration")
 */
class BackController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function admin()
    {
        return $this->render('administration/index.html.twig');
    }
}