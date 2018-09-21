<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        return $this->render('categories/index.html.twig', [
            'categories' => $categories
        ]);
    }
}
