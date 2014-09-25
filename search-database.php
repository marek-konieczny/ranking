<?php
//load database connection
    $host = '127.0.0.1';
    $user = "root";
    $password = "";
    $database_name = "testdb";
    $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
// Search from MySQL database table
$search=$_POST['search'];
$query = $pdo->prepare("select * from book where title LIKE '%$search%' OR author LIKE '%$search%'  LIMIT 0 , 10");
serwisy:
    id 
    nazwa
    województwo
    adres 
    nr telefonu
    czy sprzedaja sprzet
ocena serwisu:
    id
    sklep-id
    user-id
    ocena1
    ocena2
    ocena...    --- ilosc ocen wyswietlanie na stronie - wiemy dla jakiedo is sklepu szukamy i tylko count from oceny where id sklepu = database_name
ilosc ocen:
    id
    liczba
    sklep-id
    ocena-serisu-id

$query->bindValue(1, "%$search%", PDO::PARAM_STR);
$query->execute();
// Display search result
         if (!$query->rowCount() == 0) {
		 		echo "Search found :<br/>";
				echo "<table style=\"font-family:arial;color:#333333;\">";
                echo "<tr><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;background:#98bf21;\">Title Books</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;background:#98bf21;\">Author</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;background:#98bf21;\">Price</td></tr>";
            while ($results = $query->fetch()) {
				echo "<tr><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;\">";
                echo $results['title'];
				echo "</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;\">";
                echo $results['author'];
				echo "</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;\">";
                echo "$".$results['price'];
				echo "</td></tr>";
            }
				echo "</table>";
        } else {
            echo 'Nothing found';
        }
?>