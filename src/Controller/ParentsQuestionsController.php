<?php

namespace App\Controller;

use App\Entity\ParentsQuestions;
use App\Form\ParentsQuestionsType;
use App\Repository\ParentsQuestionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/questions/parents')]
class ParentsQuestionsController extends AbstractController
{
    #[Route('/', name: 'app_parents_questions_index', methods: ['GET'])]
    public function index(ParentsQuestionsRepository $parentsQuestionsRepository): Response
    {
        return $this->render('parents_questions/index.html.twig', [
            'parents_questions' => $parentsQuestionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parents_questions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parentsQuestion = new ParentsQuestions();
        $form = $this->createForm(ParentsQuestionsType::class, $parentsQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parentsQuestion);
            $entityManager->flush();

            return $this->redirectToRoute('app_parents_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parents_questions/new.html.twig', [
            'parents_question' => $parentsQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_questions_show', methods: ['GET'])]
    public function show(ParentsQuestions $parentsQuestion): Response
    {
        return $this->render('parents_questions/show.html.twig', [
            'parents_question' => $parentsQuestion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parents_questions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParentsQuestions $parentsQuestion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParentsQuestionsType::class, $parentsQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parents_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parents_questions/edit.html.twig', [
            'parents_question' => $parentsQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_questions_delete', methods: ['POST'])]
    public function delete(Request $request, ParentsQuestions $parentsQuestion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $parentsQuestion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($parentsQuestion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parents_questions_index', [], Response::HTTP_SEE_OTHER);
    }
}
