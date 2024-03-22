<h1><?= $message ?? ''; ?></h1>

<!-- Форма для поиска записи по ID -->
<form class="search-form" method="POST">
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <input type="text" name="record_id" placeholder="Введите ID записи"><br>
    <button type="submit" name="search_record">Поиск</button>
</form>

<!-- Форма для фильтрации записей по пациенту -->
<form class="filter-form" method="POST">
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <select name="patient_filter">
        <option value="">Все пациенты</option>
        <?php foreach($patient_id as $patient): ?>
            <option value="<?= $patient->getId()?>"><?= $patient->name?> <?= $patient->surname?> <?= $patient->patronym?></option>
        <?php endforeach; ?>    
    </select><br>
    <button type="submit">Выбрать</button>
</form>

<!-- Отображение найденной записи (если есть результаты поиска) -->
<?php if (isset($foundRecord)): ?>
    <div class="record">
        <p>Пациент: <?= $foundRecord->patient_id?></p>
        <p>Врач: <?= $foundRecord->doctor_id?></p>
        <p>Дата: <?= $foundRecord->date?></p>
        <!-- Форма для отмены записи -->
        <form method="POST"> 
            <input type="hidden" name="record_id" value="<?= $foundRecord->id ?>">
            <button type="submit" name="cancel_record">Отменить</button>
        </form>
    </div>
<?php endif; ?>


<!-- Отображение всех записей (если нет результатов поиска) -->
<?php if (!isset($foundRecord)): ?>
    <?php foreach($records as $record): ?>
        <div class="record">
            <p>Пациент: <?= $record->patient_id?></p>
            <p>Врач: <?= $record->doctor_id?></p>
            <p>Дата: <?= $record->date?></p>
            <!-- Форма для отмены записи -->
            <form method="POST"> 
                <input type="hidden" name="record_id" value="<?= $record->id ?>">
                <button type="submit" name="cancel_record">Отменить</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
