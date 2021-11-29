<?php

namespace App\Controller;

use App\Entity\Competence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetenceController extends AbstractController
{
    /**
     * @Route("/competence/delete/{id}", name="delete_competence")
     */
    public function deleteCompetence(Competence $competence): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($competence);
        $em->flush();

        return $this->redirectToRoute("form");
    }
}
