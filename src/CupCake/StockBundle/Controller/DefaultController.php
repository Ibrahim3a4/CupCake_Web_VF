<?php

namespace CupCake\StockBundle\Controller;

use CupCake\StockBundle\Entity\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CupCakeStockBundle:Default:index.html.twig');
    }

    function affichageStockAction($idPat)

    {   $em=$this->getDoctrine()->getManager();
        //$patisserie= new Patisserie();
        //$produit=$em->getRepository("ProduitBundle:Produit")->findAll();
        $produit=$em->getRepository("ProduitBundle:Produit")->getProduitByPatisserie1($idPat);
        return $this->render("@CupCakeStock/Default/affichagestock.html.twig",array("produit"=>$produit));

    }

    function ajouterAction(Request $request,$idPat)
    {
        $stock = new Stock();
        $em=$this->getDoctrine()->getManager();
        $libelle=$em->getRepository("CupCakeStockBundle:Stock")->ajouterstockform($idPat);
        if ($request->isMethod('POST'))
        {
//            $idProduit=$em->getRepository("StockBundle:Stock")->recupererID($request->get('LibelleProduit'));
//            $ediTp = $em
//                ->getRepository('ProduitBundle:Produit')->findOneBy($idProduit);

            //$produit = $em->getRepository("ProduitBundle:Produit")->findOneBy(array('idPatisserie' => $request->get('LibelleProduit')));
//            $produit= $em->getRepository("ProduitBundle:Produit")->recupererID($request->get('LibelleProduit'));
            $produit=$em->getRepository("ProduitBundle:Produit")->findOneBy(array("id_produit"=>$request->get("LibelleProduit")));
            $stock->setIdProduit($produit);
            $patisserie=$em->getRepository("PatisserieBundle:Patisserie")->findOneBy(array('id_patisserie'=>$idPat));
            $stock->setIdPatisserie($patisserie);
            $em->persist($stock);
            $em->flush();

        }

        return $this->render("@CupCakeStock/Default/ajoutstockform.html.twig",array("produit"=>$libelle));
    }


    function supprimerProduitStockAction($idProduit)
    {
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository("ProduitBundle:Produit")->findOneBy(array("id_produit"=>$idProduit));//recuperer
        $em->remove($produit);
        $em->flush();
        return $this->render("@CupCakeStock/Default/MessageSupprimer.html.twig",array('idPatisserie'=>$produit->getPatisserie()->getIdPatisserie()));

        //return $this->redirectToRoute("stock_affichageStock");

    }

    function MessagesupprimerAction()
    {
        $em=$this->getDoctrine()->getManager();
        //$produit=$em->getRepository("ProduitBundle:Produit")->findOneBy(array("idProduit"=>$idProduit));//recuperer
        return $this->render('@CupCakeStock/Default/MessageSupprimer.html.twig');
    }

    public function ModifierProduitStockAction(Request $request, $idProduit)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ProduitBundle:Produit')->find($idProduit);
        $patisserie=$em->getRepository('ProduitBundle:Produit')->find($idProduit);
        if ($request->isMethod('POST')) {
            $produit->setLibelleProduit($request->get('libelle'));
            $produit->setCategorie($request->get('categorie'));
            $produit->setPrix($request->get('prix'));
            $produit->setDateExpiration(new \DateTime($request->get('dateExpiration')));
            $produit->setQuantite($request->get('quantite'));
            $produit->setDescription($request->get('description'));
            $produit->getPatisserie($produit->getPatisserie());
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('stock_affichageStock',array('idPat'=>$produit->getPatisserie()->getIdPatisserie()));
        }
        return $this->render('@CupCakeStock/Default/modifierProduitStock.html.twig', array('produit' => $produit));
    }



}


