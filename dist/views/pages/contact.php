<h1>Contact Us</h1>

<form
    hx-post="/message"
    hx-trigger="submit"
    hx-swap="outerHTML"
>

    <label>Name</label>
    <input name="name" type="text" required>

    <label>Message</label>
    <textarea name="message" required></textarea>

    <input type="submit" value="Send">

</form>