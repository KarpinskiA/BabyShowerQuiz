<?php

namespace App\Controller;

use App\Entity\BabyQuestions;
use App\Form\BabyQuestionsType;
use App\Repository\BabyQuestionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/questions/baby')]
class BabyQuestionsController extends AbstractController
{
    #[Route('/', name: 'app_baby_questions_index', methods: ['GET'])]
    public function index(BabyQuestionsRepository $babyQuestionsRepository): Response
    {
        return $this->render('baby_questions/index.html.twig', [
            'baby_questions' => $babyQuestionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_baby_questions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $babyQuestion = new BabyQuestions();
        $form = $this->createForm(BabyQuestionsType::class, $babyQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($babyQuestion);
            $entityManager->flush();

            return $this->redirectToRoute('app_baby_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('baby_questions/new.html.twig', [
            'baby_question' => $babyQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_baby_questions_show', methods: ['GET'])]
    public function show(BabyQuestions $babyQuestion): Response
    {
        return $this->render('baby_questions/show.html.twig', [
            'baby_question' => $babyQuestion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_baby_questions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BabyQuestions $babyQuestion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BabyQuestionsType::class, $babyQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_baby_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('baby_questions/edit.html.twig', [
            'baby_question' => $babyQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_baby_questions_delete', methods: ['POST'])]
    public function delete(Request $request, BabyQuestions $babyQuestion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $babyQuestion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($babyQuestion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_baby_questions_index', [], Response::HTTP_SEE_OTHER);
    }
}
