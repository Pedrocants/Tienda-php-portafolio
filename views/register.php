<h1>Registro de usuario</h1><br>

<form action="<?=base_url?>?controller=usuario&action=save" method="POST">
    <label for="name">Nombre</label>
    <input type="text" name="name" required />
    <label for="last-name">Apellido</label>
    <input type="text" name="last-name" required />
    <label for="email">E-mail</label>
    <input type="email" name="email" required />
    <label for="password">Password</label>
    <input type="password" name="password" required />
    <input type="submit" value="Registrarse" />
</form>