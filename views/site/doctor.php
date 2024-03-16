<h1><?= $message ?? ''; ?></h1>
<form method="POST">
    <label for="name">Имя:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="surname">Фамилия:</label><br>
    <input type="text" id="surname" name="surname"><br>
    <label for="patronym">Отчество:</label><br>
    <input type="text" id="patronym" name="patronym"><br>
    <label for="date_of_birth">Дата рождения:</label><br>
    <input type="date" id="date_of_birth" name="date_of_birth"><br>
    <label for="job">Должность:</label><br>
    <select name="job">
        <option value="">Выберите должность</option>
        <?php foreach($jobs as $job):   ?>
            <option value="<?= $job->getId()?>"><?= $job->job?></option>
        <?php endforeach; ?>    
    </select><br><br>
    <label for="specialization">Специализация:</label><br>
    <select name="specialization">
        <option value="">Выберите специализацию: </option>
        <?php foreach($specs as $spec):   ?>
            <option value="<?= $spec->getId()?>"><?= $spec->spec?></option>
        <?php endforeach; ?>    
    </select><br><br>
    <button type="submit">Создать доктора</button>
</form>



<style>
</style>