<?php

namespace App\Controller;

use App\Entity\Leisure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeisureController extends AbstractController
{
    /**
     * @Route("/leisure/delete/{id}", name="delete_leisure")
     */
    public function deleteLeisure(Leisure $leisure): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($leisure);
        $em->flush();

        return $this->redirectToRoute("form");
    }
}
