<?php
namespace User\Factory\Service;

use Doctrine\ORM\EntityManager;
use User\Entity\User;
use User\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        /**
         * @var EntityManager                       $entityManager
         * @var \Zend\ServiceManager\ServiceManager $serviceManager
         */
        $entityManager = $serviceManager->get(EntityManager::class);

        return new UserService(
            $entityManager->getRepository(User::class)
        );
    }
}
