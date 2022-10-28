<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        
        $category = new Category();
        $category->setName('Koszulki');
        
        $product->setName('koszulka')
            ->setDescription('biała koszulka')
            ->setPrice(299.99)
            ->setActive(true)
            ->setEan('1234567');
            
        $product->setCategory($category);
        
        $entityManager->persist($category);
        $entityManager->persist($product);
        $entityManager->flush();
        
        return new Response('Product saved!');
    }
    
    #[Route('/products', name:'products_list')]
    public function products(EntityManagerInterface $entityManager)
    {
        $products = $entityManager->getRepository(Product::class)->findall();
        
        dump($products);
        die();
    }
    
    #[Route('/product/{id}', name:'product_show')]
    public function show(Product $product)
    {
        dump($product->getCategory()->getName());
        die();
    }
    
    #[Route('/product/edit/{id}', name: 'product_edit')]
    public function update(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setPrice(99.99);
        $entityManager->flush();

        return $this->redirectToRoute(
            'product_show', [
            'id' => $product->getId()
        ]);
    }
    
    #[Route('/product/remove/{id}', name: 'product_remove')]
    public function remove(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute(
            'products_list', [
            'id' => $product->getId()
        ]);
    }
}
