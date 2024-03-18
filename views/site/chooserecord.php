<h1><?= $message ?? ''; ?></h1>
<form class="add-form" method="POST">
    <select name="chooserecord">
        <option value="">Выберите пациента</option>
    </select><br>
    <select name="chooserecord">
        <option value="">Выберите запись: </option> 
    </select><br><br>
    <button type="submit">Выбрать</button>
</form>