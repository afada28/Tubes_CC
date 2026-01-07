<?php
// Test file to check if callback URL is reachable
echo "✅ CALLBACK URL WORKS!<br>";
echo "Current URL: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Full URL: " . (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "<br>";
echo "<br>Add this EXACT URL to Google Console Authorized Redirect URIs:<br>";
echo "<strong>http://127.0.0.1:8000/auth/google/callback</strong>";
