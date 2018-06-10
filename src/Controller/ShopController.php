<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 15.03.2018
 * Time: 21:57
 */

namespace App\Controller;


use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    /**
     * @return Response
     */
    public function flowers($id)
    {
        $em = $this->getDoctrine()->getManager();
        $flowers = $em->getRepository('App:Flowers')->findBy(['type' => $id]);
        return $this->render('shop/flowers.html.twig', array(
            'flowers' => $flowers
        ));
    }

    public function order($id, Request $request)
    {
        $order = new Order();

        $form = $this->createFormBuilder($order)
            ->add('clientName', TextType::class, ['label' => 'Имя'])
            ->add('clientPhone', TextType::class, ['label' => 'Телефон'])
            ->add('quantity', NumberType::class, ['label' => 'Количество'])
            ->add('comment', TextType::class, ['label' => 'Комментарий'])
            ->add('save', SubmitType::class, array('label' => 'Оставить заявку'))
            ->getForm();

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $flower = $em->getRepository('App:Flowers')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Order $order */
            $order = $form->getData();
            $order->setPrice(100);
            $order->setFlower($flower);
            $order->setDateCreated(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute('main');
        }

        return $this->render('shop/order.html.twig', ['form' => $form->createView(), 'img' => $flower->getImg()]);
    }

    public function main()
    {
        $em = $this->getDoctrine()->getManager();
        $flowerType = $em->getRepository('App:FlowerType')->findFlowers();
        return $this->render('shop/main.html.twig', array(
            'type' => $flowerType
        ));
    }

    /**
     * @return Response
     */
    public function toys()
    {
        $em = $this->getDoctrine()->getManager();
        $flowers = $em->getRepository('App:Flowers')->findBy(['type' => 9]);
        return $this->render('shop/toys.html.twig', array(
            'flowers' => $flowers
        ));
    }

    public function contacts()
    {
        $em = $this->getDoctrine()->getManager();
        $flowerType = $em->getRepository('App:FlowerType')->findAll();
        return $this->render('shop/contacts.twig', array(
            'blog_entries' => $flowerType
        ));
    }
}