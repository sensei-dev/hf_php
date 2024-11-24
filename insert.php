<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbName = "books";

try {
    $dbcsatlakoz = mysqli_connect($servername, $username, $password, $dbName);

    if (!$dbcsatlakoz) {
        throw new Exception("Adatbázis kapcsolati hiba: " . mysqli_connect_error());
    }

    mysqli_set_charset($dbcsatlakoz, "utf8");

    if (isset($_POST['queryOption'])) {
        $queryType = $_POST['queryOption'];
        $authorName = isset($_POST['szerzoin']) ? mysqli_real_escape_string($dbcsatlakoz, $_POST['szerzoin']) : '';

        switch ($queryType) {
            case 'mindenkonyv': // 1. feladat: Minden könyv
                $result = mysqli_query($dbcsatlakoz, "SELECT * FROM books");
                echo "<table border='1'><tr><th>Cím</th><th>Író</th><th>Megjelenési év</th></tr>";
                while ($book = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$book['title']}</td><td>{$book['author']}</td><td>{$book['year']}</td></tr>";
                }
                echo "</table>";
                break;

            case 'egyirokonyvei': // 2. feladat: Egy író könyvei
                if (!empty($authorName)) {
                    $result = mysqli_query($dbcsatlakoz, "SELECT title, year FROM books WHERE author = '$authorName'");
                    echo "<table border='1'><tr><th>Cím</th><th>Megjelenési év</th></tr>";
                    while ($book = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>{$book['title']}</td><td>{$book['year']}</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Adja meg az író nevét!";
                }
                break;

            case 'legregebbikonyv': // 3. feladat: Legrégebbi könyv
                $result = mysqli_query($dbcsatlakoz, "SELECT title FROM books WHERE year = (SELECT MIN(year) FROM books)");
                $book = mysqli_fetch_assoc($result);
                echo "<p>A legrégebbi könyv: {$book['title']}</p>";
                break;

            case 'konyvek1950utan': // 4. feladat: 1950 utáni könyvek
                $result = mysqli_query($dbcsatlakoz, "SELECT title, author FROM books WHERE year > 1950");
                echo "<table border='1'><tr><th>Cím</th><th>Író</th></tr>";
                while ($book = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$book['title']}</td><td>{$book['author']}</td></tr>";
                }
                echo "</table>";
                break;

           
        }
    }

    // 5. feladat: Új könyv mentése
    if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['year'])) {
        $title = mysqli_real_escape_string($dbcsatlakoz, $_POST['title']);
        $author = mysqli_real_escape_string($dbcsatlakoz, $_POST['author']);
        $year = mysqli_real_escape_string($dbcsatlakoz, $_POST['year']);

        $hozzaadas = "INSERT INTO books (title, author, year) VALUES ('$title', '$author', $year)";
        if (mysqli_query($dbcsatlakoz, $hozzaadas)) {
            echo "<p>A következő könyv sikeresen hozzáadva: $title</p>";
        } else {
            echo "<p>Hiba történt a könyv hozzáadása során! : " . mysqli_error($dbcsatlakoz) . "</p>";
        }
    }

} catch (Exception $error) {
    echo $error->getMessage();
}

?>
