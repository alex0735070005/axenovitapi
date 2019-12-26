<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class BlogController extends AbstractController
{
     /**
     * @Route("v1/posts/{id}", name="posts_options", methods={"OPTIONS"})
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
     * @Route("v1/posts", name="getPosts", methods={"GET"})
     */
  public function getPosts(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        $api_key = $request->query->get('api_key');      
        $page = $request->query->get('page') ? $request->query->get('page') : 0;
        $limit = $request->query->get('limit') ? $request->query->get('limit') : 10;        
        
        if(!$api_key) return $this->json(['result'=> false, 'message' => 'Api key is not exists']);

        $PostRepo = $this->getDoctrine()->getManager()->getRepository(Post::class);
        $posts = $PostRepo->getPosts($api_key, $page, $limit);
        
        if(!$posts) return $this->json(['result'=> false, 'message' => 'Post not found']);
        
        return $this->json([
                'result' => true,
                'posts' => $posts,
                'message' => '',
        ]);
    }

    /**
     * @Route("v1/posts/{id}", name="getPost", methods={"GET"})
     */
    public function getPost(int $id, Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        $api_key = $request->query->get('api_key');
        
        $api_key = $request->query->get('api_key');        
        if(!$api_key) return $this->json(['result'=> false, 'message' => 'Api key is not exists']);

        $PostRepo = $this->getDoctrine()->getManager()->getRepository(Post::class);
        $Post = $PostRepo->getPost($id, $api_key);
        
        if(!$Post) return $this->json(['result'=> false, 'message' => 'Post not found']);
        
        return $this->json([
                'result' => true,
                'post' => $Post->getFrontData(),
                'message' => '',
        ]);
    }

    /**
     * @Route("v1/posts", name="addPost", methods={"POST"})
     */
    public function addPost(Request $request) {
        header('Access-Control-Allow-Origin: *');
        $data = json_decode(file_get_contents('php://input'));
        // var_dump( $request->query->get('api_key')); die;
        
        $api_key = $request->query->get('api_key');
        
        if(!$api_key) return $this->json(['result'=> false, 'message' => 'Api key is not exists']);
        
        $PostRepo = $this->getDoctrine()->getManager()->getRepository(Post::class);
        $Post = $PostRepo->addPost($data, $api_key);
        
        return $this->json([
                'result' => true,
                'post' =>$Post->getFrontData(),
                'message' => 'Post created success',
        ]);
    }
    
    /**
     * @Route("v1/posts/{id}", name="updatePost", methods={"PUT"})
     */
    public function updatePost(int $id, Request $request) {
        header('Access-Control-Allow-Origin: *');
        $data = json_decode(file_get_contents('php://input'), true);
        // var_dump( $request->query->get('api_key')); die;
       
        $api_key = $request->query->get('api_key');
        
        if(!$api_key) return $this->json(['result'=> false, 'message' => 'Api key is not exists']);
        
        $PostRepo = $this->getDoctrine()->getManager()->getRepository(Post::class);
        $Post = $PostRepo->updatePost($data, $api_key, $id);
        
        return $this->json([
                'result' => true,
                'post' =>$Post->getFrontData(),
                'message' => 'Post updated success',
        ]);
    }
    
    
    /**
     * @Route("v1/posts/{id}", name="deletePost", methods={"DELETE"})
     */
    public function deletePost(int $id, Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        $api_key = $request->query->get('api_key');
        
        $api_key = $request->query->get('api_key');        
        if(!$api_key) return $this->json(['result'=> false, 'message' => 'Api key is not exists']);

        $PostRepo = $this->getDoctrine()->getManager()->getRepository(Post::class);
        $Post = $PostRepo->deletePost($id, $api_key);
        
        if(!$Post) return $this->json(['result'=> false, 'message' => 'Post not found']);
        
        return $this->json([
                'result' => true,
                'post' => $Post->getFrontData(),
                'message' => 'post deleted success',
        ]);
    }
}
