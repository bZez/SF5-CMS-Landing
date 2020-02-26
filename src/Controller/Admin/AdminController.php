<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Form\AdminType;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/administration/user")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index(AdminRepository $adminRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('administration/admin/index.html.twig', [
            'admins' => $adminRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $admin->setPassword($encoder->encodePassword($admin,$admin->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($admin);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('administration/admin/new.html.twig', [
            'admin' => $admin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_show", methods={"GET"})
     */
    public function show(Admin $admin): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('administration/admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Admin $admin,UserPasswordEncoderInterface $encoder): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $oldpass = $admin->getPassword();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                if($admin->getPassword() == ''){
                    $admin->setPassword($oldpass);
                } else {
                    $admin->setPassword($encoder->encodePassword($admin,$admin->getPassword()));
                }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('administration/admin/edit.html.twig', [
            'admin' => $admin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Admin $admin): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($admin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_index');
    }
}
