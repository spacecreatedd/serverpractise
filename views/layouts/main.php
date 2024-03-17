<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Pop it MVC</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   <style>
        *{
            font-family: "Montserrat", sans-serif;
        }
        body{
            padding:0 150px;
        }
        .nav-a{
            display:flex;
            justify-content:space-between;
            font-weight:600;
        }
        .nav-a a{
            text-decoration:none;
            color:black;
            font-size:25px;
        }
        .nav-a a:hover{
            color:orange;
            transition:0.2s ease-out;
        }

        input{
            padding:8px;
            font-size:15px;
            outline:0;
            border-radius:5px;
            border:0;
            background:#e7e7e7;
        }
        select{
            border:0;
            background:#e7e7e7;
            padding:5px;
        }
        .add-form{
            display:flex;
            gap:2px;
            flex-direction:column;
            max-width:250px;
        }
        button{
            background-color:black;
            color:white;
            padding:13px;   
            font-size:20px;
        }
    </style>
</head>
<body>
<header>
   <nav class="nav-a">
       <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
       <?php if (!app()->auth::check()): ?>
           <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
           <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
       <?php else: ?>
           <?php $userRole = app()->auth::user()->role; ?>
           <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
           <?php if ($userRole === 'register'): ?>
               <a href="<?= app()->route->getUrl('/doctor') ?>">Создать врача</a>
               <a href="<?= app()->route->getUrl('/patient') ?>">Создать пациента</a>
               <a href="<?= app()->route->getUrl('/record') ?>">Создать запись</a>
           <?php elseif ($userRole === 'admin'): ?>
               <a href="<?= app()->route->getUrl('/register') ?>">Создать сотрудника регистрации</a>
           <?php endif; ?>
       <?php endif; ?>
   </nav>
</header>
<main>
   <?= $content ?? '' ?>
</main>

</body>
</html>