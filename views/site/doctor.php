<h1><?= $message ?? ''; ?></h1>
<form class="add-form" method="POST">
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <input  type="text" id="name" name="name" placeholder="Имя"><br>
    <input  type="text" id="surname" name="surname" placeholder="Фамилия"><br>
    <input  type="text" id="patronym" name="patronym" placeholder="Отчество"><br>
    <label for="date_of_birth">Дата рождения:</label><br>
    <input  type="date" id="date_of_birth" name="date_of_birth"><br>
    <select   name="job">
        <option value="">Выберите должность</option>
        <?php foreach($jobs as $job):   ?>
            <option value="<?= $job->getId()?>"><?= $job->job?></option>
        <?php endforeach; ?>    
    </select><br>
    <select  name="specialization">
        <option value="">Выберите специализацию: </option>
        <?php foreach($specs as $spec):   ?>
            <option value="<?= $spec->getId()?>"><?= $spec->spec?></option>
        <?php endforeach; ?>    
    </select><br><br>
    <button type="submit">Создать доктора</button>
</form>
