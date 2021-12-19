<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width" , initial-scale=1.0>
    <title>Sieć ładowarek</title>
    <link rel="stylesheet " href="style.css " />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="dane.json"></script>
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
    <div class="page">
        <?php if(isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h2>
                    <?php 
                    #echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h2>
            </div>
        <?php endif ?>
    

    <div>
        <header class="header1 " style="height:100px">
        <div class=logo>
                <img class="image" src="data/icon.svg"  style="width:100px;height:auto; position:absolute; margin-left:0px; padding-top:25px; padding-left:25px;"/>
        
        </div>
        <h1 id="naglowek" style=" line-height:100px; margin-right:auto; margin-left:auto;">Sieć ładowarek samochodowych!</h1>  
        </header>
    </div>


        
        <aside class="aside1">
                <div class="aktywna">
                    <h2 class="navigation-name">MENU</h2>
                    <div class="menu"></div>
                    <br/>
                    <div class="language"></div>
                </div>
                <section class="main-content">
                    <p id="strona-glowna"></p>
                    <script type="text/javascript">
                        loadMenu(languages, 'pl');
                    </script>
                </section>
                <section class="przekierowania">
                <?php
                if(!isset($_SESSION['username'])){
                ?>
                    <a href="login.php">   
                        <input type="button" id="buttonlogin" value="Zaloguj">                
                    </a>
                    </br> </br>
                    
                    <a href="register.php">   
                        <input type="button" id="buttonregister" value="Zarejestruj">                
                    </a>
                <?php
                }
                else{
                    ?>
                    </br> </br>
                    <a>Witaj </a>
                    <?php
                    echo $_SESSION['username']
                ?>    
                </br> </br>
                    <a href="logout.php">   
                        <input type="button" id="buttonlogout" value="Wyloguj">                
                    </a>
                <?php
                }
                ?>    
                </br> </br>
                </section>
        </aside>

        <div class="strona" id="oplaty">
            <script>
                pobierzOferty()
            </script>
            <table class="tabela1">
                <thead>
                    <tr>
                    <th colspan="6"><h3>Nasze taryfy</h3></th>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th>Taryfa</th>
                        <th>Opłata czasowa</th>
                        <th>Opłata mocowa</th>
                        <th>Maksymalna moc ładowania</th>
                        <th colspan="2">Cena netto/brutto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="data0" style="display:''"></tr>
                    <tr id="data1" style="display:''"></tr>
                    <tr id="data2" style="display:''"></tr>
                    <tr id="data3" style="display:''"></tr>
                    <tr id="data4" style="display: none;"></tr>
                    <tr id="data5" style="display: none"></tr>
                </tbody>
            </table>
                    <br>
            <center>
                <input type="button" class="przyciskpromocje" onclick="pokazOferty()" value="Pokaz / Ukryj promocje"class="button">
            </center>
            <br><br>


            <div class="dodatki">
                    <h2>Oblicz opłatę za ładowarkę</h2>
                    <br>
                <form action="index.php" method="POST">
                    
                    <label for="taryfy">Wybierz taryfę:</label>
                    <select name="wyborTaryf">
                        <option id="option0"></option>
                        <option id="option1"></option>
                        <option id="option2" selected="selected"></option>
                        <option id="option3"></option>
                        <option id="option4"></option>
                        <option id="option5"></option>
                        </select>
                    <br><br>

                    <label for="okres">Wybierz okres wypożyczenia(w miesiącach):</label>
                    <input type="text" name="okres" size=5 maxsize=5/>
                    <br><br>
                    <input type="submit" name="oblicz" id="przycisk" value="Oblicz" />
                </form>
                <br>

                <?php
                function Oblicz($data) {
                        $file = @fopen("cena.txt", "a");
                        fwrite($file, $data);
                        fclose($file);
                    }


                    if(isset($_POST["oblicz"])){
                        $dane = file_get_contents("dane.json");
                        $dane = json_decode($dane);
                        $pakiety = [];
                        foreach($dane as $d)
                        array_push($pakiety,get_object_vars($d));

                        $taryfa=$_POST["wyborTaryf"];
                        $okres=$_POST["okres"];

                        foreach($pakiety as $pakiet){
                            if($pakiet["taryfa"] == $taryfa){
                                $oplata = (int)$pakiet["cenab"];
                            }
                        }
                        
                        if ($okres < 1) $wynik = "Wybrano błędny okres";
                        else    
                        {
                            $wynik = $oplata * $okres;
                            $wynik1 = "Opłata dla taryfy " .$taryfa. " za okres " .$okres. " miesięcy wynosi: ";
                            $wynik2 =  $wynik . " zł";
                            echo "<br>" . $wynik1 . "<br><br>" . $wynik2 .   "</br></br>";

                            $wynik = $oplata * $okres;

                            $log = "\nTaryfa: " . $taryfa . ", okres: " . $okres .  ", cena: " . $wynik;
                            Oblicz($log);
                        }
                    }
                    ?>
            </div>

            <div class="graf">
                <?php


                    
                    if(isset($_SESSION['username'])) {
                        echo "<br> <h2>Graf popularności ofert</h2>";
                        require('./Controllers/Controller.php');
                    }
                    else {
                        echo "<br> Zaloguj się, aby zobaczyć graf popularności ofert";
                    }
                ?>
                <br><br>
                </div>
        </div>  
        
        <div class="strona" id="zdjecia">       
                <div class="galeria">
                    <h2>Ładowarki</h2>
                    <figure>
                        <img class="image" src="data/ladowarka.jpg " alt="Na zdjęciu znajduje się ładowarka z pierwszej oferty " style="width:90%; max-width:100%; height:auto; max-height:100%;"/>
                            <figcaption>Zdjęcie 1. Ładowarka</figcaption>
                    </figure>
                    <br/>
                </div>
        </div>

        <div class="strona" id="opinie">
            <div class="bordery">
            <h2>Opinie</h2>
                <div class="opinie ">
                <br>
                    <article class="opinia ">
                        <a>Opinia1</a>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum aspernatur illum rem, pariatur nam unde, soluta explicabo cum corrupti nesciunt dolorem molestiae totam commodi architecto vel, repudiandae et illo placeat?</p>
                    </article>
                    <article class="opinia ">
                        <a>Opinia2</a>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum aspernatur illum rem, pariatur nam unde, soluta explicabo cum corrupti nesciunt dolorem molestiae totam commodi architecto vel, repudiandae et illo placeat?</p>
                    </article>
                    <article class="opinia ">
                        <a>Opinia3</a>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum aspernatur illum rem, pariatur nam unde, soluta explicabo cum corrupti nesciunt dolorem molestiae totam commodi architecto vel, repudiandae et illo placeat?</p>
                    </article>
                    <article class="opinia ">
                        <a>Opinia4</a>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum aspernatur illum rem, pariatur nam unde, soluta explicabo cum corrupti nesciunt dolorem molestiae totam commodi architecto vel, repudiandae et illo placeat?</p>
                    </article>
                    <article class="opinia ">
                        <a>Opinia5</a>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum aspernatur illum rem, pariatur nam unde, soluta explicabo cum corrupti nesciunt dolorem molestiae totam commodi architecto vel, repudiandae et illo placeat?</p>
                    </article>
                </div>
            </div>
        </div>

        
        <div class="strona" id="widea">
            <div class="galeria">
                <h2>Stacje w oku kamer</h2>
                <video controls  style="width:90%; max-width:100%; height:auto; max-height:100%; ">
                        <source src="data/video.mp4 " type="video/mp4 ">
                        Twoja przeglądarka nie wspiera wyświetlania tego wideo.
                </video>
                <br/><br/>
            </div>    
        </div>

        <div class="strona" id="kontakty">
            <section id="kontakt " class="kontakt ">
                <form action="index.php " method="POST">
                    <table class="tabela2 ">
                        <tr>
                            <td colspan="2"><h2>Kontakt</h2></td>
                        </tr>
                        <tr>
                            <td>
                                <lable for="nazwa " class=" ">Nazwa</lable>
                            </td>
                            <td><input type="text" name="nazwa " id="nazwa " placeholder="Jan Kowalski "></td>
                        </tr>
                        <tr>
                            <td>
                                <lable for="telefon ">Telefon</lable>
                            </td>
                            <td><input type="number" name="telefon " id="telefon " placeholder="543 543 543 "></td>
                        </tr>
                        <tr>
                            <td>
                                <lable for="mail ">Mail</lable>
                            </td>
                            <td><input type="email" name="mail " id="mail " placeholder="jankowalski@poczta.com " required></td>
                        </tr>
                        <tr>
                            <td>
                                <lable for="tekst ">Wiadomość</lable>
                            </td>
                            <td><textarea rows="10 " cols="30 ">
                                    Wiadomość...
                                </textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Wyślij "></td>
                        </tr>
                    </table>
                </form>
            </section>
        </div>
        <script src="spa.js"></script>


    </div>
        </main>
        <script type="text/javascript">
            class Firma {
                constructor(nazwafirmy, adresfirmy, kodfirmy, nipfirmy) {
                    this.nazwafirmy = nazwafirmy;
                    this.adresfirmy = adresfirmy;
                    this.kodfirmy = kodfirmy;
                    this.nipfirmy = nipfirmy;
                }
                Nazwa() {
                    return "Nazwa naszej firmy to: " + this.nazwafirmy;
                }
                Adres() {
                    return "Można nas znaleźć tutaj: " + this.adresfirmy;
                }
                Kod() {
                    return "Kod pocztowy do korespondencji: " + this.kodfirmy;
                }
                NIP() {
                    return "NIP: " + this.nipfirmy;
                }
            }
        </script>
        <footer class="footer1 ">
            <p>Copyright &copy; <span id="year"></span> Prawa autorskie BM 2021.</p>
            <div id="nazwafirmy"></div>
            <div id="adresfirmy"></div>
            <div id="kodfirmy"></div>
            <div id="nipfirmy"></div>
        </footer>
    </div>

    <script type="text/javascript">
        document.getElementById("year").innerHTML = new Date().getFullYear();
        const firma = new Firma("Wielkie Ładowanie", "Rzeszów, Podkarpacka 1", "38-200, Rzeszów", "123 312 123 123")
        document.getElementById("nazwafirmy").innerHTML = firma.Nazwa();
        document.getElementById("adresfirmy").innerHTML = firma.Adres();
        document.getElementById("kodfirmy").innerHTML = firma.Kod();
        document.getElementById("nipfirmy").innerHTML = firma.NIP();

        const napis = document.querySelector("#nazwafirmy");
        napis.style.color = "black";



        function nasun() {
            napis.style.color = "red";
            napis.style.fontWeight = "1000";
            napis.style.fontSize = "18px";
        }

        function odsun() {
            napis.style.color = "black";
            napis.style.fontWeight = "500";
            napis.style.fontSize = "16px";
        }

        napis.addEventListener("mouseover", nasun);
        napis.addEventListener("mouseout", odsun);
    </script>
    

</body>

</html>