<h2>Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
   <label>Имя <input type="text" name="name"></label>
   <label>Логин <input type="text" name="login"></label>
   <label>Пароль <input type="password" name="password"></label>
   <label>Должность: </label>
   <select name="role">
      <option value="register">Сотрудник регистратуры</option>
      <option value="admin">Админ</option>
   </select>
   <button>Зарегистрироваться</button>
</form>
