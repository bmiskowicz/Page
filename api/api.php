<!DOCTYPE html>
<html lang="pl" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <title>PHP - RESTful Web Services</title>
    </head>
    <body>


        <div>
        <h2>Wszyscy użytkownicy</h2>
        </div>
        <div id="formularz">
        <form action="get.php" method="GET">
        <input type="submit" name="pokaz" id="przycisk" value="Pokaż użytkowników" />
        </form>
        </div>


        <br /><hr/>
        <div>
        <h2>Znajdź użytkownika</h2>
        </div>
        <div id="formularz">
            <form action="get.php" method="GET">
                <label for="imie">Imie:</label>
                <input type="text" name="imie" size=20 maxsize=20 required /><br />
                <label for="nazwisko">Nazwisko:</label>
                <input type="text" name="nazwisko" size=20 maxsize=20 required /><br />
                <input type="submit" name="znajdz" id="przycisk" value="Znajdź użytkownika"/>
            </form>
        </div>


        <br /><hr />
        <div>
        <h2>Dodaj użytkownika</h2>
        </div>
        <div id="formularz">
            <form action="post.php" method="POST">
                <label for="fName">Imie:</label>
                <input type="text" name="fName" size=20 maxsize=30 required /><br />

                <label for="lName">Nazwisko:</label>
                <input type="text" name="lName" size=20 maxsize=30 required /><br />

                <label for="email">Email:</label>
                <input type="email" name="email" size=20 maxsize=50 required /><br />

                <label for="uName">Nazwa użytkownika:</label>
                <input type="text" name="uName" size=20 maxsize=30 required /><br />

                <label for="pass">Hasło:</label>
                <input type="password" name="pass" size=20 maxsize=50 required /><br />

                <label for="rpass">Powtórzone hasło:</label>
                <input type="password" name="rpass" size=20 maxsize=50 required /><br />

                <input type="submit" name="dodaj" id="przycisk" value="Dodaj użytkownika" />
            </form>
        </div>

        
        <br /><hr />
        <div>
        <h2>Edytuj użytkownika</h2>
        </div>
        <div id="formularz">
            <form action="update.php" method="POST">

                <label for="id">ID:</label>
                <input type="text" name="id" size=20 maxsize=30 required /><br />

                <label for="fName">Imie:</label>
                <input type="text" name="fName" size=20 maxsize=30 required /><br />

                <label for="lName">Nazwisko:</label>
                <input type="text" name="lName" size=20 maxsize=30 required /><br />

                <label for="email">Email:</label>
                <input type="email" name="email" size=20 maxsize=50 required /><br />

                <label for="uName">Nazwa użytkownika:</label>
                <input type="text" name="uName" size=20 maxsize=30 required /><br />

                <label for="pass">Hasło:</label>
                <input type="password" name="pass" size=20 maxsize=50 required /><br />

                <label for="rpass">Powtórzone hasło:</label>
                <input type="password" name="rpass" size=20 maxsize=50 required /><br />

                <input type="submit" name="edytuj" id="przycisk" value="Edytuj użytkownika" />
            </form>
        </div>


        <br /><hr />
        <div>
        <h2>Usuń użytkownika</h2>
        </div>
        <div id="formularz">
            <form action="delete.php" method="POST">
                <label for="id">ID:</label>
                <input type="id" name="id" size=20 maxsize=50 required /><br />

                <input type="submit" name="usuń" id="przycisk" value="Usuń użytkownika" />
            </form>
        </div>

    </body>
</html>
