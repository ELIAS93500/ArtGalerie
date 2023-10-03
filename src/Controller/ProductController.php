<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    // Action pour créer un nouveau produit
    #[Route('/product/created', name: 'product_created')]
    public function created(Request $request, EntityManagerInterface $manager): Response
    {
        // Création d'une nouvelle instance de l'entité Product
        $product = new Product();
        
        // Création du formulaire en utilisant ProductType avec l'option 'create'
        $form = $this->createForm(ProductType::class, $product, ['create' => true]);
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Persistance du produit dans la base de données
            $manager->persist($product);
            $manager->flush();

            // Ajout d'un message flash pour indiquer le succès
            $this->addFlash('success', 'Produit créé avec succès');
            
            // Redirection vers la page de détails du produit nouvellement créé
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        // Rendu du formulaire de création
        return $this->render('product/product_created.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Action pour éditer un produit existant
    #[Route('/product/edit/{id}', name: 'product_edit')]
    public function edit(Request $request, Product $product, EntityManagerInterface $manager): Response
    {
        // Création du formulaire en utilisant ProductType avec l'option 'update'
        $form = $this->createForm(ProductType::class, $product, ['update' => true]);
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Mise à jour du produit dans la base de données
            $manager->flush();

            // Ajout d'un message flash pour indiquer le succès
            $this->addFlash('success', 'Produit mis à jour avec succès');

            // Redirection vers la page de détails du produit mis à jour
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        // Rendu du formulaire d'édition
        return $this->render('product/product_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Action pour supprimer un produit
    #[Route('/product/delete/{id}', name: 'product_delete')]
    public function delete(Product $product, EntityManagerInterface $manager): Response
    {
        // Suppression du produit de la base de données
        $manager->remove($product);
        $manager->flush();

        // Ajout d'un message  pour indiquer le succès de la suppression
        $this->addFlash('success', 'Produit supprimé avec succès');

        // Redirection vers la page de création 
        return $this->redirectToRoute('product_created.html.twig');
    }


    // Action pour afficher les détails d'un produit
    #[Route('/product/show/{id}', name: 'product_show')]
    public function show(Product $product): Response
    {
        // Rendu de la vue des détails du produit
        return $this->render('product/product_show.html.twig', [
            'product' => $product,
        ]);
    }
}
