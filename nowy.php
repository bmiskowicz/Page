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

    <?php

        class Ladowarka
        {
            public $nazwa;
            public $cena;
            
            function __construct($nazwa, $cena, $rozmiar, $kolor) {
                $this->nazwa= $nazwa;
                $this->cena= $cena;
                $this->rozmiar = $rozmiar;
                $this->kolor = $kolor;
            }

            function setName($parametr) {
                $this->nazwa= $parametr;
            }

            function setPrice($parametr) {
                $this->cena= $parametr;
            }

            function getName() 
            {
                return $this->nazwa;
            }

            function getPrice() 
            {
                return $this->cena;
            }

            public function wypisz() {
                echo "<p style=font-size:".$this->rozmiar.";color:".$this->kolor.">" . "Produkt "  .$this->nazwa. " kosztuje " .$this->cena. "</p>";
            }
            
        }

        $produkt1 = new Ladowarka("SDF126", "23 zł", "23px", "black");
        $produkt2 = new Ladowarka("SDF127", "27 zł", "56px", "red");
        $produkt1->wypisz();
        $produkt2->wypisz();
        
    ?>

</body>
