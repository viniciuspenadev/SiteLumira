<?php
// Simple logout
setcookie('sb_access_token', '', time() - 3600, '/');
setcookie('sb_refresh_token', '', time() - 3600, '/');
header('Location: login.php');
exit;
?>