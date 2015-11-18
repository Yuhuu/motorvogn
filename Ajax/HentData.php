<?php
$nr = $_GET["valgtNavn"];
$db= new mysqli("127.0.0.1","root","","s184519");
if(!$db)
{
    die("feil i db");
}
$sql = "Select * from Ruter Where ruternr = '$nr' ORDER BY RAND() limit 5";
$resultat=$db->query($sql);
$rader =array();
while($rad=$resultat->fetch_assoc()){
	$rader[]=$rad;
}
json_encode($rader);
$utStreng = "";
for($i = 0; $i<count($rader); $i++) {
                    $utStreng .=$rader[$i]['ruternr']."--".$rader[$i]['belop']."--";
                    $utStreng .=$rader[$i]['kortnr']."<br>";
                   }
   echo $utStreng ;
?>
