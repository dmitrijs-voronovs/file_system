<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/0938627de3.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php if(!Classes\User::is_logged()) echo'
                <li><a href="register.php">register</a></li>
                <li><a href="login.php">login</a></li>';
                else echo'
                <li><a href="logout.php">logout</a></li>
                <li><a href="index.php">index</a></li>'; ?>
            </ul>
        </nav>    
    </header>