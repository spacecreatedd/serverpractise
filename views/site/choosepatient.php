<form class="add-form" method="POST" action="/pop-it-mvc/choosepatient">
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <select name="choosedoctor">
        <option value="">Выберите врача:</option> 
        <?php foreach($doctors as $doctor): ?>
            <option value="<?= $doctor->id ?>"><?= $doctor->name ?> <?= $doctor->surname ?> <?= $doctor->patronym ?></option>
        <?php endforeach; ?>    
    </select><br>
    <input type="date" name="chosenDate"><br>
    <button type="submit">Выбрать</button>
</form>

<h1><?= $message ?? ''; ?></h1>

<?php foreach($patients as $patient): ?>
    <div class="record patient">
        <p>Имя: <?= $patient->name ?></p>
        <p>Фамилия: <?= $patient->surname ?></p>
        <p>Отчество: <?= $patient->patronym ?></p>
        <p>Дата рождения: <?= $patient->date_of_birth ?></p>
        <img src="<?= $patient->image ?>" alt="Фото пациента">
    </div>
<?php endforeach; ?>

