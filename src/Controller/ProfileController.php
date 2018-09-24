<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EditUserForm;
use App\Form\UploadPhotoForm;

//use Symfony\Component\Config\Loader\FileLoader;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('profile/index.html.twig');
    }

    /**
     * @Route("/profile/edit", name="edit_profile")
     */
    public function edit(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        $form = $this->createForm(EditUserForm::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date = new \DateTime('@'.strtotime('now'));
            $user->setUpdated($date);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/edit.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/delete_user", name="delete_user")
     */
    public function delete_user(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if($request->isMethod('POST')) {
            //var_dump($request);
            $user = $this->getUser();

            $user->setDeleted(1);

            $date = new \DateTime('@'.strtotime('now'));
            $user->setUpdated($date);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('security_logout');
        }

        return $this->render('profile/delete.html.twig');
    }

    /**
     * @Route("/upload_photo", name="upload_photo")
     */
    public function upload_photo(Request $request)
    {

    }
}
