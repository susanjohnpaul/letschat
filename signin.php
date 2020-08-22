<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to your acc</title>
    <link rel="stylesheet" href="./css/signin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap-grid.min.css" integrity="sha512-pkOzvsY+X67Lfs6Yr/dbx+utt/C90MITnkwx8X5fyKkBorWHJLlR3TmgNJs83URAR0GdejZZnjZdgYjzL/mtcQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>
    <div class="signin">
    <form action="" method="post">
    <div class="form-header">
    <h2>Sign In</h2>
    <p>Login to MyChat</p>
    </div>
    <div class="form-group">
    <label for="">
       Email
    </label>
    <input type="email" name="email" class="form-control" id="" autocomplete="off" required>
    </div>
    <div class="form-group">
    <label for="">
       Password
    </label>
    <input type="Password" name="pwd" class="form-control" id="" autocomplete="off" required>
    </div>
    <div class="small">Forgot Password?<a href="forgot.php">click here</a></div><br>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-lg" name="signin">SignIn</button>
    </div>
    <?php include 'signin_user.php'; ?>
    </form>
    <div class="small text-center" style="color: #674288;">Don't have an account? <a href="signup.php">Create one..</a></div>
    </div>
</body>
</html>