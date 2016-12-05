# Login via Facebook

**Easy to use facebook site authentication using PHP and Graph SDK**

## Setting up the back-end

 - If you intend to log fb authentication on DB, please import the sql file -> db/fb.sql

## Configuring Facebook App

 - Login to developer.facebook.com
 - Once logged-in, on the upper right side, click the "My Apps" dropdown and hit "Add New App"
 - Please fill-up short form e.g. Display Name, Category
 - Once created, select the app and go to settings
 - Get the App ID and App Secret. We will use this on the authentication section.
 - On the bottom part of the settings page, hit on "Add Platform"
 - Select website
 - On the Site URL field, please enter the call back URL. In our case, it's http://{domain}/dashboard.php