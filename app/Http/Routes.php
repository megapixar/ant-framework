<?php

use Ant\Router\Routes;

Routes::get("/", function () {
    return "Hello world";
});

Routes::get("/blog", "Blog::index");
Routes::post("/post/add", "Blog::store");
Routes::post("/post/:id/edit", "Blog::edit");
Routes::get("/post/:id/edit", "Blog::edit");
Routes::post("/post/:id/delete", "Blog::delete");