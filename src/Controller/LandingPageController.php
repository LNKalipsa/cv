<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\Experience;
use App\Entity\Formation;
use App\Entity\Leisure;
use App\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/landing/page", name="landing_page")
     */
    public function index(): Response
    {   
        $competences = $this->em->getRepository(Competence::class)->findAll();
        $formations = $this->em->getRepository(Formation::class)->findAll();
        $experiences = $this->em->getRepository(Experience::class)->findAll();
        $loisirs = $this->em->getRepository(Leisure::class)->findAll();
        $profils = $this->em->getRepository(Profil::class)->findAll();

        if(count($profils) > 0){
            $profil = $profils[0];
        }else{
            $profil = new Profil();
            $profil ->setFirstname('Prénom')
                    ->setName('Nom')
                    ->setAddress('Adresse')
                    ->setPostcode('01234')
                    ->setCity('Ville')
                    ->setMail('e-mail')
                    ->setPhoneNumber('0123456789')
                    ->setDescription('Votre description ici');
        }

        return $this->render('landing_page/index.html.twig', [
            'competences' => $competences,
            'formations' => $formations,
            'experiences' => $experiences,
            'loisirs' => $loisirs,
            'profil' => $profil
        ]);
    }
}
