<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Service\EncoderService;
use App\Service\MailService;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, User::class);
    }

    public function addUser(array $data,  $passwordEncoder) {
        $em = $this->getEntityManager();
        $user = new User();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setApiKey(EncoderService::encodeApiKey($data['email'], $data['username']));
        $user->setVerify(true);
        $user->setPassword($passwordEncoder->encodePassword($user, $data['password']));
        $em->persist($user);
        $em->flush();
        return $user;
    }
    
     public function getUserByEmail(string $email) {
        $em = $this->getEntityManager();
        $repoUser = $em->getRepository(User::class);

        $User = $repoUser->findOneBy(['email' => $email]);

        if (!$User) {
            return null;
        }
        return $User;
    }
    
    public function verifyEmail(string $apiKey) {
        $em = $this->getEntityManager();
        $repoUser = $em->getRepository(User::class);

        $User = $repoUser->findOneBy(['api_key' => $apiKey, 'verify' => false]);

        if (!$User) {
            return null;
        }

        $User->setVerify(true);

        $em->persist($User);
        $em->flush();
        return $User;
    }

}
