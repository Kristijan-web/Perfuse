**Info o projektu**
- AI se najvise koristio za generisanje view-a to jest html-a i tailwind-a i ponekad za popunjavanje view-a u odnosu na podatke koje prosledjuje metoda u kontroleru, takodje je koriscen za sintaksu i to ako nisam siguran da li je naziv metode array_in ili in_array ili da li se greska iz $errors uzima sa $errors->get() ili $errors->use() itd... ne da mi generise celu logiku, i takodje kada ja napravim svoju logiku onda proverim sa AI-em da vidim da li je mozda njegova bolja i onda ako sam je razumeo primenim njegovu
- Projekat nema try catch u controlerima jer koristi global error handler definisan u app.php unutar bootstrap foldera
- Sve greske u aplikaciji se loguju u storage/logs/error.php
- Dosta stvari/funkcionalnosti je jos moglo da se doda: mailer za potvrdu naloga i mogucnosti restarta sifre, mogucnosti filtiranja i sortiranja u admin panelu, mailer za obavestavanje korisnika da je order uspesan, opcija da korisnik moze da edituje svoje podatke, mogucnost da admin odgovori na submitane contact forme, takodje nema confirmation pop-up-a kada se radi opcija brisanja u admin panelu itd, na vise mesta nema modala koji prikazuju poruku za success ili fail itd...
- U components folderu unutar views bi trebalo da se nalazne rasparcane componente koji cine svaku stranicu, npr views/components/user/home-layout/thumbnail.blade.php pa views/components/user/home-layout/gadgets.php i tako svaki section jedne stranice bude podeljen na componente



**Kredencijali**

- Admin: email: krimster8@gmail.com password: cao123



**Za pokretanje projekta je potrebno imati sledeci softver**

- Composer version 2.8.12 
- MYSQL database
- Web server (Apache)
- Node.js v22.21.0. (Using tailwind for styling)



**Koraci da bi se strukturisao projekat za pokretanje**

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

6. Run: php artisan migrate:fresh --seed (Ponekad se desi da factory generise iste id-jeve za dve razlicite kolone u tabeli gde je njihova kombinacija postavljena kao unique, pa ako se to desi, ponovo pokrenuti migracije sve dok se seedovanje uspesno ne izvrsi.)



**Da bi se pokrenuo projekat:**

- php artisan serve
- npm run dev



**Dokumentacija**

- Dokumtacija se nalazi u footeru sajta i u public folderu 

