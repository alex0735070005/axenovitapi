<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Post::class);
    }

    public function addPost(Object $data, string $api_key) {
        $em = $this->getEntityManager();

        $UserRepo = $em->getRepository(User::class);
        $User = $UserRepo->findOneBy(['api_key' => $api_key, 'verify' => true]);

        $Post = new Post();
        $User->addPost($Post);
        $Post->setUser($User);

        $Post->setTitle($data->title);
        $Post->setShortDescription($data->short_description);
        $Post->setFullDescription($data->full_description);
        $Post->setSeoUrl($data->seo_url);
        $Post->setStatus($data->status);

        $em->persist($Post);
        $em->persist($User);
        $em->flush($Post);

        return $Post;
    }
    
     public function deletePost(int $id, string $api_key) {
        $em = $this->getEntityManager();

        $UserRepo = $em->getRepository(User::class);
        $User = $UserRepo->findOneBy(['api_key' => $api_key, 'verify' => true]);
        $PostRepo = $em->getRepository(Post::class);
        $Post = $PostRepo->findOneBy(['id' => $id, 'user_id' => $User->getId()]);

        $em->remove($Post);
        $em->flush($Post);

        return $Post;
    }
    
    public function updatePost(Array $data, string $api_key, int $id) {
        $em = $this->getEntityManager();

        $UserRepo = $em->getRepository(User::class);
        $User = $UserRepo->findOneBy(['api_key' => $api_key, 'verify' => true]);
        $PostRepo = $em->getRepository(Post::class);
        $Post = $PostRepo->findOneBy(['id' => $id, 'user_id' => $User->getId()]);

        foreach ($data as $key => $value) {
            $Post->setFrontData($key, $value);
        } 

        $em->persist($Post);
        $em->flush($Post);

        return $Post;
    }

    public function getPost(int $id, string $api_key) {
        $em = $this->getEntityManager();

        $UserRepo = $em->getRepository(User::class);
        $PostRepo = $em->getRepository(Post::class);
        $User = $UserRepo->findOneBy(['api_key' => $api_key, 'verify' => true]);

        if (!$User)
            return $this->json(['result' => false, 'message' => 'User not found']);

        $Post = $PostRepo->findOneBy(['id' => $id, 'user_id' => $User->getId()]);
        return $Post;
    }

    public function getPosts(string $api_key, int $page = 0, int $limit = 10) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $UserRepo = $em->getRepository(User::class);
        $User = $UserRepo->findOneBy(['api_key' => $api_key, 'verify' => true]);
        $offset = 0;
        
        if($page  > 1){
            $offset = ($page - 1) * $limit;
        }
        
        if($limit  > 50){
            $limit = 10;
        }
        
        $qb->select('p')
                ->from(Post::class, 'p')
                ->where('p.user_id = :id')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->orderBy('p.id', 'DESC')
                ->setParameter('id', $User->getId());

        $posts = $qb->getQuery()->getArrayResult();

        return $posts;
    }

}
