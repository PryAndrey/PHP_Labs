<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>

<body>
    <h3>Форма ввода данных</h3>
    <form action="3-Task.php" method="POST">
        <p>Фамилия: <input type="text" name="last-name" required /></p>
        <p>Имя: <input type="text" name="first-name" required /></p>
        <p>Отчество: <input type="text" name="patronymic" /></p>
        <p>Пол:
            <input type="radio" id="male" name="gender" value="male" required />
            <label for="male">Муж</label>
            <input type="radio" id="female" name="gender" value="female" required />
            <label for="female">Жен</label>
        </p>
        <p>Дата рождения: <input type="date" name="birth-day" required /></p>
        <p>Email: <input type="email" name="email" required /></p>
        <p>Телефон: <input type="tel" name="phone-number" /></p>
        <p>Аватар: <input type="file" name="filename" /></p>
        <input type="submit" value="Отправить">
    </form>
</body>

</html>