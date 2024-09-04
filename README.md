# Command cheat sheet

## Starten ohne Docker

-   `php artisan serve` um die Laravel Umgebung zu starten
-   `npm run dev` um die fehlenden Tailwind CSS Klassen zu beziehen

## Starten mit Docker

Es gibt auch eine Anleitung um einen shell alias zu setzen, somit ist die Pfad Angabe zu Sail nicht mehr notwendig [Dokumentation](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias)

-   `sail up` bzw. `./vendor/bin/sail up` um den Container zu starten
-   `sail up -d` bzw. `./vendor/bin/sail up -d ` um den Container detached zu starten
-   `sail npm run dev` bzw. `./vendor/bin/sail npm run dev` um Frontend im Container zu starten

# Einrichtung

-   `(sail )php artisan migrate`
-   `(sail )php artisan seed --class=RoleSeeder`
-   `(sail )php artisan seed --class=UserSeeder`
-   `(sail )php artisan seed --class=AlbumSeeder`
