#### To Run The project --

* Please configure MYSQL .env

* One issue I faced to connect MYSQL 8.0.15 and PHP 7.3.1 is ```caching_sha2_password``` so I altered this scheme using
```ALTER USER 'mysqlUsername'@'localhost' IDENTIFIED WITH mysql_native_password BY 'mysqlUsernamePassword';```, see for more detail https://stackoverflow.com/questions/50026939/php-mysqli-connect-authentication-method-unknown-to-the-client-caching-sha2-pa

* As mention I have used --
    * Mysql 8.0.15 (Installed using mysql-installer)
    * PHP 7.3.1 (Installed using Homebrew)
    * Laravel Framework 5.7.25 (Installed using Laravel Installer)
    * Laravel Charts (installed using composer)

* No need to create new Database Data :
    * Created Menu Table and bootload the menu data from web.php by calling function in Menu Model
    
    * Same Goes for the User, as told in assignment 3 user (Ram, Shyam and Ghanshyam) password is -- 'HelloWorld'
    
    * Created Some orders data for each user also bootload from web.php

* I have used Charts using Laravel Charts, please install this dependency from here - https://charts.erik.cat/installation.html#composer and find further instruction in same documentation.



#### Thing implemented in Project and worth mentioning

* The User (Login/Register) has been implemented using predefine laravel MVC and Auth Classes

* I restricted the after login pages (```/orders``` and ```view_report```) to be accessed as a guest User.

* Create Order Page/Form with 2-way (frontend and backend) validation, along with displaying validation error after compromised frontend validation. 

* Also added laravel @csrf method for form secure submission.

* There are 3 models -- Menu, Order and User, each with required Controller and Views, I have not created all resource methods but only required once.

* (Changes in Views) => There is addition welcome page in the start from right top you can login and register, after login this change to home button, which lead to Dashboard.

* I have used Eloquent for query, but just a beginner.

* Total Amount shown at ```Order``` page is not passed to server to store in database. As people can edit it from console for same ```(item, quantity)```, at production level it could cause major bug in system.

* Instant modification of Total Amount (Price) shown in cart, using EventListener in jquery. 


#### Things which needs to improve

* We can surely add Model Policies to restrict users from sneaking on others data. At this stage it's not possible because 

* Add better navigation at each view/page, to improve UX.

* I think all query are implemented in ```Order``` Model, it can be improved further, as I can't access linked ```User``` and ```Menu``` data queries from ```order``` class object using Eloquent ORM. Means, still have some bugs, or naive style.

* Comments, major part of coding style, but this task is pending...

* To create dummy database for testing, we can use Faker like classes.



P.S. This is my first Project in Laravel and first MVC framework, so it may be very naive implementation, took  8 days to learn the Laravel framework and code this assignment.