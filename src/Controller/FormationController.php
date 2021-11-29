<?php

namespace App\Controller;

use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation/delete/{id}", name="delete_formation")
     */
    public function deleteFormation(Formation $formation): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($formation);
        $em->flush();

        return $this->redirectToRoute("form");
    }
}
