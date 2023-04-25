<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="userFormStyle.css">
    <title>Регистрация</title>
</head>

<body>
    <div class="formContainerWrapper">
        <h2>Регистрация</h2>
        <div class="registerBlock">
            <div class="inputTitleContainer">
                <p>Фамилия : </p>
                <p>Имя : </p>
                <p>Email : </p>
                <p>Пароль : </p>
                <p>Телефон : </p>
                <p>Аватар : </p>
            </div>
            <form enctype="multipart/form-data" action="/user/publish" method="post">
                <input type="text" name="second_name" required />
                <input type="text" name="first_name" required />
                <input type="text" name="email" required />
                <input type="password" name="password" required />
                <input type="text" name="phone" />
                <input type="file" name="avatar_path" accept="image/jpeg, image/png, image/webp" />
                <input class="submit" type="submit" value="Отправить">
            </form>
        </div>
    </div>
</body>

</html>