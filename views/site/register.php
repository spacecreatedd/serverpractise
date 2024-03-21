<h2>Регистрация нового СОТРУДНИКА</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
   <label>Имя <input  type="text" name="name"></label>
   <label>Логин <input  type="text" name="login"></label>
   <label>Пароль <input  type="password" name="password"></label>
   <label>Должность: </label>
   <select name="role">
      <option value="register">Сотрудник регистратуры</option>
   </select>
   <button>Добавить</button>
</form>
