<?php if (!LOADED) exit;

use App\Controllers\AuthController;

return [
    // Register a new user
    ["POST", "/api/register", [AuthController::class, "register"]],

    // Login a user
    ["POST", "/api/login", [AuthController::class, "login"]],

    // Logout a user
    ["POST", "/api/logout", [AuthController::class, "logout"]],

    // Get a user
    ["GET", "/api/user", [AuthController::class, "logout"]]
];
