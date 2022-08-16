<?php

namespace App\Controller;

use App\Entity\Formule;
use App\Form\FormuleType;
use App\Service\FileUploader;
<<<<<<< HEAD
=======
use App\Controller\FormuleController;
>>>>>>> 6bf105444e97377c058d69954eb4bca13af3cb4d
use App\Repository\FormuleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/formule')]
class FormuleController extends AbstractController
{
    #[Route('/', name: 'app_formule_index', methods: ['GET'])]
    public function index(FormuleRepository $formuleRepository): Response
    {
        return $this->render('formule/index.html.twig', [
            'formules' => $formuleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formule_new', methods: ['GET', 'POST'])]
<<<<<<< HEAD
    public function new(Request $request, FileUploader $fileUploader, FormuleRepository $formuleRepository): Response
=======
    public function new(Request $request, FormuleRepository $formuleRepository, FileUploader $fileUploader): Response
>>>>>>> 6bf105444e97377c058d69954eb4bca13af3cb4d
    {
        $formule = new Formule();
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // on récupère le fichier présent dans le formulaire
            $picture = $form->get('photo')->getData();
            // si le champs picture est renseigné (si $picture existe)
            if($picture){
                // on récupère le nom du fichier téléversé en même temps qu'il est placé dans le dossier public/uploads/images/
                $fileName = $fileUploader->upload($picture);
                // on renseigne la propriété picture de l'article avec ce nom de fichier.
                $formule->setPhoto($fileName);
            }
            
            $formuleRepository->add($formule, true);

            return $this->redirectToRoute('app_formule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formule/new.html.twig', [
            'formule' => $formule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formule_show', methods: ['GET'])]
    public function show(Formule $formule): Response
    {
        return $this->render('formule/show.html.twig', [
            'formule' => $formule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FileUploader $fileUploader, Formule $formule, FormuleRepository $formuleRepository): Response
    {
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // on récupère le fichier présent dans le formulaire
            $picture = $form->get('photo')->getData();
            // si le champs picture est renseigné (si $picture existe)
            if($picture){
                // on récupère le nom du fichier téléversé en même temps qu'il est placé dans le dossier public/uploads/images/
                $fileName = $fileUploader->upload($picture);
                // on renseigne la propriété picture de l'article avec ce nom de fichier.
                $formule->setPhoto($fileName);
            }
            $formuleRepository->add($formule, true);

            return $this->redirectToRoute('app_formule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formule/edit.html.twig', [
            'formule' => $formule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formule_delete', methods: ['POST'])]
    public function delete(Request $request, Formule $formule, FormuleRepository $formuleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formule->getId(), $request->request->get('_token'))) {
            $formuleRepository->remove($formule, true);
        }

        return $this->redirectToRoute('app_formule_index', [], Response::HTTP_SEE_OTHER);
    }
}
