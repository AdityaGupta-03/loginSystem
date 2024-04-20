<?php
require("../components/_database.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['input_username'];
    $password = $_POST['input_pass'];
    $loggedin=false;

    // Retrieving the hash of password and then verify
    $query = "SELECT * FROM $tableName WHERE username = '$username'";
    $match = $conn->query($query);

    if (($match->num_rows) == 1) {
        $row = mysqli_fetch_assoc($match);
        if (password_verify($password, $row['password'])) {
            $loggedin = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
        }
        else{
            $msg = "Incorrect Password";
        }
    }
    else{
        $msg = 'Not registered user, Go to Signup Page';
    }

    // Checking whether user exists or not if password hash is not used
    // $query = "SELECT * FROM $tableName WHERE username = '$username' AND password = '$password'";
    // $match = $conn->query($query);

    // if (($match->num_rows) == 1) {
    //     $loggedin = true;
    //     session_start();
    //     $_SESSION['loggedin'] = true;
    //     $_SESSION['username'] = $username;
    // } else {
    //     $loggedin = false;
    //     $query = "SELECT * FROM $tableName WHERE username = '$username'";
    //     $match = $conn->query($query);
    //     if ($match->num_rows == 1) {
    //         $msg = "Incorrect Password";
    //     } else {
    //         $msg = 'Not registered user, Go to Signup Page';
    //     }
    // }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require("../components/_nav.php") ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($loggedin) {
            // Redirect to the welcome page
            header("Location: welcome.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            // If login fails, you can display an error message or redirect to the login page again
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> $msg
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }
    ?>
    <div class="container my-2 w-50">
        <h1 class="text-center">Login Page</h1>
        <form action="login.php" method='POST' class="my-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="input_username" placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="input_pass" placeholder="Password">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>

    </div>

    <?php require("../components/_footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>