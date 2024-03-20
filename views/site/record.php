<h1><?= $message ?? ''; ?></h1>
<form class="add-form" method="POST">
    <label for="patient_id">Пациент:</label>
    <select name="patient_id">
        <option value="">Выберите пациента</option>
        <?php foreach($patient_id as $patient):   ?>
            <option value="<?= $patient->getId()?>"><?= $patient->name?> <?= $patient->surname?> <?= $patient->patronym?></option>
        <?php endforeach; ?>    
    </select><br>


    <label for="doctor_id">Фамилия:</label>
    <select name="doctor_id">
        <option value="">Выберите доктора</option>
        <?php foreach($doctor_id as $doctor):   ?>
            <option value="<?= $doctor->getId()?>"><?= $doctor->name?> <?= $doctor->surname?> <?= $doctor->patronym?></option>
        <?php endforeach; ?>    
    </select><br>


    <label for="date">Дата:</label>
    <input type="date" name="date"><br>
    <button type="submit">Добавить пациента</button>
</form>
