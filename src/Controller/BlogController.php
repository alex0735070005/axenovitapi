<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        
        header('Access-Control-Allow-Origin: *');
        $this->session = $session;
                
        include_once __DIR__ . './../../config/data.php';
        
        $this->posts = $this->session->get('posts');
        
        if(!isset($this->posts) || empty($this->posts)) {
            $this->session->set('posts', $posts);
            
            $this->posts = $posts;
        }
         
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
            if($post['id'] === $id){
                $result = $post;
            }
         }

        return $this->json($result);
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
     * @Route("/posts/update/{id}", name="update", methods={"POST"})
     */
    public function update($id)
    {
        header('Access-Control-Allow-Origin: *');
        
        $data = json_decode(file_get_contents('php://input'), true);
      
        if(!isset($data) || empty($data)) {die('404');}

        $result = [];
       
        foreach ($this->posts as $key => $post) {
            if($post['id'] === $id){
                 
               $this->posts[$key] = $data;
               // var_dump($post); die();
               $this->posts[$key] = [
                   "id"=> $post['id'],
                   "title"=> $post['title'],
                   "user"=> $post['user'],
                   "description"=> isset($data['description']) ? $data['description'] : $post['description'],
                   "data_create"=> $post['data_create'],
                   "data_update"=>  date("Y-m-d H:i:s"),
                   "likes"=> isset($data['likes']) ? $data['likes'] : $post['likes'],
                   "favorite"=> isset($data['favorite']) ? $data['favorite'] : $post['favorite'],
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
    public function delete()
    {
        header('Access-Control-Allow-Origin: *');
        $result = [];
       
        foreach ($this->posts as $key => $post) {
             if($post['id'] === $id){                 
                unset($this->posts[$key]);
               
                $result = ["id" => $id];
                $this->session->set('posts', $this->posts);
             }
        }        
       
        return $this->json($result);
    }
}
