# Components Folder

This is the place for any scripts that will be run in response to an HTMX request, returning a fragment of HTML

This scripts may well perform database queries, etc. to obtain data which is then used to create the HTML fragment

## Naming

It is good-practice to name the action files in the form: **type**-**name**.php or **type**-**name**-**action**.php

- **Type** might be: button, form, list, etc.
- **Name** is the name of the thing(s) that component congtains: users, product, etc.
- **Action** is what the component will do when interacted with: create, update, delete, etc.

For example:

- *list-users.php*
- *list-products.php*
- *details-product.php*
- *form-user-new.php*
- *form-user-update.php*
- *button-user-delete.php*

