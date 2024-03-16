<h1><?= $message ?? ''; ?></h1>
<form method="POST">
    <label for="patient_id">Пациент:</label><br>
    <select name="patient_id">
        <option value="">Выберите пациента</option>
        <?php foreach($patient_id as $patient):   ?>
            <option value="<?= $patient->getId()?>"><?= $patient->name?> <?= $patient->surname?> <?= $patient->patronym?></option>
        <?php endforeach; ?>    
    </select><br><br>


    <label for="doctor_id">Фамилия:</label><br>
    <select name="doctor_id">
        <option value="">Выберите доктора</option>
        <?php foreach($doctor_id as $doctor):   ?>
            <option value="<?= $doctor->getId()?>"><?= $doctor->name?> <?= $doctor->surname?> <?= $doctor->patronym?></option>
        <?php endforeach; ?>    
    </select><br><br>


    <label for="date">Дата:</label><br>
    <input type="date" name="date"><br>
    <button type="submit">Добавить пациента</button>
</form>
