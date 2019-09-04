<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/posts", name="posts", methods={"GET"})
     */
    public function list()
    {
        include_once __DIR__ . '/../../config/data.php';

        return $this->json($users);
    }

    /**
     * @Route("/posts/{id}", name="get_post", methods={"GET"})
     */
    public function getPost($id)
    {
        include_once __DIR__ . '/../../config/data.php';

        $post = [];

        foreach ($users as $user) {
            if($user['id'] === $id){
                $post = $user;
            }
         }

        return $this->json($post);
    }

    /**
     * @Route("/posts", name="create", methods={"POST"})
     */
    public function create()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/create',
        ]);
    }

    /**
     * @Route("/posts/{id}", name="update", methods={"PUT"})
     */
    public function update()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/update',
        ]);
    }

    /**
     * @Route("/posts/{id}", name="delete", methods={"DELETE"})
     */
    public function delete()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/delete',
        ]);
    }
}
