# Einfaches PHP-Blog-System (mit XAMPP)

Ein einfaches Blog-System, das mit **PHP**, **MySQL** und **AJAX** gebaut wurde. 

## Funktionen

- Beiträge erstellen, anzeigen und aktualisieren  
- AJAX-Suchfunktion  
- Sauberes, responsives Design mit CSS  
- Sicher mit PDO und prepared statements  

## Voraussetzungen

- [XAMPP](https://www.apachefriends.org/download.html) installiert  
- PHP & MySQL laufen über XAMPP Control Panel  
- Ein Browser deiner Wahl  

## Installation & Einrichtung (lokal mit XAMPP)

1. Projektordner in `C:\xampp\htdocs\dein-projektname` kopieren  
2. XAMPP starten (Apache & MySQL)  
3. Im Browser `http://localhost/dein-projektname/setup.php` öffnen, um die Datenbanktabellen anzulegen  
4. Im Browser `http://localhost/dein-projektname/` öffnen  

## Datenbank-Konfiguration (XAMPP)

Dieses Projekt nutzt MySQL als Datenbank, die über XAMPP läuft. Standardmäßig sind die Zugangsdaten bei XAMPP wie folgt:

- **Host:** `localhost`  
- **Benutzer:** `root`  
- **Passwort:** (leer)  

### Schritte zur Einrichtung

1. Starte XAMPP und aktiviere **Apache** und **MySQL** über das Control Panel.  
2. Öffne im Browser [http://localhost/phpmyadmin](http://localhost/phpmyadmin).  
3. Erstelle eine neue Datenbank, z.B. `mini_blog`.  
4. ändere den Name von db_example.php zu db.php

    ```php
    $dbname = 'mini_blog'; // Name deiner angelegten Datenbank
    ```

6. Benutzername und Passwort kannst du bei Standard-XAMPP so lassen:  

    ```php
    $user = 'root';
    $pass = '';
    ```

7. Speichere die Datei und starte das Projekt im Browser mit:  

    ```
    http://localhost/dein-projektname/
    ```

## 🔐 Benutzerregistrierung & Login

Dieses Blog-System enthält ein eigenes Login-System mit Benutzer-Registrierung.

### Funktionen:

- ✅ Benutzer können sich selbst registrieren (`register.php`)  
- ✅ Nach erfolgreichem Login wird eine Session erstellt  
- ✅ Nur eingeloggte Benutzer können:  
  - neue Beiträge erstellen (`post.php`)  
  - bestehende Beiträge bearbeiten (`update_Blog.php`)  

### Registrierung & Anmeldung

1. **Registrieren:**  
   Gehe zu [`register.php`](http://localhost/dein-projektname/register.php)  
   → Benutzername und Passwort eingeben  

2. **Anmelden:**  
   Gehe zu [`login.php`](http://localhost/dein-projektname/login.php)  
   → Nach Login wirst du zur Startseite weitergeleitet  

3. **Abmelden:**  
   Über [`logout.php`](http://localhost/dein-projektname/logout.php)
