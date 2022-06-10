<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='css/singupStyle.css'>
    <title>Document</title>
</head>
<body>

<form class="form" action="../handlers/signup.php" method="post">

    <h1 class="form__title">Signup</h1>

    <div class="form__group">
        <input class="form__input" name="login" type="text" placeholder="Enter Login">
    </div>

    <div class="form__group">
        <input class="form__input" name="password" type="password" placeholder="Enter Password">
    </div>

    <div class="form__group">
        <button class="form__button" name="submit" type="submit">Signup</button>
        <?echo htmlspecialchars($_SESSION['message'][0]) ?>
        <?unset($_SESSION['message']) ?>
    </div>
</form>

</body>
</html>




