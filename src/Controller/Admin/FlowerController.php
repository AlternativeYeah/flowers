<?php
/**
 * Created by IntelliJ IDEA.
 * User: igorvolkov
 * Date: 17.04.2018
 * Time: 23:13
 */

namespace App\Controller\Admin;


use App\Entity\Flowers;
use App\Entity\FlowerType;
use App\Service\FileUploader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class FlowerController extends Controller
{
    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('App:Flowers')->findAll();
        return $this->render('admin/flower/list.html.twig', array('flowers' => $orders));
    }

    public function create(Request $request, FileUploader $fileUploader)
    {
        $flowers = new Flowers();

        $form = $this->createFormBuilder($flowers)
            ->add('name', TextType::class, ['label' => 'Названия'])
            ->add('description', TextType::class, ['label' => 'Описание'])
            ->add('price', MoneyType::class, ['label' => 'Цена'])
            ->add('type', EntityType::class, [
                'class' => FlowerType::class,
                'choice_label' => 'name',
                'label' => 'Группа'
            ])
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
            return $this->redirectToRoute('admin.flowers');
        }

        return $this->render('admin/flower/create.html.twig', ['form' => $form->createView()]);
    }

    public function edit(Request $request, Flowers $flowers, FileUploader $fileUploader)
    {
        $form = $this->createFormBuilder($flowers)
            ->add('name', TextType::class, ['label' => 'Названия'])
            ->add('description', TextType::class, ['label' => 'Описание'])
            ->add('price', MoneyType::class, ['label' => 'Цена'])
            ->add('type', EntityType::class, [
                'class' => FlowerType::class,
                'choice_label' => 'name',
                'label' => 'Группа'
            ])
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
            return $this->redirectToRoute('admin.flowers');
        }

        return $this->render('admin/flower/edit.html.twig',
            ['form' => $form->createView(), 'img' => $flowers->getImg()]);
    }

    public function delete(Request $request, Flowers $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('admin.flowers');

    }
}