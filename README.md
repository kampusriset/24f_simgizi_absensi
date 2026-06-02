# CREATE DATABASE db_absensi;

# USE db_absensi;

# CREATE TABLE penerima_manfaat (

# id_penerima INT AUTO_INCREMENT PRIMARY KEY,

# nama VARCHAR(100) );

# CREATE TABLE absensi (

# id_absensi INT AUTO_INCREMENT PRIMARY KEY,

# id_penerima INT,

# tanggal DATE,

# status_hadir ENUM('Hadir', 'Tidak Hadir'),

# CONSTRAINT fk_absensi_penerima

# FOREIGN KEY (id_penerima)

# REFERENCES penerima_manfaat(id_penerima)

# ON UPDATE CASCADE

# ON DELETE CASCADE );

# CREATE TABLE users (

# id_user INT AUTO_INCREMENT PRIMARY KEY,

# nama VARCHAR(100),

# username VARCHAR(50) UNIQUE,

# password VARCHAR(255) );
