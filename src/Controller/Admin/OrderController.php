<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 17.04.2018
 * Time: 23:13
 */

namespace App\Controller\Admin;


use App\Entity\Flowers;
use App\Entity\Order;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OrderController extends Controller
{
    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('App:Order')->findAll();
        return $this->render('admin/order/list.html.twig', array('orders' => $orders));
    }

    public function create(Request $request)
    {
        $orders = new Order();

        $form = $this->createFormBuilder($orders)
            ->add('clientName', TextType::class, ['label' => 'Имя клиента'])
            ->add('clientPhone', TextType::class, ['label' => 'Телефон клиента'])
            ->add('flower', EntityType::class, [
                'class' => Flowers::class,
                'choice_label' => 'name',
                'label' => 'Цветок'
            ])
            ->add('price', MoneyType::class, ['label' => 'Цена'])
            ->add('save', SubmitType::class, array('label' => 'Сохранить'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $orders = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orders);
            $entityManager->flush();
            return $this->redirectToRoute('admin.orders');
        }

        return $this->render('admin/order/create.html.twig', ['form' => $form->createView()]);
    }

    public function edit($id, Request $request, Order $order)
    {
        $form = $this->createFormBuilder($order)
            ->add('clientName', TextType::class, ['label' => 'Имя клиента'])
            ->add('clientPhone', TextType::class, ['label' => 'Телефон клиента'])
            ->add('flower', EntityType::class, [
                'class' => Flowers::class,
                'choice_label' => 'name',
                'label' => 'Цветок'
            ])
            ->add('price', MoneyType::class, ['label' => 'Цена'])
            ->add('status', ChoiceType::class, ['label' => 'Статус заказа', 'choices' => [
                'Новый' => Order::STATUS_NEW,
                'Взят в работу' => Order::STATUS_WORK,
                'Выополнен' => Order::STATUS_DONE,
                'Отмена' => Order::STATUS_CANCEL,
            ]])
            ->add('save', SubmitType::class, array('label' => 'Сохранить'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute('admin.orders');
        }

        return $this->render('admin/order/create.html.twig', ['form' => $form->createView()]);
    }
}