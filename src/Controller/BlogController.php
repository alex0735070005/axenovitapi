<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {

        header('Access-Control-Allow-Origin: *');
        $this->session = $session;

        include __DIR__ . './../../config/data.php';

        $this->posts = $this->session->get('posts');

        if (!isset($this->posts) || empty($this->posts)) {
            $this->session->set('posts', $posts);

            $this->posts = $posts;
        }
    }

    /**
     * @Route("/posts/{id}", name="posts_options", methods={"OPTIONS"})
     */
    public function postsOption()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
        return $response;
    }

    /**
     * @Route("/posts", name="posts", methods={"GET"})
     */
    public function list()
    {
        header('Access-Control-Allow-Origin: *');
        return $this->json($this->posts);
    }

    /**
     * @Route("/posts/{id}", name="get_post", methods={"GET"})
     */
    public function getPost($id)
    {
        header('Access-Control-Allow-Origin: *');
        $result = [];

        foreach ($this->posts as $post) {
            if ($post['id'] === $id) {
                $result = $post;
            }
        }

        if (!$result) {
            return $this->json(["result" => false, "status" => 404, "message" => "not found"]);
        }

        return $this->json($result);
    }

    /**
     * @Route("/posts/last/{limit}", name="posts_last", methods={"GET"})
     */
    public function lastPosts($limit)
    {
        header('Access-Control-Allow-Origin: *');
        return $this->json(array_slice($this->posts, -($limit)));
    }


    /**
     * @Route("/posts", name="create", methods={"POST"})
     */
    public function create()
    {
        header('Access-Control-Allow-Origin: *');
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/create',
        ]);
    }

    /**
     * @Route("/posts/{id}", name="update", methods={"PUT"})
     */
    public function update($id)
    {
        header('Access-Control-Allow-Origin: *');

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data) || empty($data)) {
            return $this->json(["result" => false, "status" => 400, "message" => "400 not exists or is\'t json format data"]);
        }

        $result = [];

        foreach ($this->posts as $key => $post) {
            if ($post['id'] === $id) {
                $this->posts[$key] = [
                    "id" => $post['id'],
                    "title" => isset($data['title']) ? $data['title'] : $post['title'],
                    "user" => $post['user'],
                    "description" => isset($data['description']) ? $data['description'] : $post['description'],
                    "data_create" => $post['data_create'],
                    "data_update" =>  date("Y-m-d H:i:s"),
                    "likes" => isset($data['likes']) ? $data['likes'] : $post['likes'],
                    "favorite" => isset($data['favorite']) ? $data['favorite'] : $post['favorite'],
                ];
                $result = $this->posts[$key];
                $this->session->set('posts', $this->posts);
            }
        }
        return $this->json($result);
    }

    /**
     * @Route("/posts/{id}", name="delete", methods={"DELETE"})
     */
    public function delete($id)
    {
        header('Access-Control-Allow-Origin: *');
        $posts = [];
        $postId = null;

        foreach ($this->posts as $post) {
            if ($post['id'] === $id) {
                $postId = $id;
            } else {
                $posts[] = $post;
            }
        }

        if ($postId) {
            $this->session->set('posts', $posts);
            return $this->json(["result" => true, "status" => 200, "message" => "Ok", "postId" => $id]);
        }

        return $this->json(["result" => false, "status" => 404, "message" => "not found"]);
    }

    /**
     * @Route("/reset/posts", name="reset-posts", methods={"GET"})
     */
    public function reset()
    {
        header('Access-Control-Allow-Origin: *');
        include __DIR__ . './../../config/data.php';
        $this->session->set('posts', $posts);

        return $this->json(["reset" => true]);
    }
}
