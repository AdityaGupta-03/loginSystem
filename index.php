<?php
require("components/_database.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['input_name'];
    $email = $_POST['input_email'];
    $username = $_POST['input_username'];
    $password = $_POST['input_pass'];
    $c_password = $_POST['input_cpass'];

    // Checking whether user exists or not
    $query = "SELECT * FROM $tableName WHERE username = '$username'";
    $exists = $conn->query($query);

    // Using mysqli_num_rows($result) == 0 specifically checks whether there are no rows returned by the query, which is what you want to verify before proceeding with the INSERT operation. It provides clearer and more accurate logic for your specific scenario.
    if ($username!='' && $password!='' && $c_password == $password && $exists->num_rows == 0) {
        // Storing the hash of the password in DB
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO $tableName (name, email, username, password) VALUES ('$name', '$email', '$username', '$hash')";
        $insert = $conn->query($sql);
    } else {
        $insert = false;
        if ($c_password != $password) {
            $msg = 'Passwords didn\'t match';
        } else if ($exists->num_rows == 1) {
            $msg = 'Username Exists please try another one';
        }
    }
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
    <?php require("components/_nav.php") ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($insert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You details have been submitted
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> $msg
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }
    ?>
    
    <div class="container my-2 w-50">
        <h1 class="text-center">Signup Page</h1>
        <form action="index.php?signin=1" method='POST' class="my-4">
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Name" aria-label="First name" id="name" name="input_name" required>
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="input_email" placeholder="abc@xyz.com">
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="input_username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="input_pass" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <label for="cpass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpass" name="input_cpass" placeholder="Confirm Password">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>

        </form>

    </div>

    <?php require("components/_footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>