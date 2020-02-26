<?php

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class BackController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/index.html.twig');
    }
}