<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\Experience;
use App\Entity\Formation;
use App\Entity\Leisure;
use App\Entity\Profil;
use App\Form\CompetenceType;
use App\Form\ExperienceType;
use App\Form\FormationType;
use App\Form\LeisureType;
use App\Form\ProfilType;
use App\Repository\CompetenceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FormationRepository;
use App\Repository\LeisureRepository;
use App\Repository\ProfilRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(CompetenceRepository $competenceRepository, ExperienceRepository $experienceRepository, LeisureRepository $leisureRepository, FormationRepository $formationRepository, ProfilRepository $profilRepository, Request $request): Response
    {
        $competence = new Competence();
        $experience = new Experience();
        $formation = new Formation();
        $leisure = new Leisure();

        $em = $this->getDoctrine()->getManager();
        
        //affichage des données perso si elles sont déjà existantes et n'autoriser que l'édition et pas de nouvelles entrées
        $profils = $em->getRepository(Profil::class)->findAll();
        $profil = count($profils) > 0  ? $profils[0] : new Profil();

        $competenceForm = $this->createForm(CompetenceType::class, $competence);
        $experienceForm = $this->createForm(ExperienceType::class, $experience);
        $formationForm = $this->createForm(FormationType::class, $formation);
        $leisureForm = $this->createForm(LeisureType::class, $leisure);
        $profilForm = $this->createForm(ProfilType::class, $profil);



        if($request->isMethod('POST')) {
            if($competenceForm->handleRequest($request)->isSubmitted() && $competenceForm->isValid()) {
                try {
                    $competence = $competenceForm->getData();
                    $em->persist($competence);
                    $em->flush();

                    $this->addFlash('success', 'La compétence a été ajoutée avec succès !');

                }catch (Exception $exception){
                    $this->addFlash('error', "Erreur sur l'ajout de la compétence");
                }
            }

            if($experienceForm->handleRequest($request)->isSubmitted() && $experienceForm->isValid()) {
                try{
                    $experience = $experienceForm->getData();
                    $competences = $experience->getCompetences();

                    foreach($competences as $competence) {
                        $competence->addExperience($experience);
                        $em->persist($competence);
                    }
                    $em->persist($experience);
                    $em->flush();

                    $this->addFlash('success', "L'expérience professionnelle a été ajoutée avec succès !");


                } catch (Exception $exception) {
                    $this->addFlash('error', "Erreur sur l'ajout de l'expérience'");
                }

            }

            if($formationForm->handleRequest($request)->isSubmitted() && $formationForm->isValid()) {
                try {
                    $formation = $formationForm->getData();
                    $competences = $formation->getCompetences();
                    
                    foreach($competences as $competence) {
                        $competence->addFormation($formation);
                        $em->persist($competence);
                    }
    
                    $em->persist($formation);
                    $em->flush();

                    $this->addFlash('success', "La formation a été ajoutée avec succès !");

                } catch (Exception $exception) {
                    $this->addFlash('error', "Erreur sur l'ajout de la formation");
                }
            }

            if($leisureForm->handleRequest($request)->isSubmitted() && $leisureForm->isValid()) {
                try {
                    $leisure = $leisureForm->getData();
                    $em->persist($leisure);
                    $em->flush();

                    $this->addFlash('success', "Le loisir a été ajouté avec succès !");

                } catch (Exception $exception) {
                    $this->addFlash('error', "Erreur sur l'ajout du loisir");
                }
            }
            
            if($profilForm->handleRequest($request)->isSubmitted() && $profilForm->isValid()) {
                try {
                    $profil = $profilForm->getData();
                    $em->persist($profil);
                    $em->flush();

                    $this->addFlash('success', "Votre profil a bien été mit à jour");

                } catch (Exception $exception) {
                    $this->addFlash('error', "Erreur sur l'ajout du profil");
                }                
            }

        }

        return $this->render('form/index.html.twig', [
            'competence_form' => $competenceForm->createView(),
            'experience_form' => $experienceForm->createView(),
            'formation_form' => $formationForm->createView(),
            'leisure_form' => $leisureForm->createView(),
            'profil_form' => $profilForm->createView(),

            'competences' => $competenceRepository->findAll(),
            'experiences' => $experienceRepository->findAll(),
            'leisures' => $leisureRepository->findAll(),
            'formations' => $formationRepository->findAll(),
            'profils' => $profilRepository->findAll(),
        ]);
    }
}
