<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;
use App\Service\FileManager;

class RegistrationController extends AbstractController
{
    private FileManager $filemanager;
    public function __construct(FileManager $filemanager) {
        $this->filemanager = $filemanager;
    }
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setUuid(Uuid::v4()->toBase58()); // Generate a new UUID
            $file = $form->get('profile_picture')->getData();

            if ($file) {
                $dir = 'profile_pictures';
                $this->filemanager->setSubDirectory($dir); // Uploaded to default upload_dir/$dir
                $fileName = $this->filemanager->upload($file,'profile_pictures');
                $user->setProfilePicture($fileName);
            }

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('home_page');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
        
    }
    
    // ...
}
