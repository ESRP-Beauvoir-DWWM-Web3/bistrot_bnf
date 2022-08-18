<?php

namespace App\Controller;

use App\Entity\Tables;
use App\Form\TablesType;
use App\Repository\TablesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tables')]
class TablesController extends AbstractController
{
    #[Route('/', name: 'app_tables_index', methods: ['GET'])]
    public function index(TablesRepository $tablesRepository): Response
    {
        return $this->render('tables/index.html.twig', [
            'tables' => $tablesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tables_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TablesRepository $tablesRepository): Response
    {
        $table = new Tables();
        $form = $this->createForm(TablesType::class, $table);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tablesRepository->add($table, true);

            return $this->redirectToRoute('app_tables_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tables/new.html.twig', [
            'table' => $table,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tables_show', methods: ['GET'])]
    public function show(Tables $table): Response
    {
        return $this->render('tables/show.html.twig', [
            'table' => $table,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tables_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tables $table, TablesRepository $tablesRepository): Response
    {
        $form = $this->createForm(TablesType::class, $table);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tablesRepository->add($table, true);

            return $this->redirectToRoute('app_tables_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tables/edit.html.twig', [
            'table' => $table,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tables_delete', methods: ['POST'])]
    public function delete(Request $request, Tables $table, TablesRepository $tablesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$table->getId(), $request->request->get('_token'))) {
            $tablesRepository->remove($table, true);
        }

        return $this->redirectToRoute('app_tables_index', [], Response::HTTP_SEE_OTHER);
    }
}
