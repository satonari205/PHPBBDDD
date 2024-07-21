<?php

namespace App\Controllers;

use App\ApplicationServices\ThreadApplicationService;
use Framework\Request;
use Framework\Response;

class ThreadsController
{
    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        $params = $request->getpostParams();

        $res = (new ThreadApplicationService)->createThread($params['userId'], $params['title'], $params['body']);

        return new Response($res);
    }

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }
}