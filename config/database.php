<?php
class Database {
    private static $host = "localhost";
    private static $db_name = "todo_mvc";
    private static $username = "root"; // XAMPP default
    private static $password = "";     // XAMPP default
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("DB Connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
