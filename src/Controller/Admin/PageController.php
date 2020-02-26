<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/page")
 */
class PageController extends AbstractController
{
    /**
     * @Route("/", name="page_index", methods={"GET"})
     */
    public function index(PageRepository $pageRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        return $this->render('administration/page/index.html.twig', [
            'pages' => $pageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="page_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        $page = new Page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $logoFile */
            $logoFile = $form->get('logo')->getData();
            /** @var UploadedFile $iconFile */
            $iconFile = $form->get('favicon')->getData();
            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logoFile->guessExtension();
                try {
                    $logoFile->move(
                        $this->getParameter('logo_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $page->setLogo($newFilename);
            }
            if ($iconFile) {
                $originalFilename = pathinfo($iconFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$iconFile->guessExtension();
                try {
                    $iconFile->move(
                        $this->getParameter('favicon_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $page->setFavicon($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('page_index');
        }

        return $this->render('administration/page/new.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="page_show", methods={"GET"})
     */
    public function show(Page $page): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        return $this->render('administration/page/show.html.twig', [
            'page' => $page,
        ]);
    }

    /**
     * @Route("/{id}/duplicate", name="page_duplicate", methods={"GET","POST"})
     */
    public function duplicate(Page $page): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        $pagenew = new Page();
        $em = $this->getDoctrine()->getManager();

        $pagenew->setContent($page->getContent());
        $pagenew->setNom($page->getNom().'-copie');
        $pagenew->setTitle($page->getTitle());
        $pagenew->setIsFollowed($page->getIsFollowed());
        $pagenew->setIsIndexed($page->getIsIndexed());
        $pagenew->setBase($page->getBase());

        $em->persist($pagenew);
        $em->flush();

        return $this->redirectToRoute('page_index');
    }

    /**
     * @Route("/{id}/edit", name="page_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Page $page): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRAFIC');
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $logoFile */
            $logoFile = $form->get('logo')->getData();
            /** @var UploadedFile $iconFile */
            $iconFile = $form->get('favicon')->getData();
            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logoFile->guessExtension();
                try {
                    $logoFile->move(
                        $this->getParameter('logo_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $page->setLogo($newFilename);
            }
            if ($iconFile) {
                $originalFilename = pathinfo($iconFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$iconFile->guessExtension();
                try {
                    $iconFile->move(
                        $this->getParameter('favicon_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $page->setFavicon($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('page_index');
        }

        return $this->render('administration/page/edit.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="page_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Page $page): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($page);
            $entityManager->flush();
        }

        return $this->redirectToRoute('page_index');
    }
}
