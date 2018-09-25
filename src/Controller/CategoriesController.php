<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Entity\Subcategories;

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
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categories/{id}", name="categories_by_id")
     */
    public function showById($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $category = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->find($id);

        $subcategories = $this->getDoctrine()
                ->getRepository(Subcategories::class)
                ->getSubcategoriesByCategory($id);

        return $this->render('categories/show.html.twig', [
            'category' => $category,
            'subcategories' => $subcategories
        ]);
    }
}
