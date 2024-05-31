<?php
session_start();
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="todolist.css" rel="stylesheet">
    <title>Lista todo</title>
</head>
<body>
    <main class="sing__body">
    <?php include "config.php"; ?>

    <?php include "nav.php"; ?>


    <section class="todo">
    <div class="container__items--toDoList">
            <div class="container__items--toDoList--title">
                <p>Lista zakupów</p>
                <p> <span class="container__items--toDoList--title-counter"></span></p>
            </div>
            <div class="container__items--toDoList--mainElement">
                <ul class="container__items--toDoList--mainElement--list">

                </ul>
                <input id="addElement-toDoList" class="container__items--toDoList--mainElement-addElement" placeholder="+ Dodaj nowy element checklisty" type="text">
            </div>
        </div>


        </section>

    
    <script src="todolist.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="popper.js"></script>
    </main>
</body>
</html>
