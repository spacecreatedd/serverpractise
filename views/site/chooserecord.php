<h1><?= $message ?? ''; ?></h1>
<form class="add-form" method="POST">
    <select name="patient_filter">
        <option value="">Все пациенты</option>
        <?php foreach($patient_id as $patient): ?>
            <option value="<?= $patient->getId()?>"><?= $patient->name?> <?= $patient->surname?> <?= $patient->patronym?></option>
        <?php endforeach; ?>    
    </select><br>

    <button type="submit">Выбрать</button>
</form>

<?php foreach($records as $record): ?>
    <div class="record">
        <p>Пациент: <?= $record->patient_id?></p>
        <p>Врач: <?= $record->doctor_id?></p>
        <p>Дата: <?= $record->date?></p>
        <form method="POST" > 
            <input type="hidden" name="record_id" value="<?= $record->id ?>">
            <button type="submit" name="cancel_record">Отменить</button>
        </form>
    </div>
<?php endforeach; ?>

