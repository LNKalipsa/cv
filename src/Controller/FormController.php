<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\Experience;
use App\Entity\Formation;
use App\Entity\Leisure;
use App\Form\CompetenceType;
use App\Form\ExperienceType;
use App\Form\FormationType;
use App\Form\LeisureType;
use App\Repository\CompetenceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FormationRepository;
use App\Repository\LeisureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(CompetenceRepository $competenceRepository, ExperienceRepository $experienceRepository, LeisureRepository $leisureRepository, FormationRepository $formationRepository, Request $request): Response
    {
        $competence = new Competence();
        $experience = new Experience();
        $formation = new Formation();
        $leisure = new Leisure();

        $em = $this->getDoctrine()->getManager();

        $competenceForm = $this->createForm(CompetenceType::class, $competence);
        $experienceForm = $this->createForm(ExperienceType::class, $experience);
        $formationForm = $this->createForm(FormationType::class, $formation);
        $leisureForm = $this->createForm(LeisureType::class, $leisure);

        if($request->isMethod('POST')) {
            if($competenceForm->handleRequest($request)->isSubmitted() && $competenceForm->isValid()) {
                $competence = $competenceForm->getData();
                $em->persist($competence);
                $em->flush();
            }else{
                $this->addFlash('error', "Erreur sur l'ajout de la compétence");
            }

            if($experienceForm->handleRequest($request)->isSubmitted() && $experienceForm->isValid()) {
                $experience = $experienceForm->getData();

                //$experience = $request->request->get("experience");
                //$competences = $experience["competences"];   
                
                $competences = $experience->getCompetences();
                
                foreach($competences as $competence) {
                    $competence->addExperience($experience);
                    $em->persist($competence);
                }

                $em->persist($experience);
                $em->flush();

            }else{
                $this->addFlash('error', "Erreur sur l'ajout de l'expérience'");
            }

            if($formationForm->handleRequest($request)->isSubmitted() && $formationForm->isValid()) {
                $formation = $formationForm->getData();

                $competences = $formation->getCompetences();
                
                foreach($competences as $competence) {
                    $competence->addFormation($formation);
                    $em->persist($competence);
                }

                $em->persist($formation);
                $em->flush();
            }else{
                $this->addFlash('error', "Erreur sur l'ajout de la formation");
            }

            if($leisureForm->handleRequest($request)->isSubmitted() && $leisureForm->isValid()) {
                $leisure = $leisureForm->getData();
                $em->persist($leisure);
                $em->flush();
            }else{
                $this->addFlash('error', "Erreur sur l'ajout du loisir");
            }
        }

        return $this->render('form/index.html.twig', [
            'competence_form' => $competenceForm->createView(),
            'experience_form' => $experienceForm->createView(),
            'formation_form' => $formationForm->createView(),
            'leisure_form' => $leisureForm->createView(),

            'competences' => $competenceRepository->findAll(),
            'experiences' => $experienceRepository->findAll(),
            'leisures' => $leisureRepository->findAll(),
            'formations' => $formationRepository->findAll(),
        ]);
    }
}
