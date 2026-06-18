<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Global error handler
set_error_handler(function() {
    header("Location: error.php");
    exit;
});

// Global exception handler
set_exception_handler(function() {
    header("Location: error.php");
    exit;
});
?>