<?php 

    namespace App\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Response;
    class ErrorController extends AbstractController
    {
        #[Route('/error', name: 'error_page')]
        public function error(): Response
        {
            return $this->render('_error/error.html.twig');
        }
    }
?>