<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Профиль</title>
</head>
<body>
    <div>
        <h3><?= htmlentities($user["second_name"]) ?></h3>
        <h3><?= htmlentities($user["first_name"]) ?></h3>
        <?php if ($user["middle_name"]) : ?>
            <h3><?= htmlentities($user["middle_name"]) ?></h3>
        <?php endif; ?>
        <h3><?= htmlentities($user["gender"]) ?></h3>
        <h3><?= htmlentities($user["birth_date"]) ?></h3>
        <h3><?= htmlentities($user["email"]) ?></h3>
        <?php if ($user["phone"]) : ?>
            <h3><?= htmlentities($user["phone"]) ?></h3>
        <?php endif; ?>
        <?php if ($user["avatar_path"]) : ?>
            <h3><?= htmlentities($user["avatar_path"]) ?></h3>
        <?php endif; ?>
    </div>
</body>
</html>
