<?php

    namespace App\Security;
    use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\Routing\RouterInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        $user = $token->getUser();
        $roles = $user->getRoles();
        if (in_array('ROLE_SUPERADMIN', $roles)) {
            return new RedirectResponse($this->router->generate('superadmin_dashboard'));
        } elseif (in_array('ROLE_ADMIN', $roles)) {
            return new RedirectResponse($this->router->generate('admin_dashboard'));
        } else {
            return new RedirectResponse($this->router->generate('user_dashboard'));
        }
    }
}

?>