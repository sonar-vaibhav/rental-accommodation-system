<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

echo "<script>
  setTimeout(function() {
    alert('Logout Successful...');
    window.location.href = '../../login.html';
  }, 1000);
</script>";
exit;
?>