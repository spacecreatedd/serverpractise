<h1><?= $message ?? ''; ?></h1>
<form method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="surname">surname:</label><br>
    <input type="text" id="surname" name="surname"><br>
    <label for="patronym">patronym:</label><br>
    <input type="text" id="patronym" name="patronym"><br>
    <label for="date_of_birth">Date of Birth:</label><br>
    <input type="date" id="date_of_birth" name="date_of_birth"><br>
    <label for="job">Job:</label><br>
    <input type="text" id="job" name="job"><br>
    <label for="specialization">Specialization:</label><br>
    <input type="text" id="specialization" name="specialization"><br><br>
    <button type="submit">Add Doctor</button>
</form>
