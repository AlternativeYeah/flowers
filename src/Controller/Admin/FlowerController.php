<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 17.04.2018
 * Time: 23:13
 */

namespace App\Controller\Admin;


use App\Entity\Flowers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class FlowerController extends Controller
{
    public function main()
    {
        return $this->render('admin/orders.html.twig', array(
                'orders' => [
                    [
                        'id' => '1',
                        'clientName' => 'Букет',
                        'clientPhone' => '100р',
                        'price' => 1,
                        'type' => 1
                    ],
                    [
                        'id' => '12',
                        'clientName' => 'Букет',
                        'clientPhone' => '100р',
                        'price' => 1,
                        'type' => 1
                    ]
                ]
            )
        );
    }

    public function flowers()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('App:Flowers')->findAll();
        return $this->render('admin/flowers/flowers.html.twig', array('flowers' => $orders));
    }

    public function flower(Request $request)
    {
        $flowers = new Flowers();

        /** @var Form $form */
        $form = $this->createFormBuilder($flowers)
            ->setMethod('POST')
            ->add('name', TextType::class, ['label' => 'Имя'])
            ->add('description', TextType::class, ['label' => 'Телефон'])
            ->add('price', MoneyType::class, ['label' => 'Цена'])
            /*->add('type', EntityType::class, [
                'class' => FlowerType::class,
                'choice_label' => 'name',
                'label' => 'Группа'
            ])*/
            ->add('save', SubmitType::class, array('label' => 'Оставить заявку'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $flowers = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flowers);
            $entityManager->flush();
            return $this->redirectToRoute('admin.flowers');
        }

        return $this->render('admin/flowers/create.html.twig', ['form' => $form->createView()]);
    }
}