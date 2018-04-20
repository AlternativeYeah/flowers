<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 17.04.2018
 * Time: 23:13
 */

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
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

    public function orders()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('App:Order')->findAll();
        return $this->render('admin/orders/orders.html.twig', array('orders' => $orders));
    }

    public function order($id)
    {
        var_dump($id);
        exit;
    }
}