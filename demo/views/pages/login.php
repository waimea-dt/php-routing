<article>
    <h2>Login</h2>

    <p>User: <strong>jimmy</strong>,  Pass: <strong>jimmy</strong></p>

    <form hx-post="login" hx-swap="outerHTML">

        <label>Username</label>
        <input name="username" type="text" required>

        <label>Password</label>
        <input name="password" type="password" required>

        <input type="submit" value="Login">

    </form>

</article>


