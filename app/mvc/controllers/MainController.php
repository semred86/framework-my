<?php


namespace App\mvc\controllers;


use App\core\base\Controller;
use App\core\base\View;

class MainController extends Controller
{
    public function index()
    {
        View::render('pages/home', ['title' => 'Home Page']);
    }
}