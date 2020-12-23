<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ArticleRepository;
use App\Repository\ContactRepository;
use App\Repository\HomepageRepository;
use App\Repository\UserRepository;
use App\Repository\OfferRepository;
use App\Form\HomepageType;
use App\Form\UserAdminType;
use App\Entity\User;
use App\Entity\Offer;
use App\Entity\Homepage;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/offre", name="offer_index", methods={"GET"})
     */
    public function indexOffre(OfferRepository $offerRepository): Response
    {
        return $this->render('offer/index.html.twig', [
            'offers' => $offerRepository->findAll(),
        ]);
    }

    /**
    * @Route("/article", name="article_index")
    */
    public function indexArticle(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
    * @Route("/contact", name="contact_index")
    */
    public function indexContact(ContactRepository $contactRepository): Response
    {
    	return $this->render('contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }

        /**
     * @Route("/", name="homepage_index", methods={"GET"})
     */
    public function indexHomepage(HomepageRepository $homepageRepository): Response
    {
        return $this->render('homepage/index.html.twig', [
            'homepages' => $homepageRepository->findAll(),
        ]);
    }

        /**
     * @Route("/users", name="user_index", methods={"GET"})
     */
    public function indexUser(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/users/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function editUser(Request $request, User $user): Response
    {
        $form = $this->createForm(UserAdminType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/new", name="homepage_new", methods={"GET","POST"})
     */
    public function newHomepage(Request $request): Response
    {
        $homepage = new Homepage();
        $form = $this->createForm(HomepageType::class, $homepage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($homepage);
            $entityManager->flush();

            return $this->redirectToRoute('homepage_index');
        }

        return $this->render('homepage/new.html.twig', [
            'homepage' => $homepage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="homepage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Homepage $homepage): Response
    {
        $form = $this->createForm(HomepageType::class, $homepage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage_index');
        }

        return $this->render('homepage/edit.html.twig', [
            'homepage' => $homepage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="homepage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Homepage $homepage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$homepage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($homepage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('homepage_index');
    }
}