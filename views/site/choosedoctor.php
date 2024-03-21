<form class="add-form" method="POST">
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <select name="choosedPatient">
        <option value="">Выберите пациента</option>
        <?php foreach($patients as $patient): ?>
            <option value="<?= $patient->getId()?>"><?= $patient->name?> <?= $patient->surname?> <?= $patient->patronym?></option>
        <?php endforeach; ?>    
    </select><br>
    <button type="submit">Выбрать</button>
</form>

<h1><?= $message ?? ''; ?></h1>

<h2>Список врачей:</h2>


<?php if (!empty($doctors)): ?>
    <?php foreach($doctors as $doctor): ?>
        <div class="record">
            <p>Имя: <?= $doctor->name ?></p>
            <p>Фамилия: <?= $doctor->surname ?></p>
            <p>Отчество: <?= $doctor->patronym ?></p>
            <p>Дата рождения: <?= $doctor->date_of_birth ?></p>
            <p>Должность: <?= $doctor->job ?></p>
            <p>Специализация: <?= $doctor->specialization ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Нет врачей</p>
<?php endif; ?>


