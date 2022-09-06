<?php


namespace App\mvc\controllers;


use App\core\base\Controller;
use App\core\base\Model;
use App\core\base\View;
use App\core\logger\DbLogger;
use App\mvc\models\Post;

class PostController extends Controller
{
    public Model $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    function index()
    {
        $posts = $this->model->findAll();
        dum(DbLogger::getCountSql());
        dum(DbLogger::getQueries());

        View::render('pages/post/list', ['title' => 'Posts', 'posts' => $posts]);
    }

    public function getOne($id)
    {
        $post = $this->model->find($id);
        dum(DbLogger::getCountSql());
        dum(DbLogger::getQueries());

        View::render('pages/post/one', ['title' => $post['title'], 'post' => $post]);
    }

    public function update($id)
    {

        if (!empty($_POST) && isset($_POST['title']) && isset($_POST['body'])) {
            $params = $_POST;
            $params['id'] = $id;
            $this->model->update($params);
            header("Location: /post/update/$id");
        }

        $posts = $this->model->find($id);
        dum(DbLogger::getCountSql());
        dum(DbLogger::getQueries());
        View::render('pages/post/update', ['title' => 'Post Update', 'id' => $id, 'posts' => $posts]);
    }

    public function add()
    {
        $row = null;
        if (!empty($_POST) && isset($_POST['title']) && isset($_POST['body'])) {
            $params = $_POST;
            $row = (int)$this->model->add($params);
//            header("Location: /post/add");
        }

        dum(DbLogger::getCountSql());
        dum(DbLogger::getQueries());

        View::render('pages/post/update', ['title' => 'Post Add', 'row' => $row]);
    }

    public function delete()
    {
        if (!empty($_POST) && isset($_POST['id'])) {
            $params = $_POST;
//            dum($params);
            $this->model->delete($params);
            header("Location: /post");
        }
    }
}