<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 02.04.2016
 * Time: 13:00
 */

namespace App\Http\Controller;


use Ant\Http\IRequest;
use App\Model\Post;

class Blog
{
    public $layout = 'layout';

    public function index()
    {
        return [
            'view' => 'index',
            'data' => [
                'posts' => Post::findAll(),
                'text'  => 'Hello World'
            ]
        ];
    }

    public function store(IRequest $request)
    {

        $todo = new Post;

        $todo->name        = $request->name;
        $todo->description = $request->description;
        $todo->save();

        return header('Location: /blog');
    }

    public function delete($id)
    {

        $todo = Post::findByID($id);
        $todo->delete();

        return header('Location: /blog');
    }
}