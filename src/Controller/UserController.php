<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\ModifInfosType;
use App\Form\AdminModifInfosType;

class UserController extends AbstractController
{
    #[Route('/private-profil', name: 'profil')]
    public function profil(Request $request, MailerInterface $mailer): Response
    {
        return $this->render('user/profil.html.twig', [
            
        ]);
    }

    #[Route('/admin-listeusers', name: 'listeusers')]
    public function modifuser(EntityManagerInterface $entityManagerInterface, Request $request, MailerInterface $mailer): Response
    {
        $repoUsers = $entityManagerInterface->getRepository(User::class);
        $users = $repoUsers->findAll();
        return $this->render('admin/listeusers.html.twig', [
           'users' => $users,
        ]);
    }

    #[Route('/private-modifInfos', name: 'modifinfos')]
    public function modifinfos(EntityManagerInterface $entityManagerInterface, Request $request, MailerInterface $mailer): Response
    {
        
        $id = $request->get('id');
        $repoUsers = $entityManagerInterface->getRepository(User::class);
        $user= $repoUsers->find($id);
        $role = $user->getRoles();

        $form = $this->createForm(ModifInfosType::class,$user);

        if($request-> isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted()&&$form->isValid()){

                $entityManagerInterface->persist($user);
                $entityManagerInterface->flush();
                $this->addFlash('notice','Produit modifié !');
            
            return $this->redirectToRoute('profil');
            }
        }
        return $this->render('user/modifInfos.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin-modifInfos', name: 'adminmodifinfos')]
    public function adminmodifinfos(EntityManagerInterface $entityManagerInterface, Request $request, MailerInterface $mailer): Response
    {
        $id = $request->get('id');
        $repoUsers = $entityManagerInterface->getRepository(User::class);
        $user= $repoUsers->find($id);

        $form = $this->createForm(AdminModifInfosType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin de convertir manuellement, Symfony gère la gestion des rôles pour vous
        
            // Enregistrez l'utilisateur
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        
            // Redirigez ou effectuez d'autres actions après la mise à jour
            return $this->redirectToRoute('listeusers');
        }
        return $this->render('admin/modifinfos.html.twig', [
            'form' => $form->createView()
        ]);
    }
 
        
        
    

    #[Route('/admin-suppuser/{id}', name: 'suppuser')]
    public function suppuser(EntityManagerInterface $entityManagerInterface, Request $request, MailerInterface $mailer): Response
    {
        $id = $request->get('id');
        $repoUsers = $entityManagerInterface->getRepository(User::class);
        $user= $repoUsers->find($id);
        $entityManagerInterface->remove($user);
        $entityManagerInterface->flush();


        $this->addFlash('notice','Utilisateur supprimé !');
        return $this->redirectToRoute('listeusers');  
    }

}