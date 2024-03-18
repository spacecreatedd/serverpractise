<h1><?= $message ?? ''; ?></h1>
<form class="add-form" method="POST">
    <select name="choosedoctor">
        <option value="">Выберите пациента</option>
    </select><br>
    <select name="choosedoctor">
        <option value="">Выберите врача: </option> 
    </select><br><br>
    <button type="submit">Выбрать</button>
</form>