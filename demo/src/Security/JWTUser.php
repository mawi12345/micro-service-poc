<?php
namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Lcobucci\JWT\Token;

class JWTUser implements UserInterface
{

    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function getId() {
        return $this->token->getClaim('uid');
    }

    public function getRoles() {
        return ['ROLE_USER'];
    }

    public function getPassword() {
        return '';
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->token->getClaim('username');
    }

    public function getClaims() {
        return $this->token->getClaims();
    }

    public function eraseCredentials() {}
}
