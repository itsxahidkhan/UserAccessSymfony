<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Repository\UserRepository;
    class DashboardController extends AbstractController
    {
        private $userRepository;

        public function __construct(UserRepository $userRepository)
        {   
            $this->userRepository = $userRepository;
        }
    
        #[Route('/superadmin/dashboard', name: 'superadmin_dashboard')]
        public function superadminDashboard(): Response
        {
            $users = $this->userRepository->findAll();
            $this->denyAccessUnlessGranted('ROLE_USER');
            return $this->render('dashboard/superadmin.html.twig',['users' => $users]);
        }

        #[Route('/admin/dashboard', name: 'admin_dashboard')]
        public function adminDashboard(): Response
        {
            $users = $this->userRepository->findAll();
            $this->denyAccessUnlessGranted('ROLE_USER');
            return $this->render('dashboard/admin.html.twig',['users' => $users]);
        }

        #[Route('/user/dashboard', name: 'user_dashboard')]
        public function userDashboard(): Response
        {
            $users = $this->userRepository->findAll();
            $this->denyAccessUnlessGranted('ROLE_USER');
            return $this->render('dashboard/user.html.twig',['users' => $users]);
        }
    }
?>