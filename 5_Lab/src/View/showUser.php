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
        <?php if ($user->getMiddleName()): ?>
            <h3>Отчество:
                <?= htmlentities($user->getMiddleName()) ?>
            </h3>
        <?php endif; ?>
        <p>Пол:
            <?= htmlentities($user->getGender()) ?>
        </p>
        <p>Дата рождения:
            <?= htmlentities($user->getBirthDate()) ?>
        </p>
        <p>Email:
            <?= htmlentities($user->getEmail()) ?>
        </p>
        <?php if ($user->getPhone()): ?>
            <h3>Телефон:
                <?= htmlentities($user->getPhone()) ?>
            </h3>
        <?php endif; ?>
        <?php if ($user->getAvatarPath()): ?>
            <h3>Аватар:
                <img class="" src="<?= htmlentities($user->getUploadUrlPath($user->getAvatarPath())) ?>" alt='ava'>
            </h3>
        <?php endif; ?>
    </div>
</body>

</html>