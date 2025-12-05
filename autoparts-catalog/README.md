<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

```markdown
# AutoParts Catalog — Інструкція запуску (локально)

Коротко: цей проєкт — веб-каталог товарів на Laravel з можливістю керування товарами та категоріями, кошиком і обраним (wishlist). Нижче наведено покрокову інструкцію для запуску під Windows (PowerShell).

## Вимоги
- PHP 8.1+ (встановіть відповідну версію)
- Composer
- Node.js + npm
- СУБД: MySQL / MariaDB або SQLite
- Розширення PHP: `pdo`, `mbstring`, `openssl`, `fileinfo`, `json`, `tokenizer`, `xml`

## Швидкий старт (PowerShell)

1) Клон/копія проекту на локальну машину (якщо ще не скопійовано).

2) Встановити залежності PHP:

```powershell
cd C:\laragon\www\autoparts-catalog
composer install --no-interaction --prefer-dist
```

3) Встановити залежності Node:

```powershell
npm install
```

4) Створити файл налаштувань `.env` (скопіювати від `.env.example` якщо є) і налаштувати з'єднання з базою:

```powershell
copy .env.example .env
# Відредагуйте .env у вашому текстовому редакторі (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
```

5) Згенерувати ключ додатку:

```powershell
php artisan key:generate
```

6) Запустити міграції та сидери (створити структуру БД та тестові дані):

```powershell
php artisan migrate --seed
```

Якщо бажаєте використати SQLite для швидкої локальної перевірки, створіть файл `database/database.sqlite` і в `.env` вкажіть `DB_CONNECTION=sqlite`.

7) Збірка фронтенду (Vite + Tailwind)

- Для розробки (гарячий перезапуск):

```powershell
npm run dev
```

- Для продакшен-білду (генерує `public/build`):

```powershell
npm run build
```

8) Запуск локального сервера:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
# Відкрийте http://127.0.0.1:8000
```

## Ключові моменти реалізації (що реалізовано в коді)
- MVC: моделі `Product`, `Category`, `User`, контролери `ProductController`, `CategoryController`, `WishlistController`, `CartController`, адмін-контролери `AdminProductController`, `AdminCategoryController`.
- Ресурсні маршрути для адмін-CRUD: налаштовано в `routes/web.php` (адмін — `Route::resource(...)`).
- Авторизація: використано стандартні контролери/роути у `routes/auth.php` (схожа структура до Laravel Breeze);
- Ролі: у `app/Models/User.php` є поле `role` та метод `isAdmin()`; middleware `IsAdmin` реалізовано у `app/Http/Middleware/IsAdmin.php`.
- Пагінація: у `ProductController@index` використовується `paginate(12)` і у view — `{{ $products->links() }}`.
- Пошук/фільтри: `ProductController@index` обробляє `category`, `price_from`, `price_to`, `search`.
- Адмін: `AdminProductController` та `AdminCategoryController` реалізують валідацію, завантаження зображень у `Storage::disk('public')`, видалення зображень.
- Wishlist & Cart: AJAX-логіка реалізована в `resources/views/layouts/app.blade.php` (перехоплення форм, оновлення кількостей без перезавантаження).

## Створення адміністратора (швидко)
1) Через сидер: якщо в репозиторії є `UserSeeder`, він може створити користувача з роллю `admin` при `php artisan db:seed`.
2) Через Tinker:

```powershell
php artisan tinker
>>> \App\Models\User::create(['name'=>'Admin','email'=>'admin@example.com','password'=>bcrypt('password'),'role'=>'admin']);
```

## Тестування
- Запуск тестів (якщо є тести):

```powershell
vendor\bin\phpunit
```

## Рекомендації по деплою
- Налаштуйте `APP_ENV=production`, використайте `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`.
- Забезпечте, щоб директорія `storage` і `bootstrap/cache` були записуваними.

## Git та публікація на GitHub
Якщо хочете, я можу ініціалізувати git та додати початковий коміт, наприклад:

```powershell
git init
git add .
git commit -m "Initial import of AutoParts Catalog"
# Далі створіть репозиторій на GitHub і додайте remote, потім:
git remote add origin https://github.com/yourname/repo.git
git push -u origin main
```

## Додаткові примітки
- Якщо ви хочете, щоб я також виконав `npm run build` іниціалізував git — скажіть.
- Якщо потрібно — згенерую `docs/report.md` та просту презентацію.

---

Якщо потрібні правки в README (додати інструкції для Docker, або додати скріншоти), скажіть які саме розділи додати — я внесу.

```
If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
