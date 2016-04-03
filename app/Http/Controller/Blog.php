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
                'posts' => Post::findAll()
            ]
        ];
    }

    public function store(IRequest $request)
    {

        $post = new Post;

        $post->name        = $request->name;
        $post->description = $request->description;
        $post->save();

        return header('Location: /blog');
    }

    public function delete($id)
    {

        $todo = Post::findByID($id);
        $todo->delete();

        return header('Location: /blog');
    }

    public function edit($id, IRequest $request)
    {
        $post = Post::findByID($id);
        if ($request->getMethod() === 'POST') {
            $post->name        = $request->name;
            $post->description = $request->description;

            $post->save();
            return header('Location: /blog');
        } else {
            return [
                'view' => 'edit',
                'data' => [
                    'post' => $post
                ]
            ];
        }
    }
}