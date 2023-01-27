<?php
namespace App\Controller;

use App\Entity\Blog;
use App\Service\GestionImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BlogRepository;


#[Route('/blog')]
Class BlogController extends AbstractController
{    
    #[Route('/', name: 'app_blog_index', methods: ['GET'])]
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'blog' => $blogRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_blog_new', methods:['GET', 'POST'])]
    public function new(Request $request, BlogRepository $blogRepository, GestionImage $gestionImage):Reponse
    {
        $blog  = new Blog();
        $form = $this->createForm(BlogType::Class, $blog);

        $gorm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gestionImage->managerImage($blog, $form, $blogRepository);

            return $this->redirectToRoute('app_blog_index', [], Reponse::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog/new.html.twig', ['blog' => $blog, 'form' => $from,

    ]);

    } 

        #[Route('/{id', name: 'app_blog_show',methods:['GET'])]
        public function show(Blog $blog): Response
    {
        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }

        #[Route('/{id}/edit',name:'app_blog_edit', methods: ['GET', 'POST'])]
        public function edit(Request $requestn, Blog $blog,BlogRepository $blogRepository, GestionImage $gestionImage): Response
        
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gestionImage->manageImage($blog, $form, $blogRepository); 
            return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog/edit.html.twig', [
        'blog' => $blog,
        'form' => $form,
        ]);

    }

    #[Route('/{id}', name: 'app_blog_delete', methods: ['POST'])]
    public function delete(Request $request, Blog $blog, BlogRepository $blogRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blog->getId(), $request->request->get('_token'))) {
            $blogRepository->remove($blog, true);
        }

        return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
    }

}