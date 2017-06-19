<?php 
// src/AppBundle/Security/User/WebserviceUserProvider.php
namespace AppBundle\Security\User;

use AppBundle\Security\User\WebserviceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Doctrine\ORM\EntityManager;

class WebserviceUserProvider implements UserProviderInterface
{

    private $repository;

    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUserForApiKey($apiKey)
    {
        $user = $this->repository->findOneByApiKey($apiKey);
        if ($user == null) {
            throw new AccessDeniedException();
        }
        return $user;
    }

    public function loadUserByUsername($username)
    {
        return $this->repository->findOneByUsername($username);
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
