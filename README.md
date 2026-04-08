**Info o projektu**
- Projekat nema try catch u controlerima jer koristi global error handler definisan u app.php unutar bootstrap foldera
- Sve greske u aplikaciji se loguju u storage/logs/error.php
- Dosta stvari/funkcionalnosti je jos moglo da se doda: mailer za potvrdu naloga i mogucnosti restarta sifre, mogucnosti filtiranja i sortiranja u admin panelu, mailer za obavestavanje korisnika da je order uspesan, opcija da korisnik moze da edituje svoje podatke, mogucnost da admin odgovori na submitane contact forme, takodje nema confirmation pop-up-a kada se radi opcija brisanja u admin panelu itd...
- U components folderu unutar views bi trebalo da se nalazne rasparcane componente koji cine svaku stranicu, npr views/components/user/home-layout/thumbnail.blade.php pa views/components/user/home-layout/gadgets.php i tako svaki section jedne stranice bude podeljen na componente

**Kredencijali**
- Admin: email: krimster8@gmail.com password: cao123

**For starting the project you need:**

- Composer version 2.8.12 
- MYSQL database
- Web server (Apache)
- Node.js v22.21.0. (Using tailwind for styling)



**Steps to successfuly structure the project:**

Clone the project: git clone https://github.com/Kristijan-web/Perfuse.git

1. cp .env.example .env

2. Edit next env variables to be:

- DB_DATABASE=perfuse
- DB_CONNECTION=mysql
- SESSION_DRIVER=file
- Uncomment next variables:
- DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=

3. Run: composer install

4. Run: npm install

5. Run: php artisan key:generate

6. Run: php artisan migrate:fresh --seed (Sometimes the certain factory makes 2 same id's for 2 diffrent columns in table that has their combination set as unique, so if that happens run migration again untill the seeding is successful)



**To run the project:**

- php artisan serve
- npm run dev



**Dokumentacija**

- Dokumtacija se nalazi u footeru sajta i u public folderu 

