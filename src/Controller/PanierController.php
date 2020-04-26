<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity){ //on crée un foreach qui va boucler sur notre panier

            $panierWithData[] = [
                'produit' => $produitRepository->find($id), //fonction find qui va nous permettre de trouver un produit grace a son id
                'quantity'=> $quantity
            ]; //un tableau qui contient une liste de couple produit quantité

        }

        $total = 0;
        foreach($panierWithData as $item){
            $totalItem = $item['produit']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('panier/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    /**
     * @Route("panier/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session) {
        
        
        $panier = $session->get('panier', []); //ici nous récupérons un panier qui ne contient aucuns produit
        
        if(!empty($panier[$id])) {
            $panier[$id]++; //on incrémente chaque produits 

        }else{

            $panier[$id] = 1;       //ici nous rajoutons 1 produit au panier
         }

     
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index");


    }
    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */

     public function remove($id, SessionInterface $session){
         $panier = $session->get('panier', []);

         if (!empty($panier[$id])) { // si panier n'est pas vide
             unset($panier[$id]); //j'utilise unset pour virer l'id de mon panier
         }

         $session->set('panier', $panier);

         return $this->redirectToRoute("cart_index");
     }
}
