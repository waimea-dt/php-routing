# PHP Routing System with HTMX

This is a simple routing system using PHP as the back-end. It provides the following features:

- HTTP request types: GET, POST

- Routing via URLs of the form: 
    - Fixed route:   /route
    - Fixed route:   /route/param
    - Dynamic route: /route/$value
    - Dynamic route: /route/$value1/$value2
    - Dynamic route: /route/param/$value
    - Dynamic route: /route/param1/$value1/param2/$value2

- Basic templating

- Support for [HTMX](https://htmx.org/) components

The **dist** folder contains the basic routing system with some demo pages and templates.

The **demo** folder contains a more extensive demo with more interactivity, etc.
