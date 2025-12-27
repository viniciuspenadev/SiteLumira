<?php
// Secure endpoint to delete a conversation
session_start();

// Validar sessão/token
if (!isset($_COOKIE['sb_access_token'])) {
    header('Location: login.php');
    exit;
}

$conversationId = $_GET['id'] ?? null;

if (!$conversationId) {
    die("ID inválido");
}

$secrets = include '../includes/secrets.php';
require_once '../includes/supabase_helper.php';

// Instantiate with User Token
$supabase = new SupabaseHelper($secrets['SUPABASE_URL'], $secrets['SUPABASE_KEY']); // Init with anon key
$supabase->setToken($_COOKIE['sb_access_token']); // Set user token

// Execute Delete
$supabase->deleteConversation($conversationId);

// Redirect back to Dashboard
header("Location: dashboard.php?msg=deleted");
exit;
?>