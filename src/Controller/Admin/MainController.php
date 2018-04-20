<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 17.04.2018
 * Time: 23:13
 */

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function main()
    {
        return $this->render('admin/starter.html.twig');
    }
}