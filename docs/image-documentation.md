# Dokumentacija modula za slike

## 1. Uvod

Ovaj dokument opisuje nacin na koji se slike koriste u projektu **Perfuse**. Fokus je na vezi izmedju baze podataka, Laravel modela, kontrolera i Blade prikaza u kojima se slike proizvoda prikazuju krajnjem korisniku.

Dokumentacija je napravljena na osnovu trenutne implementacije u projektu i obuhvata:

- cuvanje putanje slike u bazi
- povezivanje slike sa proizvodom
- izbor glavne slike proizvoda
- prikaz slika na shop stranici
- prikaz slika na stranici detalja proizvoda
- prikaz slika u korpi
- prikaz statickih slika u korisnickom interfejsu

---

## 2. Struktura baze podataka za slike

Slike se cuvaju u tabeli `images`. Svaki zapis predstavlja jednu sliku koja pripada tacno jednom proizvodu.

Polja koja su najvaznija:

- `id` - jedinstveni identifikator slike
- `path` - putanja do slike
- `is_main_image` - oznacava da li je slika glavna
- `product_id` - strani kljuc koji povezuje sliku sa proizvodom

Relevantna migracija:

- [2027_03_29_103800_create_images_table.php](/c:/Users/Kristijan/Desktop/Perfuse/database/migrations/2027_03_29_103800_create_images_table.php)

Moguce je da jedan proizvod ima vise slika, ali je ideja sistema da se jedna od njih koristi kao glavna slika za osnovni prikaz proizvoda.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 1                             |
|      Prikaz strukture tabele images iz baze podataka         |
|      (ovde ubaciti screenshot tabele ili migracije)          |
+--------------------------------------------------------------+
```

---

## 3. Eloquent relacije

Relacija izmedju proizvoda i slika definisana je kroz Laravel modele:

- jedan `Product` ima vise slika
- jedna `Images` instanca pripada jednom proizvodu

Relevantni fajlovi:

- [Product.php](/c:/Users/Kristijan/Desktop/Perfuse/app/Models/Product.php)
- [Images.php](/c:/Users/Kristijan/Desktop/Perfuse/app/Models/Images.php)

U modelu `Product` koristi se metoda `images()` sa `hasMany`, dok se u modelu `Images` koristi metoda `product()` sa `belongsTo`.

To omogucava da se za jedan proizvod ucitaju sve njegove slike i da se po potrebi pronadje glavna slika.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 2                             |
|      Dijagram relacije Product 1:N Images                    |
|      (ovde ubaciti ER dijagram ili screenshot modela)        |
+--------------------------------------------------------------+
```

---

## 4. Ucitavanje slika u kontroleru

Kontroler `PageController` koristi eager loading kako bi zajedno sa proizvodom ucitao i njegove slike.

Najvazniji primeri su:

- metoda `productDetails()` ucitava `images` zajedno sa brendom, tipom vode, popustom i militrazama
- metoda `cart()` ucitava slike proizvoda koji se nalaze u korpi korisnika

Relevantan fajl:

- [PageController.php](/c:/Users/Kristijan/Desktop/Perfuse/app/Http/Controllers/PageController.php)

Na ovaj nacin prikazi ne moraju naknadno da salju dodatne upite za svaku sliku, sto pojednostavljuje logiku i poboljsava efikasnost.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 3                             |
|      Screenshot dela kontrolera gde se ucitavaju images      |
|      (PageController eager loading primer)                   |
+--------------------------------------------------------------+
```

---

## 5. Glavna slika proizvoda

U projektu postoji logika po kojoj se za prikaz proizvoda najpre trazi slika cije je polje `is_main_image` postavljeno na `true`. Ako takva slika ne postoji, koristi se prva dostupna slika iz kolekcije.

Ovakav pristup se vidi na vise mesta:

- na stranici detalja proizvoda
- u korpi
- u komponentama koje prikazuju proizvod

Prednost ovakvog resenja je sto svaki proizvod moze imati vise slika, ali interfejs i dalje zna koju sliku treba prikazati kao primarnu.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 4                             |
|      Prikaz logike za izbor glavne slike                     |
|      (is_main_image ili prva slika iz kolekcije)             |
+--------------------------------------------------------------+
```

---

## 6. Prikaz slika na shop stranici

Na shop stranici korisnik vidi listu proizvoda. Svaki proizvod ima karticu sa osnovnim informacijama i slikom.

Relevantni fajlovi:

