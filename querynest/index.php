<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QueryNest</title>
    <?php require('./client/commonFiles.php') ?>
</head>

<body>
    <div id="preloader">
    <img src="./public/logo.png" alt="Loading..." class="loader-logo">
</div>
    <?php

    session_start();
    session_regenerate_id(true);
    require('./client/header.php');
    $isLoggedIn = isset($_SESSION['user']['username']);

    if (isset($_GET['signup']) && !$isLoggedIn) {
        require('./client/signup.php');
    } elseif (isset($_GET['login']) && !$isLoggedIn) {
        require('./client/login.php');
    } elseif (isset($_GET['ask'])) {
        require('./client/ask.php');
    } elseif (isset($_GET['q-id'])) {
        $qid = $_GET['q-id'];
        require('./client/question-details.php');
    } elseif (isset($_GET['c-id'])) {
        $cid = $_GET['c-id'];
        require('./client/questions.php');
    } elseif (isset($_GET['u-id'])) {
        $uid = $_GET['u-id'];
        require('./client/questions.php');
    } elseif (isset($_GET['latest'])) {

        require('./client/questions.php');
    } elseif (isset($_GET['search'])) {
        $search = $_GET['search'];
        require('./client/questions.php');
    } else {
        require('./client/questions.php');
    }


    ?>


</body>
<script>
    window.addEventListener("load", function () {
        document.getElementById("preloader").style.display = "none";
    });
</script>

</html>