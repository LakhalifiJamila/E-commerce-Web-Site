<link rel="stylesheet" href="header.css">
<header>
    <h1><strong id="logo">Team Dyalna</strong></h1>
    <div id="search_bar">
        <!--pour etre un seul bloc-->
        <input type="search" id="search" value="" placeholder="  chercher une page, une catégorie ou un produit" onload="" onchange="ouvrirPage()">
        <img id="loop" src="icons/search.ico" alt="search">
    </div>
    <script>
        /* how to seperate between js and html ?? */
        function ouvrirPage() {
            var a = document.getElementById("search").value;
            if (a === "Accueil") {
                window.open("Accueil.php");
            }
        }
    </script>
    <div id="menu">
        <!-- <p> </p> ??-->
        <img src="icons/menu.ico" alt="menu_icon">
    </div>
    <div id="total_nav">

        <ul id="navbar">
            <li><a href="Accueil.php"><strong>Accueil</strong></a></li>
            <li><a href="deconnexion.php"><strong>Deconnexion</strong></a></li>
        </ul>
    </div>
</header>