# Movie Database – PHP + MySQL Web Application

University assignment: public movie database with admin-only CRUD, search, and security measures.

---

## 1. Link to your web application hosted on the server

**Live application:** [Add your hosted URL here]

*Example: `https://yourdomain.com/movie_app/public/` or `http://your-server-ip/movie_app/public/index.php`*

---

## 2. Login credentials (if any)

| Field    | Value      |
|----------|------------|
| Username | `@dmin123` |
| Password | `@dmin123` |

**Note:** The username starts with `@` (at sign). Use **Login** (top-right) to add, edit, or delete movies.

---

## 3. Link to your GitHub Repository

**Repository:** [Add your GitHub repository URL here]

*Example: `https://github.com/yourusername/movie_app`*

---

## 4. Set up instructions (if any)

### Requirements

- **XAMPP** (or PHP 7.4+ and MySQL/MariaDB)
- Apache and MySQL running

### Steps

1. **Place the project**  
   Put the project folder under your web root (e.g. `C:\xampp\htdocs\movie_app`).

2. **Create the database**  
   - Open **phpMyAdmin** (`http://localhost/phpmyadmin`)  
   - Import **`cinema_db.sql`** from the project root  
   - Or run:
     ```bash
     C:\xampp\mysql\bin\mysql -u root < "C:\xampp\htdocs\movie_app\cinema_db.sql"
     ```
   This creates `cinema_db`, tables `admin` and `movies`, sample data, and the admin user.

3. **Database connection**  
   Edit **`config/db.php`** if needed:
   - Host: `localhost`
   - Database: `cinema_db`
   - User: `root`
   - Password: *(empty by default)*

4. **Open the application**  
   In the browser:
   ```
   http://localhost/movie_app/public/index.php
   ```
   Replace `movie_app` with your folder name if different.

---

## 5. List of features implemented in your website

### Core

- **Public movie list** – View movies (title, genre, release year, rating, actors) without login.
- **Admin-only CRUD** – Add, Edit, Delete visible and working only after admin login.
- **Login / Logout** – Session-based admin auth; password checked with `password_verify()`.

### Search (requirement 4.3)

- **Simple search** – Search by title or keyword (matches title, genre, or actors).
- **Advanced search** – Filters: genre (category), year range (from/to), rating range (from/to).
- **AJAX search** – Results update as you type (autocomplete) and when using advanced filters; no full page reload; uses `fetch()` and JSON.

### Security (requirement 4.4)

- **SQL injection** – PDO prepared statements for all queries.
- **XSS** – All output escaped with `htmlspecialchars()` (and JS escaping for AJAX content).
- **Form validation** – Client-side (required, min/max, maxlength) and server-side (length and range checks).
- **Sessions** – Used for admin authentication.
- **CSRF** – Token on Add, Edit, and Delete. Delete accepts **POST only** with CSRF; invalid or GET requests are rejected.
- **File uploads** – Not used; validation N/A.

### UI/UX

- Dark theme, minimal layout, custom CSS (no Bootstrap/Tailwind).
- Responsive layout for smaller screens.
- Clear labels for simple and advanced search.

---

## 6. Known issues / bugs (if any)

- **None** for the scope of this assignment.

*Optional:* If the app runs in a subfolder, the URL will include the folder path (e.g. `/movie_app/public/`). For a shorter URL, set the web server document root to the `public` folder.

---

## 7. Screenshots of your UI / Pages

*Add your screenshots below. You can place image files in a `screenshots/` folder and reference them like: `![Description](screenshots/filename.png)`*

### Home / Movie list (public view)

![Home – Movie list](screenshots/home.png)

*Replace with your screenshot. Public users see the movie table and Login button; no Add/Edit/Delete.*

---

### Login page

![Admin Login](screenshots/login.png)

*Replace with your screenshot. Admin login form (username and password).*

---

### Movie list (after login – admin view)

![Movie list – Admin view](screenshots/home-admin.png)

*Replace with your screenshot. After login: Add, Edit, Delete, and Logout are visible.*

---

### Add Movie

![Add Movie](screenshots/add.png)

*Replace with your screenshot. Form to add a new movie (title, genre, year, rating, actors).*

---

### Edit Movie

![Edit Movie](screenshots/edit.png)

*Replace with your screenshot. Form to edit an existing movie.*

---

### Search (simple + advanced)

![Search](screenshots/search.png)

*Replace with your screenshot. Simple search box and expanded Advanced Search (genre, year range, rating range).*

---

*To add screenshots: create a `screenshots` folder in the project root, save your images (e.g. `home.png`, `login.png`), and update the paths above. For a PDF, export this README to PDF and ensure the images are included.*
