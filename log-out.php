<?php

session_start();
session_destroy();

echo "<script>
alert('Wylogowałeś się');
window.location.href='./welcome.php';
</script>";

?>