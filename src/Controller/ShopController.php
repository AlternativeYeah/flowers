<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 15.03.2018
 * Time: 21:57
 */

namespace App\Controller;


use App\Entity\Flowers;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    /**
     * @return Response
     */
    public function flowers($id)
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

    public function createOrder(Request $request){
        $order = new Order();


    }
    public function main()
    {
        return $this->render('shop/main.html.twig', array(
            'type' => [
                'Букеты',
                'Корзинки',
                'SWIITBOX',
            ]
        ));
    }

    public function contacts()
    {
        return $this->render('shop/contacts.html.twig', array(
            'phone'   => '+7 987 569 45 89',
            'email'   => 'shop@flowers.ru',
            'address' => 'г. Москва ул. Мира 43'
        ));
    }
}