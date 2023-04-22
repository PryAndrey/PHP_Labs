<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Регистрация</title>
</head>

<body>
    <div class="main">
        <form enctype="multipart/form-data" action="/addUser.php" method="post">
            <div class="elem">
                <p>Фамилия : </p><input type="text" name="second_name" required />
            </div>
            <div class="elem">
                <p>Имя : </p><input type="text" name="first_name" required />
            </div>
            <div class="elem">
                <p>Отчество : </p><input type="text" name="middle_name" />
            </div>
            <div class="elem">
                <p>Пол : </p>
                <div class="gend">
                    <div class="gendItem"><input class="gendItemInput" type="radio" name="gender" value="man"
                            required /> Мужской <br></div>
                    <div class="gendItem"><input class="gendItemInput" type="radio" name="gender" value="woman"
                            required /> Женский <br></div>
                </div>

            </div>
            <div class="elem">
                <p>Дата рождения : </p><input type="date" name="birth_date" min="1980-01-01" max="2023-12-31"
                    required />
            </div>
            <div class="elem">
                <p>Email : </p><input type="text" name="email" required />
            </div>
            <div class="elem">
                <p>Телефон : </p> <input type="text" name="phone" />
            </div>
            <div class="elem">
                <p>Аватар : </p>
            </div>
            <input type="file" name="avatar_path" accept="image/jpeg, image/png, image/webp" />
            <input type="submit" value="Отправить">
        </form>
    </div>
</body>

</html>