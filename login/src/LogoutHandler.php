<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutHandler implements LogoutHandlerInterface {

    public function logout(Request $request, Response $response, TokenInterface $token) {
        $response->headers->clearCookie('SoaAuth');
        $response->headers->clearCookie('SoaPreAuthSession');
        $response->headers->set('Location', $request->getBasePath().'/');
        return $response;
    }

}
