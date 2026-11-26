<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return (new \App\Controllers\Website\Site())->home();
    }

    public function page($slug)
    {
        return (new \App\Controllers\Website\Site())->page($slug);
    }
}