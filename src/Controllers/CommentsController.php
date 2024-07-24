<?php

namespace App\Controllers;

use ApplicationServices\CommentApplicationService;
use Framework\Request;
use Framework\Response;

class CommentsController
{
    public function index(Request $request): Response
    {
        $params = $request->getParams();

        $res = (new CommentApplicationService)->getComments();

        return new Response();
    }

    public function show($thread_id, $id)
    {
    }

    public function store($thread_id)
    {
    }

    public function update($thread_id, $id)
    {
    }

    public function destroy($thread_id, $id)
    {
    }
}
