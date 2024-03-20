<h2>Регистрация нового СОТРУДНИКА</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
   <label>Имя <input required type="text" name="name"></label>
   <label>Логин <input required type="text" name="login"></label>
   <label>Пароль <input required type="password" name="password"></label>
   <label>Должность: </label>
   <select name="role">
      <option value="register">Сотрудник регистратуры</option>
   </select>
   <button>Добавить</button>
</form>
