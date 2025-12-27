<?php
/**
 * Configuration Loader
 * 
 * In LOCAL development, it loads from 'secrets.local.php' (ignored by git).
 * In PRODUCTION (Docker), it loads from Environment Variables (set in Easypanel).
 */

$localSecretsPath = __DIR__ . '/secrets.local.php';

if (file_exists($localSecretsPath)) {
    return include $localSecretsPath;
}

// Production / Docker Environment
return [
    'SUPABASE_URL' => getenv('SUPABASE_URL') ?: '',
    'SUPABASE_KEY' => getenv('SUPABASE_KEY') ?: '',
    'GEMINI_API_KEY' => getenv('GEMINI_API_KEY') ?: '',
    'GEMINI_MODEL' => getenv('GEMINI_MODEL') ?: 'gemini-flash-latest'
];
