<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {

        header('Access-Control-Allow-Origin: *');
        $this->session = $session;

        include __DIR__ . './../../config/data.php';

        $this->tasks = $this->session->get('tasks');

        if (!isset($this->tasks) || empty($this->tasks)) {
            $this->session->set('tasks', $tasks);

            $this->tasks = $tasks;
        }
    }

    /**
     * @Route("/tasks/{id}", name="tasks_options", methods={"OPTIONS"})
     */
    public function tasksOption()
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
     * @Route("/tasks", name="tasks", methods={"GET"})
     */
    public function list()
    {
        header('Access-Control-Allow-Origin: *');
        return $this->json($this->tasks);
    }

    /**
     * @Route("/tasks/{id}", name="get_task", methods={"GET"})
     */
    public function gettask($id)
    {
        header('Access-Control-Allow-Origin: *');
        $result = [];

        foreach ($this->tasks as $task) {
            if ($task['id'] === $id) {
                $result = $task;
            }
        }

        if (!$result) {
            return $this->json(["result" => false, "status" => 404, "message" => "not found"]);
        }

        return $this->json($result);
    }

    /**
     * @Route("/tasks/last/{limit}", name="tasks_last", methods={"GET"})
     */
    public function lasttasks($limit)
    {
        header('Access-Control-Allow-Origin: *');
        return $this->json(array_slice($this->tasks, -($limit)));
    }


    /**
     * @Route("/tasks", name="create", methods={"task"})
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
     * @Route("/tasks/{id}", name="update", methods={"PUT"})
     */
    public function update($id)
    {
        header('Access-Control-Allow-Origin: *');

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data) || empty($data)) {
            return $this->json(["result" => false, "status" => 400, "message" => "400 not exists or is\'t json format data"]);
        }

        $result = [];

        foreach ($this->tasks as $key => $task) {
            if ($task['id'] === $id) {
                $this->tasks[$key] = [
                    "id" => $task['id'],
                    "title" => isset($data['title']) ? $data['title'] : $task['title'],
                    "user" => $task['user'],
                    "description" => isset($data['description']) ? $data['description'] : $task['description'],
                    "data_create" => $task['data_create'],
                    "data_update" =>  date("Y-m-d H:i:s"),
                    "likes" => isset($data['likes']) ? $data['likes'] : $task['likes'],
                    "favorite" => isset($data['favorite']) ? $data['favorite'] : $task['favorite'],
                ];
                $result = $this->tasks[$key];
                $this->session->set('tasks', $this->tasks);
            }
        }
        return $this->json($result);
    }

    /**
     * @Route("/tasks/{id}", name="delete", methods={"DELETE"})
     */
    public function delete($id)
    {
        header('Access-Control-Allow-Origin: *');
        $tasks = [];
        $taskId = null;

        foreach ($this->tasks as $task) {
            if ($task['id'] === $id) {
                $taskId = $id;
            } else {
                $tasks[] = $task;
            }
        }

        if ($taskId) {
            $this->session->set('tasks', $tasks);
            return $this->json(["result" => true, "status" => 200, "message" => "Ok", "taskId" => $id]);
        }

        return $this->json(["result" => false, "status" => 404, "message" => "not found"]);
    }

    /**
     * @Route("/reset/tasks", name="reset-tasks", methods={"GET"})
     */
    public function reset()
    {
        header('Access-Control-Allow-Origin: *');
        include __DIR__ . './../../config/data.php';
        $this->session->set('tasks', $tasks);

        return $this->json(["reset" => true]);
    }
}
