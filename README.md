# Movie Database Web Application

## 1. Project Description

This project is a PHP and MySQL based Movie Database Web Application developed as part of a college assignment. The application allows public users to view movie information, while authenticated admin users can manage movie records.

The system is deployed on the Herald College student server and demonstrates CRUD operations, search functionality, Ajax usage, and basic web security practices.

---

## 2. Live Application Link

(https://student.heraldcollege.edu.np/~np03cs4s250044/movie_app/public/index.php)
---

## 3. Login Credentials

**Admin Login**

* Username: `admin`
* Password: `@dmin123`

Public users can view movie information without logging in.

---

## 4. Technologies Used

* PHP
* MySQL
* HTML5
* CSS3
* JavaScript (Ajax / Fetch API)

---

## 5. Features Implemented

* Public movie listing
* Admin login using session-based authentication
* Add new movies
* Edit existing movies
* Delete movies with confirmation
* Simple search by title or keyword
* Advanced search by:

  * Genre
  * Year range
  * Rating range
* Ajax-based live search without page reload
* Security features:

  * Prepared statements for SQL injection prevention
  * Output escaping for XSS prevention
  * CSRF token implementation for delete operation

---

## 6. Setup Instructions

1. Import the provided SQL file into a MySQL database.
2. Upload the project folder to the server's `public_html` directory.
3. Update database credentials in `config/db.php`.
4. Access the application using the hosted URL.

---

## 7. GitHub Repository

(https://github.com/Mandip-xd/movie_app) 
Sensitive files such as database credentials and SQL files are excluded from the repository for security reasons.

---

## 8. Known Issues / Bugs

None.

---

## 9. Notes

This project is designed to meet all assignment requirements including CRUD operations, Ajax integration, and basic security measures. The folder structure follows the recommended guidelines provided in the course assessment.
