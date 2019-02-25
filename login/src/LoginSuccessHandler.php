<?php

namespace App;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker) {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {

        $user = $token->getUser();

        $issuer = getenv('JWT_ISSUER');
        $audience = getenv('JWT_AUDIENCE');
        $expirationDuration = intval(getenv('JWT_EXPIRATION_TIME'));
        $privateKeyFile = getenv('JWT_PRIVATE_KEY_FILE');
        $privateKeyPassword = getenv('JWT_PRIVATE_KEY_PASSWORD');
        $fallbackRedirect = getenv('LOGIN_FALLBACK_REDIRECT');
        $signer = new Sha256();
        $keychain = new Keychain();

        $now = time();
        $expiration = $now + $expirationDuration;

        $token = (new Builder())->setIssuer($issuer) // Configures the issuer (iss claim)
                        ->setAudience($audience) // Configures the audience (aud claim)
                        ->setId($user->getEmail(), true) // Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt($now) // Configures the time that the token was issued (iat claim)
                        ->setNotBefore($now) // Configures the time that the token can be used (nbf claim)
                        ->setExpiration($expiration) // Configures the expiration time of the token (exp claim)
                        ->set('uid', $user->getId()) // Configures a new claim, called "uid"
                        ->set('username', $user->getUsername()) // Configures a new claim, called "uid"
                        ->sign($signer,  $keychain->getPrivateKey('file://'.$privateKeyFile, $privateKeyPassword)) // creates a signature using your private key
                        ->getToken(); // Retrieves the generated token

        $redir = $request->cookies->get('loginRedirect', $fallbackRedirect);
        $response = new RedirectResponse($redir);
        $cookie = new Cookie('SoaAuth', $token, $expiration);
        $response->headers->setCookie($cookie);
        return $response;
    }

}
