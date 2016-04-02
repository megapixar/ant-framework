<?php

use Ant\Router\Routes;

Routes::get("/", function () {
    return "Hello world";
});

Routes::get("/blog", "Blog::index");