- [shop.blade.php](/c:/Users/Kristijan/Desktop/Perfuse/resources/views/pages/user/shop.blade.php)
- [product-item.blade.php](/c:/Users/Kristijan/Desktop/Perfuse/resources/views/components/user/shop-layout/product-item.blade.php)

U ovom delu sistema slike imaju dve uloge:

- dekorativna naslovna slika sekcije shop
- prikaz slike svakog pojedinacnog proizvoda u listi proizvoda

Shop stranica koristi i staticku pozadinsku sliku za hero sekciju, dok komponenta proizvoda prikazuje sliku artikla unutar kartice.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 5                             |
|      Screenshot shop stranice sa hero slikom                 |
|      i listom proizvoda                                      |
+--------------------------------------------------------------+
```

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 6                             |
|      Uvecan prikaz jedne product kartice                     |
|      sa mestom gde se prikazuje slika proizvoda              |
+--------------------------------------------------------------+
```

---

## 7. Prikaz slika na stranici detalja proizvoda

Stranica detalja proizvoda predstavlja najkompletniju upotrebu slika u projektu.

Relevantan fajl:

- [productDetails.blade.php](/c:/Users/Kristijan/Desktop/Perfuse/resources/views/pages/user/productDetails.blade.php)

Na ovoj stranici postoje dve vrste prikaza:

- glavna velika slika proizvoda
- galerija dodatnih slika istog proizvoda

Ako proizvod nema nijednu sliku, sistem prikazuje zamenski blok sa tekstom `Nema slike`. Ako nema dodatnih slika, ispisuje se poruka da dodatne slike nisu dostupne.

Ovo je dobro resenje zato sto korisnicki interfejs ostaje stabilan i kada podaci nisu kompletni.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 7                             |
|      Screenshot product details stranice                     |
|      sa glavnom slikom proizvoda                             |
+--------------------------------------------------------------+
```

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 8                             |
|      Screenshot galerije dodatnih slika                      |
|      ispod glavne slike                                      |
+--------------------------------------------------------------+
```

---

## 8. Prikaz slika u korpi

U korpi se za svaki proizvod prikazuje umanjena verzija glavne slike.

Relevantan fajl:

- [cart.blade.php](/c:/Users/Kristijan/Desktop/Perfuse/resources/views/pages/user/cart.blade.php)

Logika je slicna kao na stranici detalja:

- prvo se pokusava pronaci glavna slika
- ako glavna slika ne postoji, koristi se prva dostupna
- ako slika ne postoji uopste, prikazuje se placeholder sa tekstom `Nema slike`

Na ovaj nacin korisnik i u korpi jasno vidi koji proizvod je izabrao.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 9                             |
|      Screenshot korpe sa prikazom slike proizvoda            |
+--------------------------------------------------------------+
```

---

## 9. Staticke slike u korisnickom interfejsu

Pored slika koje dolaze iz baze, projekat koristi i staticke slike iz foldera `public/images`.

Takve slike se koriste za:

- hero sekciju na pocetnoj stranici
- promotivne kartice
- pojedine dekorativne delove shop stranice

Relevantni fajlovi:

- [home.blade.php](/c:/Users/Kristijan/Desktop/Perfuse/resources/views/pages/user/home.blade.php)
- [shop.blade.php](/c:/Users/Kristijan/Desktop/Perfuse/resources/views/pages/user/shop.blade.php)
- [app.css](/c:/Users/Kristijan/Desktop/Perfuse/resources/css/app.css)

Ove slike nisu vezane za konkretan proizvod iz baze, vec sluze za vizuelni identitet sajta.

### Mesto za sliku

```text
+--------------------------------------------------------------+
|                          SLIKA 10                            |
|      Screenshot pocetne ili shop stranice                    |
|      gde se vidi upotreba statickih slika                    |
+--------------------------------------------------------------+
```

---

## 10. Zakljucak

Sistem za slike u projektu Perfuse zasniva se na jednostavnoj i preglednoj organizaciji:

- slike se cuvaju u posebnoj tabeli
- svaka slika pripada jednom proizvodu
- jedan proizvod moze imati vise slika
- jedna slika moze biti oznacena kao glavna
- slike se koriste u vise delova aplikacije: shop, detalji proizvoda, korpa i staticke sekcije sajta

Najvaznija prednost ovakvog pristupa je fleksibilnost. Sistem podrzava vise slika po proizvodu, a istovremeno omogucava jednostavan izbor glavne slike za prikaz korisniku.

U slucaju da slike nisu dostupne, interfejs i dalje ostaje funkcionalan zahvaljujuci zamenskim blokovima i rezervnoj logici za prikaz.
