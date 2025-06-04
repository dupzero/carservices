# Autó Szerviz Applikáció (Laravel alapú)

Ez az alkalmazás egy szerviz nyilvántartó rendszer alapja Laravelben, amely kezeli az ügyfeleket, járműveiket, valamint a hozzájuk kapcsolódó szervizszolgáltatásokat.

## Verziók

| Komponens | Verzió |
|-----------|--------|
| PHP       | 8.3    |
| Laravel   | 12.x   |
| Livewire  | 3.x    |
| MySQL     | 8.x    |
| Composer  | 2.x    |
| Node.js   | 18.x   |
| NPM       | 9.x    |

## Telepítési lépések

1. **Repository klónozása vagy kicsomagolása**  
   Helyezd a projektet egy Laravel-kompatibilis könyvtárba (pl. `htdocs`, `valet`, `laragon` stb.).

2. **Függőségek telepítése**  
   ```
   composer install
   npm install
   npm run dev
   ```

3. **.env fájl beállítása**  
   Másold az `.env.example` fájlt `.env` néven:
   ```
   cp .env.example .env
   ```

   Ezután szerkeszd az alábbiakat:
   APP_NAME="CarServices"  
   APP_URL=https://localhost:8000

   DB_CONNECTION=mysql  
   DB_HOST=127.0.0.1  
   DB_PORT=3306  
   DB_DATABASE=carservices  
   DB_USERNAME=root  
   DB_PASSWORD=

4. **Kulcs generálása**
   ```
   php artisan key:generate
   ```

5. **Migrációk futtatása**
   ```
   php artisan migrate
   ```

6. **Alkalmazás indítása**
   ```
   php artisan serve
   ```

   Az alkalmazás ezután elérhető lesz a https://localhost:8000 címen.

## Mappa struktúra

- `app/` – alkalmazás logika  
- `database/migrations/` – migrációs fájlok  
- `database/seeders/seeds` – .json fájlok az adatbázis feltöltéséhez  
- `database/database_export` – adatbázis szerkezeti export PHPStorm-al generálva  
- `resources/views/` – blade nézetek, Livewire komponensek
- `routes/web.php` – útvonalak  
- `public/` – publikus elérési pont  
- `README.md` – dokumentáció
