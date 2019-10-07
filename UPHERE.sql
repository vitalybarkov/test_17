-- install php 7+
-- install composer 1.9+
-- install postgres 12+

-- install laravel 2+
-- install angular 8+

-- create the database appvb by the next line without the comments
--CREATE DATABASE appvb;

-- next open up the .env file of the BACKEND, and edit this fields for your database settings:
--DB_CONNECTION=pgsql
--DB_HOST=127.0.0.1
--DB_PORT=5432
--DB_DATABASE=appvb
--DB_USERNAME=postgres
--DB_PASSWORD=root

-- than change to BACKEND folder, and execute 'php artisan migrate' for the database migration

-- than connect to appvb database and insert this genres in to the table named genres
INSERT INTO genres (name) VALUES ('Drama');
INSERT INTO genres (name) VALUES ('Comedy');
INSERT INTO genres (name) VALUES ('Action');

-- after that go up the servers: 'php artisan serve' for BACKEND, and 'ng serve' for FRONTEND
-- after that check the http://localhost:8000 for some data response
-- then open the http://localhost:4200 and the app will start
-- after that you can add some movie by the ADD MOVIE button
-- also available the search field by the Enter key