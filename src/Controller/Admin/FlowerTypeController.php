<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 21.04.2018
 * Time: 0:12
 */

namespace App\Controller\Admin;


use App\Entity\FlowerType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class FlowerTypeController extends Controller
{
    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('App:FlowerType')->findAll();
        return $this->render('admin/flower_type/list.html.twig', array('flowersType' => $orders));
    }

    public function create(Request $request, FileUploader $fileUploader)
    {
        $flowers = new FlowerType();

        $form = $this->createFormBuilder($flowers)
            ->add('name', TextType::class, ['label' => 'Названия'])
            ->add('description', TextType::class, ['label' => 'Описание'])
            ->add('img', FileType::class, ['label' => 'Изображение'])
            ->add('save', SubmitType::class, array('label' => 'Сохранить'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $flowers = $form->getData();

            $file = $flowers->getImg();
            $fileName = $fileUploader->upload($file);
            $flowers->setImg($fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flowers);
            $entityManager->flush();
            return $this->redirectToRoute('admin.flowers_type');
        }

        return $this->render('admin/flower_type/create.html.twig', ['form' => $form->createView()]);
    }

    public function edit(Request $request, FlowerType $flowers)
    {
        $form = $this->createFormBuilder($flowers)
            ->add('name', TextType::class, ['label' => 'Названия'])
            ->add('description', TextType::class, ['label' => 'Описание'])
            ->add('save', SubmitType::class, array('label' => 'Сохранить'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $flowers = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flowers);
            $entityManager->flush();
            return $this->redirectToRoute('admin.flowers');
        }

        return $this->render('admin/flower_type/edit.html.twig', ['form' => $form->createView()]);
    }
}