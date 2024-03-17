<h1><?= $message ?? ''; ?></h1>
<form class="add-form" method="POST">
    <input type="text" id="name" name="name" placeholder="Имя"><br>
    <input type="text" id="surname" name="surname" placeholder="Фамилия"><br>
    <input type="text" id="patronym" name="patronym" placeholder="Отчество"><br>
    <label for="date_of_birth">Дата рождения:</label><br>
    <input type="date" id="date_of_birth" name="date_of_birth"><br><br>
    <button type="submit">Добавить пациента</button>
</form>
