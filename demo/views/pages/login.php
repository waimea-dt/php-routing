<h1>Login</h1>

<h3>User: jimmy<br>Pass: jimmy</h3>

<form hx-post="login" hx-swap="outerHTML">

    <label>Username</label>
    <input name="username" type="text" required>

    <label>Password</label>
    <input name="password" type="password" required>

    <input type="submit" value="Login">

</form>