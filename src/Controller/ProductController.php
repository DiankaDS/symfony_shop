<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use App\Entity\Categories;
use App\Entity\Subcategories;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $products = $this->getDoctrine()
            ->getRepository(Products::class)
            ->findAll();

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        $subcategories = [];
        foreach($categories as $c) {
            $subcategories[$c->getId()] = $this->getDoctrine()
                ->getRepository(Subcategories::class)
                ->getSubcategoriesByCategory($c->getId());

        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }
}
