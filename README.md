# Simple Math Worksheet Generator

This PHP web application creates simple and printable math worksheets using the function rand().
The randomly generated calculations can be solved in the browser, or printed for offline solving.
It currently consists of 4 predefined forms for generating different types of calculations.
You can easily modify the form field values. By doing so they get saved into a cookie, and on reloading the page these values are being loaded again.

## Current features
- Generate 4 predefined worksheets for addition, subtraction, multiplication and division
- Solving the calculations in the browser (with or without showing the result)
- Worksheet layout optimized for printing
- Recalculate worksheets
- Lanuages: DE and EN

## Upcoming features
- Worksheet consisting of mixed calculations (depending on the settings of the other 4 predefined forms).
- There is going to be a configurator, where you can customize your math worksheet using various variables.

## Used technologies and libraries
- [i18n libary from "philipp15b/php-i18n"](https://github.com/Philipp15b/php-i18n)
- [Jquery](https://jquery.com/)
- [Bootstrap 4](https://getbootstrap.com/)
- [Font Awesome 5 Free Icons](https://fontawesome.com/)
- [Jquery-Confirm](https://craftpip.github.io/jquery-confirm/)
- [js-cookie](https://github.com/js-cookie/js-cookie)
- [Popper JS](https://popper.js.org/)
- [sprintf-js](https://www.npmjs.com/package/sprintf-js)