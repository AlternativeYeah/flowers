<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 15.03.2018
 * Time: 21:57
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    /**
     * @return Response
     */
    public function flowers()
    {
        return $this->render('shop/flowers.html.twig', array(
            'blog_entries' => [
                [
                    'title' => 'Букет',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
                [
                    'title' => '1test',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
                [
                    'title' => '1test',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
                [
                    'title' => '1test',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
                [
                    'title' => '1test',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
                [
                    'title' => '1test',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
                [
                    'title' => '1test',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
                [
                    'title' => '1test',
                    'body' => 'Букет',
                    'price' => '100р',
                    'id' => 1
                ],
            ]
        ));
    }

    public function order($id)
    {
        return $this->render(
            'shop/order.html.twig', array(
            'id' => $id
        ));
    }

    public function main()
    {
        return $this->render('main.html.twig', array(
            'type' => [
                'Букеты', 'Корзинки', 'SWIITBOX',
            ]
        ));
    }
}