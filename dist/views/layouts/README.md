# Layouts Folder

This is the place for any page templates and template partials that will be used for page views.

## Naming

There should be at least one layout template. Call this **default.php**

Any **partials** can be made clearly identifiable by prefixing the name with an **underscore**:

For example:

- *_head.php* - The contents of the `<head>` section
- *_header.php* - The main header
- *_footer.php* - The main footer
- *_nav.php* - The navigation section

These partials can be used within a page layout template by simply 'requiring' it:

```php
require '_nav.php';
```

