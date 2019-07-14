# File system
![Preview](https://user-images.githubusercontent.com/44952559/61183580-9be8e400-a64b-11e9-93da-22ba5e3be43a.png)

## Installation
1. navigate to www directory of XAMPP/WAMP
2. `git clone https://github.com/DmitryVoronovLV/file_system.git`
3. `cd file_system`
4. `composer install`
5. `npm install`
6. open MySQL, create a new database according to your credentials inside __/private/db_credentials.php__
7. create a new user for the database, provide it with permissions to create / read / update / delete
8. import file to the database from __/private/database/sw_products.sql__
9. in browser, navigate to public folder of the project
10. Enjoy!

## Notes
* Composer for Classes autoloading
* Npm for scss + browserSync + gulp configuration
