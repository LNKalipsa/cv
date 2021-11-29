<?php

namespace App\Controller;

use App\Entity\Experience;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experience/delete/{id}", name="delete_experience")
     */
    public function deleteExperience(Experience $experience): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($experience);
        $em->flush();

        return $this->redirectToRoute("form");
    }
}
