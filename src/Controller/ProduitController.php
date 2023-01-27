<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Service\GestionImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit')]
class ProduitController extends AbstractController
{

    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository, GestionImage $gestionImage): Response
    {
        //on instancie la class (Entity) Produit: $produit est donc une variable de type objet
        $produit = new Produit();

        // La methode createForm: Crée et renvoie une instance de formulaire à partir du type du formulaire (ici ProduitType)
        //Cette methode (createForm) prend trois parametres :(string $type, $data = null, array $options = []) dont le premier parametre est un parametres obligatoire de type string qui definit la classType qui creera un formulaire.
        //le deuxieme parametre est optionnel et est de type mixed (accpte tout type de caracteres) dans notre cas la valeur du deuxieme parametre est un objet de l'entity Produit et enfin le troisieme parametre lui est optionnel egalement et est de type array, mais le troisieme parametre n'est pas utilisé dans notre cas
        // @param string $type
        // @param mixed $data
        // @param array $options
        // @return \Symfony\Component\Form\FormInterface

        //on declare une variable de type objet 'FormInterface'
        $form = $this->createForm(ProduitType::class, $produit);

        //Inspecte la requête donnée et appelle {@link submit()} si le formulaire a été soumis.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gestionImage->manageImage($produit, $form);        

            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
        'produit' => $produit,
        'form' => $form,

        ]);

    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository, GestionImage $gestionImage): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gestionImage->manageImage($produit, $form); 
            
            $produitRepository->save($produit, true);
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
        'produit' => $produit,
        'form' => $form,
        ]);

    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
