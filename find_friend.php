<?php
session_start();
include 'find_function.php';
if(!isset($_SESSION['email'])){
    header("location: signin.php");
}
else{
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/find.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap-grid.min.css" integrity="sha512-pkOzvsY+X67Lfs6Yr/dbx+utt/C90MITnkwx8X5fyKkBorWHJLlR3TmgNJs83URAR0GdejZZnjZdgYjzL/mtcQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>
        <nav class="navbar-expand-sm bg-dark navbar navbar-dark" href="">
            <a href="" class="navbar-brand">
                <?php
                $user = $_SESSION['email'];
                $get_user = "SELECT * FROM users WHERE mail='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);

                $user_name = $row['name'];
                echo " <a class='navbar-brand' href='./home.php?user_name=$user_name'>My Chat</a>";
                ?>
            </a>
            <ul class='navbar-nav'>
            <li><a style='color: white; text-decoration: none; font-size:20px;' href='./account.php'>Setting</a></li>
            </ul>
        </nav><br>
        <div class='row'>
        <div class='col-sm-4'>
        <form action='' class='search_form'>
        <input type='text' name='search_query' placeholder='Search' autocomplete='off' required>
        <button class='btn' type='submit' name='search_btn'>Search</button>
        </form></div>
         <div class='col-sm-4'>
         </div>       
        </div><br><br>
        <?php search_user(); ?>
</body>
</html>
<?php } ?> 