<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='style.css'>
    <title>Document</title>

</head>
<body>
<div class="container">
    <h1 class="form__title">Task list</h1>
    <div>
        <form action="../controllers/task_list.php" method="post">
            <input class="form__input" name="work" type="text" placeholder="Enter text...">
            <button class="form__button" name="btnadd" type="submit">ADD</button>
            <button class="form__button" name="btnrmall" type="submit">REMOVE ALL</button>
    </div>
    <br>
    <? foreach (getDescriptionTaskList($_SESSION['id_user']) as $key => &$value) { ?>
        <div>
            <label class="form__label" for=""><?  echo htmlspecialchars($value) ?></label>
            <br>
            <button class="form__button" class="form__button" name="btnrm" type="submit">DELETE</button>
        </div>
        <button class="form__button" name="btn" type="submit" value="true">READY</button>
        <button class="form__button" name="btn" type="submit" value="false">UNREADY</button>
        <label class="switch">
            <input type="checkbox" disabled ' . $_SESSION['checked'][$key] . '>
            <span class="slider round"></span>
        </label>
        </form>
    <? }
    /*var_dump(getDescriptionTaskList($_SESSION['id_user']));*/
    var_dump($_SESSION);
    //session_destroy();
    ?>


    <!--    if (!empty($_SESSION['listWork'])) {
            foreach ($_SESSION['listWork'] as $key => &$value) {

                echo
                    '<form  action="/delete.php" method="post">' .
                    '<div>' .
                    '<input type="text" name="key" value="' . $key . '" hidden/>' .
                    '<label class="form__label" for="">' . $value . '</label>' .
                    '<br>' .
                    '<button class="form__button" class="form__button" name="btnrm" type="submit">DELETE</button> ' .
                    '</div>' .
                    '</form>' .
                    '<form action="/checkbox.php" method="post">' .
                    '<input type="text" name="key" value="' . $key . '" hidden/>' .
                    '<button class="form__button" name="btn" type="submit" value="true">READY</button> ' .
                    '<button class="form__button" name="btn" type="submit" value="false">UNREADY</button> ' .
                    '<label class="switch">
                            <input type="checkbox" disabled ' . $_SESSION['checked'][$key] . '>
                            <span class="slider round"></span>
                     </label>' .
                    '</form>';
            }
        }
    -->
</div>

</body>
</html>