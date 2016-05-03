# PHP Coding Exercise: Hourly Invoice

This project was created for a Code Assessment for Sherman Bridge. The original specifications of the project can be found [here](https://docs.google.com/document/d/1wcwS9DNdlEsskdxl_mhdunMpCVH1GOBi8vub_CL-RUQ). An additional requirements specification was created for this project specifically, which can be found [here](https://docs.google.com/document/d/12mR6VuzRoI2SC8Iox_C6IFCDgLEFayJFB-6mHp04Kbs).

If you wish to download this project, and try it for yourself, please refer to the [Installation & Setup Guide](https://docs.google.com/document/d/1DHfC1Ds7O3M41Gh69BTF8_xZAitTmDy6QgGZ3A6-v8E). In short, you'll need to do the following:
 - Setup a Linux Environment (WAMP, MAMP, or Vagrant, etc.)
 - Clone this repository
 - Make sure the Document Root is set to `~/code-review/public`
 - Run the following commands, in order:
    - composer install
    - php artisan migrate
    - npm install

## User Stories

 - User fills out an 'hourly invoice' form with their name, address, hourly rate, customer's contact info, and a log of work (date, hours, description)
 - User sees total hours and invoice amount in real-time live without submitting form
 - User clicks "generate PDF" and a PDF invoice is downloaded

## Requirements
 - Use a PHP framework
 - Use one or more frontend libraries (bootstrap, angular, jquery, etc)
 - If you omit something for brevity (like xss filtering), just put a comment to indicate you’re aware of it
 - Use a PDF library of your choice

## Bonus
 - Use AngularJS or React
 - Use Bootstrap UI
 - Host it somewhere
 - Store and show previous Invoices
 - Use Vagrant
 - Use Composer, Npm, Bower, or other Package Managers
 - Use Symfony and Doctrine
