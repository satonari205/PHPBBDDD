<?php if (!LOADED) exit;

use App\Controllers\AuthController;
use App\Controllers\ThreadsController;
use App\Controllers\UsersController;

return [
    // Authentication
    ["POST", "/api/register", [AuthController::class, "register"]],
    ["POST", "/api/login",    [AuthController::class, "login"   ]],
    ["POST", "/api/logout",   [AuthController::class, "logout"  ]],
    ["GET",  "/api/user",     [AuthController::class, "user"    ]],

    // User
    // ["GET", "/api/users", [UserController::class, "index"]],
    // ["PUT", "/api/user/{id}", [UserController::class, "update"]],
    // ["DELETE", "/api/user/{id}", [UserController::class, "delete"]],

    // Threads
    ["GET",    "/api/threads",      [ThreadsController::class, "index"  ]],
    ["GET",    "/api/threads/{id}", [ThreadsController::class, "show"   ]],
    ["POST",   "/api/threads",      [ThreadsController::class, "store"  ]],
    ["PUT",  "/api/threads/{id}", [ThreadsController::class, "update" ]],
    ["DELETE", "/api/threads/{id}", [ThreadsController::class, "destroy"]],

    // Comments
    // ["GET", "/api/thread/{thread_id}/comment/{id}", [CommentsController::class, "show"]],
    // ["GET", "/api/thread/{thread_id}/comments", [CommentsController::class, "index"]],
    // ["POST", "/api/thread/{thread_id}/comment", [CommentsController::class, "store"]],
    // ["PATCH", "/api/thread/{thread_id}/comment/{id}", [CommentsController::class, "update"]],
    // ["DELETE", "/api/thread/{thread_id}/comment/{id}", [CommentsController::class, "destroy"]],

    // Search
    // ["GET", "/api/search", [SearchController::class, "search"]]
];
