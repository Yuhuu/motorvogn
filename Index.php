<head>
    <script type="text/javascript" src="Validering.js"></script>
</head>
<body>
<h2>Motorvognregistrering</h2>
Vennligst registrer dataene under og trykk Registrer!<br/>
<form action="" method ="post" name="skjema" onSubmit ="return valider_alle()">
<table border="1">
<tr>
    <td>Personnr: </td>
    <td><input type="text" name="personnr" onChange="valider_personnr()" /></td>
    <td><div id="feilPersonnr">*</div></td>
</tr>
<tr>
    <td>Navn: </td>
    <td><input type="text" name="navn"  onChange="valider_navn()"/></td>
    <td><div id="feilNavn">*</div></td>
</tr>
<tr>
    <td>Adresse: </td>
    <td><input type="text" name="adresse" onChange="valider_adresse()"/></td>
    <td><div id="feilAdresse">*</div></td>
</tr>
<tr>
    <td>Telefonnr: </td>
    <td><input type="text" name="telnr"  onChange="valider_telefonnr()"/></td>
    <td><div id="feilTelefonnr">*</div></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Personbil</td>
</tr>
<tr>
    <td>Merke: </td>
    <td><input type="text" name="merke" onChange="valider_merke()" /></td>
    <td><div id="feilMerke">*</div></td>
    <td><input type="radio" name="kjoretoy" value="Personbil" /></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td>Årsmodell: </td>
    <td><input type="text" name="aarmodel" onChange="valider_modell()"/></td>
    <td><div id="feilModell">*</div></td>
    <td>Lastebil</td>
</tr>
<tr>
    <td>Farge: </td>
    <td><input type="text" name="farge" onChange="valider_farge()"/></td>
    <td><div id="feilFarge">*</div></td>
    <td><input type="radio" name="kjoretoy" value="Lastebil" /></td>
</tr>
<tr>
    <td>Bilnummer: </td>
    <td><input type="text" name="bilnr"  onChange="valider_bilnr()"/></td>
    <td><div id="feilBilnr">*</div></td>
    <td>Motorsykkel</td>
</tr>
<tr>
    <td>Spesialfelt (Lastekap, personer, kubikk): </td>
    <td><input type="text" name="spesial" /></td><td></td>
    <td><input type="radio" name="kjoretoy" value="Motorsykkel" /></td>
</tr>
<tr>
    <td> </td>
    <td><input type="submit" name="registrer" value="Registrer" /></td>
</tr>
</table>
</form>
</body>
<?php
include("Class_Eier.php");
include("DB_Class_Eier.php");
include("Class_Kjoretoy.php");
include("Class_Lastebil.php");
include("DB_Class_Eier_Kjoretoy.php");
include("Class_Motorsykkel.php");
include("Class_Personbil.php");
include("Feilhandterer.php");
include("Validering.php");
if(isset($_REQUEST["registrer"]))
{
    // opprett objekter, validerer og flytt data til disse.
    if(isset($_REQUEST["kjoretoy"]))
    {
        $eier = new Eier();
        $feilString = valider_og_set_eier($eier);
        if($feilString!=null)
        {
            // det er en valideringsfeil i eier!
            echo "Valideringsfeil : <br/>";
            echo $feilString;
        }
        else
        {
            // eier er validert OK og attributter satt til eierobjektet
            switch ($_REQUEST["kjoretoy"])
            {
                case "Lastebil":
                    $kjoretoy = new Lastebil();
                    $feilString = valider_og_sett_bilinfo($kjoretoy);
                    $feilString .=$kjoretoy->valider_kapasitet($_REQUEST["spesial"]);
                    if($feilString!=null)
                    {
                        echo "Feil i validering av bilinformasjon:<br/>";
                        echo $feilString."<br/>";
                    }
                    else
                    {
                        $eierLastebil_db = new DB_eier_kjoretoy();
                        $feilString1=$eierLastebil_db->lagreEierLastebil($eier, $kjoretoy);
                    }
                break;
                case "Personbil":
                    $kjoretoy = new Personbil();
                    $feilString = valider_og_sett_bilinfo($kjoretoy);
                    $feilString .=$kjoretoy->set_antallPers($_REQUEST["spesial"]);
                    if($feilString!=null)
                    {
                        echo "Feil i validering av bilinformasjon:<br/>";
                        echo $feilString."<br/>";
                    }
                    else
                    {
                        $eierPersonbil_db = new DB_eier_kjoretoy();
                        $feilString1 = $eierPersonbil_db->lagreEierPersonbil($eier, $kjoretoy);
                    }
                break;
                case "Motorsykkel":
                    $kjoretoy = new Motorsykkel();
                    $feilString = valider_og_sett_bilinfo($kjoretoy);
                    $feilString .=$kjoretoy->set_kubikk($_REQUEST["spesial"]);
                    if($feilString!=null)
                    {
                        echo "Feil i validering av bilinformasjon:<br/>";
                        echo $feilString."<br/>";
                    }
                    else
                    {
                        $eierMotorsykkel_db = new DB_eier_kjoretoy();
                        $feilString1 = $eierMotorsykkel_db->lagreEierMotorsykkel($eier, $kjoretoy);
                    }
                break;
            default:
                break;
            }
       }
       if($feilString1!=null)
       {
           echo "Feil i lagring av informasjon til registeret! <br>";
           echo $feilString1;
       }
    }
    else
    {
        echo "Må velge enten lastebil, personbil eller motorsykkel!";
    }
}
$eierList = new DB_Eier();
$eierList->vise_alle();
?>