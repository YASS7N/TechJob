<?php

session_start();

unset($_SESSION['userId']);
unset($_SESSION['role']);
unset($_SESSION['user']); 

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Logged Out Successfully',
            text: 'Redirecting to homepage...',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = '../Pages/HomePage.php';
        });
    </script>
</body>
</html>
