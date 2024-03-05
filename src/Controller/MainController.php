<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\ValidationUserValues;
use App\Repository\ResponsesRepository;
use App\Repository\BabyQuestionsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ParentsQuestionsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function home(BabyQuestionsRepository $babyQuestionsRepository, ParentsQuestionsRepository $parentsQuestionsRepository): Response
    {
        $babyQuestions = $babyQuestionsRepository->findAllBabyQuestions();
        $parentsQuestions = $parentsQuestionsRepository->findAllParentsQuestions();

        return $this->render('main/index.html.twig', [
            'babyQuestions' => $babyQuestions,
            'parentsQuestions' => $parentsQuestions,
        ]);
    }

    #[Route('/quiz', name: 'app_quiz', methods: ['POST'])]
    public function quiz(Request $request, BabyQuestionsRepository $babyQuestionsRepository, ParentsQuestionsRepository $parentsQuestionsRepository, UserRepository $userRepository, ResponsesRepository $responsesRepository, ValidationUserValues $validator): Response
    {
        // get all data from the request
        $data = $request->request->all();

        if (!$validator->isKeyExist($data, [
            'firstName',
            'birthDate',
            'birthTime',
            'gender',
            'weigth',
            'height',
            'hairColor',
            'parentQuestion-1',
            'parentQuestion-2',
            'parentQuestion-3',
            'parentQuestion-4',
            'parentQuestion-5',
            'parentQuestion-6',
            'userLastName',
            'userFirstName'
        ])) {

            return $this->json(['message' => 'Une ou plusieurs information(s) manquante(s)'], Response::HTTP_BAD_REQUEST);
        }

        // regroup the answers
        $answers = [
            'babyAnswers' => [
                $data['firstName'],
                $data['birthDate'],
                $data['birthTime'],
                $data['gender'],
                $data['weigth'],
                $data['height'],
                $data['hairColor']
            ],
            'parentsAnswers' => [
                $data['parentQuestion-1'],
                $data['parentQuestion-2'],
                $data['parentQuestion-3'],
                $data['parentQuestion-4'],
                $data['parentQuestion-5'],
                $data['parentQuestion-6']
            ]
        ];

        // get user data
        $userData = [
            'lastName' => $data['userLastName'],
            'firstName' => $data['userFirstName'],
            'email' => $data['userEmail'],
            'createdAt' => new \DateTimeImmutable()
        ];

        // add user to the database
        $userRepository->saveUser($userData);

        // retrieve the user from the database
        $user = $userRepository->findUserByData($userData);

        if ($answers['babyAnswers']) {
            foreach ($answers['babyAnswers'] as $key => $answer) {
                // retrieve the baby questions from the database
                $babyQuestion = $babyQuestionsRepository->find($key + 1);
                // save the response to the database
                $responsesRepository->saveBabyResponse($answer, $user, $babyQuestion);
            }
        }
        if ($answers['parentsAnswers']) {
            foreach ($answers['parentsAnswers'] as $key => $answer) {
                // retrieve the parents questions from the database
                $parentsQuestion = $parentsQuestionsRepository->find($key + 1);
                // save the response to the database
                $responsesRepository->saveParentResponse($answer, $user, $parentsQuestion);
            }
        }

        return $this->redirectToRoute('app_main');
    }
}
