<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>laba5</title>
</head>

<body>
    <div class="main">
        <h1>Фамилия:
            <?= htmlentities($user->getSecondName()) ?>
        </h1>
        <h2>Имя:
            <?= htmlentities($user->getFirstName()) ?>
        </h2>
        <p>Email:
            <?= htmlentities($user->getEmail()) ?>
        </p>
        <p>Пароль:
            <?= htmlentities($user->getPassword()) ?>
        </p>
        <h3>Телефон:
            <?= htmlentities($user->getPhone()) ?>
        </h3>
        <h3>Аватар:
            <img class="" src="<?= htmlentities($user->getUploadUrlPath($user->getAvatarPath())) ?>" alt='ava'>
        </h3>
    </div>
    <form action="/user/<?= htmlentities($user->getUserId()) ?>" method="get">
        <input type="submit" value="Каталог">
    </form>
</body>

</html>