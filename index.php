<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Könyvkezelés_BallaBenedek12bsz</title>
</head>
<body>

    <!-- Új könyv felvétele -->
    <h2>Új könyv felvétele</h2>
    <form action="process.php" method="POST">
        <label for="bookTitle">Könyv címe:</label><br>
        <input type="text" id="bookTitle" name="bookTitle" required><br><br>
        
        <label for="bookAuthor">Író neve:</label><br>
        <input type="text" id="bookAuthor" name="bookAuthor" required><br><br>

        <label for="publicationYear">Megjelenési év:</label><br>
        <input type="number" id="publicationYear" name="publicationYear" required><br><br>

        <input type="submit" value="Hozzáadás">
    </form> <br>

    <!-- Adatlekérdezések -->
    <h2>Kérdezzen le adatokat</h2>
    <form action="process.php" method="POST">
        <label for="queryyy">Válasszon lekérdezést:</label><br>
        <select name="queryyy" id="queryyy">
            <option value="mindenkonyv">Minden könyv</option>
            <option value="egyirokonyvei">Egy író könyvei</option>
            <option value="legregebbikonyv">Legrégebbi könyv</option>
            <option value="konyvek1950utan">1950 utáni könyvek</option>
        </select><br><br>

        <!-- Ha egy író neve szükséges, itt lehet megadni -->
        <div id="szerzoid" style="display:none;">
            <label for="szerzonev">Író neve:</label><br>
            <input type="text" id="szerzonev" name="szerzonev"><br><br>
        </div>

        <input type="submit" value="Futtatás">
    </form>

    <script>
        // Író nevének mezője csak bizonyos lekérdezés esetén jelenik meg
        document.getElementById('queryyy').addEventListener('change', function() {
            const szerzoid = document.getElementById('szerzoid');
            if (this.value === 'authorBooks') {
                szerzoid.style.display = 'block';
            } else {
                szerzoid.style.display = 'none';
            }
        });
    </script>

</body>
</html>
