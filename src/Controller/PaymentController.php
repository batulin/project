<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Exception\UncorrectSoumOfPaymentException;
use App\Form\PaymentType;
use App\Repository\PaymentRepository;
use App\Repository\RentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

#[Route('/payment')]
class PaymentController extends AbstractController
{
    public function __construct(private RentRepository $rents, private PaymentRepository $payments)
    {
    }

    #[Route('/', name: 'app_payment_index', methods: ['GET'])]
    public function index(PaymentRepository $paymentRepository): Response
    {
        return $this->render('payment/index.html.twig', [
            'payments' => $paymentRepository->findAll(),
        ]);
    }

    #[Route('/add/{rent_id}', name: 'add_payment', methods: ['GET', 'POST'])]
    public function new(Request $request, int $rent_id): Response
    {
        $rent = $this->rents->find($rent_id);
        $paymentsSoum = 0;
        // получить все платежи заказа
        $rentPayments = $this->payments->getRentPayments($rent_id);
        foreach ($rentPayments as $rentPayment) {
            $paymentsSoum += $rentPayment->getSoum();
        }

        // получаем цену всего заказа
        $days = $rent->getBeginDate()->diff($rent->getEndDate())->days + 1;
        $rentPrice = $days * $rent->getDayPrice();
        // получаем недоплаченную сумму
        $diff = $rentPrice - $paymentsSoum;

        $payment = (new Payment())
            ->setDate(new DateTimeImmutable())
            ->setRent($rent)
            ->setSoum($diff);
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($payment->getSoum() === 0) {
                throw new UncorrectSoumOfPaymentException();
            }
            if($diff < $payment->getSoum()) {
                throw new UncorrectSoumOfPaymentException();
            }

            $this->payments->save($payment, true);

            return $this->redirectToRoute('app_payment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('payment/new.html.twig', [
            'payment' => $payment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_payment_show', methods: ['GET'])]
    public function show(Payment $payment): Response
    {
        return $this->render('payment/show.html.twig', [
            'payment' => $payment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_payment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Payment $payment, PaymentRepository $paymentRepository): Response
    {
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paymentRepository->save($payment, true);

            return $this->redirectToRoute('app_payment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('payment/edit.html.twig', [
            'payment' => $payment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_payment_delete', methods: ['POST'])]
    public function delete(Request $request, Payment $payment, PaymentRepository $paymentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payment->getId(), $request->request->get('_token'))) {
            $paymentRepository->remove($payment, true);
        }

        return $this->redirectToRoute('app_payment_index', [], Response::HTTP_SEE_OTHER);
    }
}
