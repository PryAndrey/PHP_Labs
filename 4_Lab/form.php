<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
</head>
<body>
    <form action="register.php" method="POST">
        <p>Фамилия : <input type="text" name="second_name" required/></p>
        <p>Имя : <input type="text" name="first_name" required/></p>
        <p>Отчество : <input type="text" name="middle_name"/></p>
        <p>Пол : 
            <input type="radio" name="gender" value="man" required/> Мужской <br>
            <input type="radio" name="gender" value="woman" required/> Женский <br>
        </p>
        <p>Дата рождения : <input type="date" name="birth_date" min="1980-01-01" max="2023-12-31" required/></p>
        <p>Email : <input type="text" name="email" required/></p>
        <p>Телефон : <input type="text" name="phone"/></p>
        <p>Аватар : <input type="file" name="avatar_path"/></p>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>