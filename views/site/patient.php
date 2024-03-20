<form class="add-form" method="POST" enctype="multipart/form-data">
    <input type="text" id="name" name="name" placeholder="Имя"><br>
    <input type="text" id="surname" name="surname" placeholder="Фамилия"><br>
    <input type="text" id="patronym" name="patronym" placeholder="Отчество"><br>
    <label for="date_of_birth">Дата рождения:</label>
    <input type="date" id="date_of_birth" name="date_of_birth"><br>
    <input type="file" id="image" name="image" accept="image/*"><br> <!-- Добавлено поле для загрузки изображения -->
    <button type="submit">Добавить пациента</button>
</form>
