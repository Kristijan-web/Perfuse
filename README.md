
**For starting the project you need:**

- Composer version 2.8.12 
- MYSQL database
- Web server (Apache)
- Node.js v22.21.0. (Using tailwind for styling)

Steps:

Clone the project: git clone https://github.com/Kristijan-web/Perfuse.git

1. cp .env.example .env

2. Edit next env variables to be:

- DB_DATABASE=perfuse
- DB_CONNECTION=mysql
- SESSION_DRIVER=file
- Uncomment:
 DB_PORT=3306
 DB_DATABASE=laravel
 DB_USERNAME=root
 DB_PASSWORD=

3. Run: composer i 

4. Run: npm install

5. Run: php artisan key:generate

6. Run: php artisan migrate:fresh --seed (Sometimes the certain factory makes 2 same id's for 2 diffrent columns in table that has their combination set as unique, so if that happens run migration again untill the seeding is successful)

To run the project: 

- php artisan serve
- npm run dev


Dokumentacija

- Dokumtacija se nalazi u footeru sajta


