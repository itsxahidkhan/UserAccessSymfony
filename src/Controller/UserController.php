<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AppUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    #[Route(path: '/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user,EntityManagerInterface $em): Response
    {
    
        $form = $this->createForm(AppUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->sendEmail('edit', $user);
            $this->addFlash('success', 'User details updated successfully.');
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('admin_dashboard');
            } else {
                return $this->redirectToRoute('superadmin_dashboard');
            }
        }

        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route(path: '/{id}', name: 'delete', methods: ['GET'])]
    public function delete(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();
        $this->sendEmail('delete', $user);
        $this->addFlash('success', 'User details deleted successfully.');
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_dashboard');
        } else {
            return $this->redirectToRoute('superadmin_dashboard');
        }
    }

    private function sendEmail(string $action, User $user)
    {
        $email = (new Email())
            ->from('khanworldzahid@gmail.com')
            ->to($user->getEmail())
            ->subject("User {$action} Notification")
            ->text("User {$user->getEmail()} was {$action}ed.");

        try {
            $this->mailer->send($email);// Success message
        } catch (TransportExceptionInterface $e) {
            // Print the error message
            echo "Failed to send email: " . $e->getMessage();
        } catch (\Exception $e) {
            // Catch any other exceptions
            echo "An error occurred: " . $e->getMessage();
        }
    }
}

?>