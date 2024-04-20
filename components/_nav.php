<?php

function isPage($page)
{
    if (basename($_SERVER['PHP_SELF']) == $page) {
        return "active";
    } else {
        return "";
    }
}

?>

<?php

$signup = '<li class="nav-item">
<a class="nav-link'. (isPage('index.php') ? " active" : "") .'" aria-current="page" href="/addy/loginSystem/index.php">Signup</a>
</li>';

$login = '<li class="nav-item">
<a class="nav-link'. (isPage('login.php') ? " active" : "") .'" href="/addy/loginSystem/src/login.php">Login</a>
</li>';

$welcome = '<li class="nav-item">
<a class="nav-link'. (isPage('welcome.php') ? " active" : "") .'" href="/addy/loginSystem/src/welcome.php">Welcome</a>
</li>';

$logout = '<li class="nav-item">
<a class="nav-link '. (isPage('logout.php') ? " active" : "") . '" href="/addy/loginSystem/src/logout.php">Logout</a>
</li>';

?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../"><img src="/addy/loginSystem/img/logo.png" alt="logo" height="30px" width="35px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo "$welcome $logout";
                }
                else{
                    echo "$signup $login";
                }
                
                ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>