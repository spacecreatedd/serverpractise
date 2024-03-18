<h1><?= $message ?? ''; ?></h1>
<form class="add-form" method="POST">
    <select name="choosepatient">
        <option value="">Выберите врача</option>
    </select><br>
    <select name="choosepatient">
        <option value="">Выберите пациента: </option> 
    </select><br><br>
    <button type="submit">Выбрать</button>
</form>