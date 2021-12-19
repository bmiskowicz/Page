function readFile(file, callback) {
    var jsonFile = new XMLHttpRequest();
    jsonFile.overrideMimeType("application/json");
    jsonFile.open("GET", file, true);

    jsonFile.onreadystatechange = function() {
        if (jsonFile.readyState === 4 && jsonFile.status == "200") {
            callback(jsonFile.responseText);
        }
    };
    jsonFile.send(null);
}

function pobierzOferty() {
    var jsonData, oferty;

    readFile("dane.json", function(response) {
        jsonData = response;
        oferty = JSON.parse(jsonData);

        appendData(oferty);
        appendOptions(oferty);
    })
}

function appendData(data) {
    for (var i = 0; i < data.length; i++) {
        output = '<tr>' +
            '<td>' + data[i].taryfa + '</td>' +
            '<td>' + data[i].oplatacz + '</td>' +
            '<td>' + data[i].oplatam + '</td>' +
            '<td>' + data[i].moc + '</td>' +
            '<td>' + data[i].cenan + '</td>' +
            '<td>' + data[i].cenab + '</td>';
        document.getElementById('data' + i).innerHTML = output;
    }
}

function appendOptions(data) {
    for (var i = 0; i < data.length; i++) {
        document.getElementById('option' + i).innerHTML = '<option>' + data[i].taryfa + '</option>';
    }
}

function pokazOferty() {
    if (document.getElementById("data4").style.display === "none") {
        document.getElementById("data4").style.display = "";
        document.getElementById("data5").style.display = "";

    } else {
        document.getElementById("data4").style.display = "none";
        document.getElementById("data5").style.display = "none";
    }
}

const languages = [
    ["pl", "Polski"],
    ["en", "English"]
];

function loadMenu(languages, language) {
    /*fetch('menu-pl.xml').then(response => {
            console.log(response.status);
            console.log(response.statusText);
            console.log(response)
            displayMenu(response);
            menuLanguageSelection(languages, response);
        })
        .catch(error => {
        })
        */

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            displayMenu(this);
            menuLanguageSelection(languages, this);
        }
    };

    switch (language) {
        case languages[0][0]:
            xmlhttp.open("GET", "menu-pl.xml", true);
            break;
        case languages[1][0]:
            xmlhttp.open("GET", "menu-en.xml", true);
            break;
        default:
            xmlhttp.open("GET", "menu-pl.xml", true);
    }
    xmlhttp.send();
}

function displayMenu(xml) {
    var x, i, xmlDoc, list;
    xmlDoc = xml.responseXML;
    list = '<ul>';
    x = xmlDoc.getElementsByTagName("item");
    for (i = 0; i < x.length; i++) {
        list += '<li onclick=location.href="' + x[i].getElementsByTagName("link")[0].childNodes[0].nodeValue + '"><a href="' + x[i].getElementsByTagName("link")[0].childNodes[0].nodeValue + '">' + x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue + '</a></li>';
    }
    list += '</ul>';
    document.getElementsByClassName("menu")[0].innerHTML = list;
}

function menuLanguageSelection(languages, xml) {
    var i, j, xmlDoc, lang, language, selectionList;
    xmlDoc = xml.responseXML;
    language = xmlDoc.getElementsByTagName("language")[0].childNodes[0].nodeValue;
    selectionList = '<select class="lang" id="lang">';
    for (i = 0; i < languages.length; i++) {
        selectionList += '<option value="' + languages[i][0] + '"';
        if (languages[i][1] == language) { selectionList += ' selected'; }
        selectionList += '>' + languages[i][1] + '</option>';
    }
    selectionList += '</select>';
    document.getElementsByClassName("language")[0].innerHTML = selectionList;
    document.getElementById("lang").addEventListener("change", function() {
        lang = document.getElementById("lang").value;
        for (j = 0; j < languages.length; j++) {
            if (languages[j][0] == lang) {
                document.getElementById("strona-glowna").innerHTML = "Wybrano język: " + languages[j][1];
            }
        }
        loadMenu(languages, lang);
    });
}