CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    genre VARCHAR(100) NOT NULL,
    release_year INT NOT NULL,
    rating DECIMAL(3,1) NOT NULL,
    actors VARCHAR(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (username, password) VALUES
('@dmin123', '$2y$10$LYV5lNCkvIGN4bBvjZjD1u3hEsuGkRuwDByfl96t8T8MPB/zBydSm');

INSERT INTO movies (title, genre, release_year, rating, actors) VALUES
('The Shawshank Redemption', 'Drama', 1994, 9.3, 'Tim Robbins, Morgan Freeman'),
('The Dark Knight', 'Action', 2008, 9.0, 'Christian Bale, Heath Ledger'),
('Inception', 'Sci-Fi', 2010, 8.8, 'Leonardo DiCaprio, Joseph Gordon-Levitt'),
('Pulp Fiction', 'Crime', 1994, 8.9, 'John Travolta, Samuel L. Jackson'),
('Forrest Gump', 'Drama', 1994, 8.8, 'Tom Hanks, Robin Wright');
