<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../pizzaCatalogStyle.css">
    <link rel="stylesheet" href="../pizzaWrapperStyle.css">
    <title>laba5</title>
</head>

<body>
    <header>
        <div class="title">
            <img src="/images/pizza1.png" alt="img">
            <h1>PIZZA SERVICE</h1>
        </div>
        <div class="profile">
            <div class="profile_info">
                <p>
                    <?= htmlentities($user->getSecondName() . " " . htmlentities($user->getFirstName())) ?>
                </p>
                <p>
                    <?= htmlentities($user->getEmail()) ?>
                </p>
            </div>
            <?php if ($user->getAvatarPath() !== null): ?>
                <img class="profile_avatar"
                    src="<?= htmlentities($user->getUploadUrlPath($user->getAvatarPath())) ?>"
                    alt="<?= htmlentities($user->getAvatarPath()) ?>">
            <?php endif; ?>
        </div>
    </header>
    <main>
        <h2>Ассортимент</h2>
        <div class="assortimentBlock">
            <?php foreach ($pizzas as $pizza): ?>
                <div class="assortimentItem">
                    <img src="<?= htmlentities($pizza->getUploadUrlPath($pizza->getPizzaImage())) ?>" alt='ava'>
                    <div class="pizzaInfo">
                        <h1 class="pizzaInfo_title">
                            <?= htmlentities($pizza->getPizzaTitle()) ?>
                        </h1>
                        <h3 class="pizzaInfo_structure">
                            <?= htmlentities($pizza->getPizzaStructure()) ?>
                        </h3>
                        <h3 class="pizzaInfo_description">
                            <?= htmlentities($pizza->getPizzaDescription()) ?>
                        </h3>
                        <h2 class="pizzaInfo_cost">
                            <?= htmlentities($pizza->getPizzaCost()) ?>
                        </h2>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>PIZZA SERVICE</p>
    </footer>

</body>

</html>