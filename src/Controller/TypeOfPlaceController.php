<?php

namespace App\Controller;

use App\Entity\TypeOfPlace;
use App\Form\TypeOfPlaceType;
use App\Repository\TypeOfPlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/of/place')]
class TypeOfPlaceController extends AbstractController
{
    #[Route('/', name: 'app_type_of_place_index', methods: ['GET'])]
    public function index(TypeOfPlaceRepository $typeOfPlaceRepository): Response
    {
        return $this->render('type_of_place/index.html.twig', [
            'type_of_places' => $typeOfPlaceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_of_place_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeOfPlaceRepository $typeOfPlaceRepository): Response
    {
        $typeOfPlace = new TypeOfPlace();
        $form = $this->createForm(TypeOfPlaceType::class, $typeOfPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeOfPlaceRepository->save($typeOfPlace, true);

            return $this->redirectToRoute('app_type_of_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_of_place/new.html.twig', [
            'type_of_place' => $typeOfPlace,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_of_place_show', methods: ['GET'])]
    public function show(TypeOfPlace $typeOfPlace): Response
    {
        return $this->render('type_of_place/show.html.twig', [
            'type_of_place' => $typeOfPlace,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_of_place_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeOfPlace $typeOfPlace, TypeOfPlaceRepository $typeOfPlaceRepository): Response
    {
        $form = $this->createForm(TypeOfPlaceType::class, $typeOfPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeOfPlaceRepository->save($typeOfPlace, true);

            return $this->redirectToRoute('app_type_of_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_of_place/edit.html.twig', [
            'type_of_place' => $typeOfPlace,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_of_place_delete', methods: ['POST'])]
    public function delete(Request $request, TypeOfPlace $typeOfPlace, TypeOfPlaceRepository $typeOfPlaceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeOfPlace->getId(), $request->request->get('_token'))) {
            $typeOfPlaceRepository->remove($typeOfPlace, true);
        }

        return $this->redirectToRoute('app_type_of_place_index', [], Response::HTTP_SEE_OTHER);
    }
}
