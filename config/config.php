<?php
// Base URL (adjust folder name if needed)
define("BASE_URL", "http://localhost/todo_mvc");

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
