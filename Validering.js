function valider_personnr()
{
    regex = /^(0[1-9]|1[0-9]|2[0-9]|3[0-1])(0[1-9]|1[0-2])([0-9]{7})$/;
    if (!regex.test(this.skjema.personnr.value))
    {
        document.getElementById("feilPersonnr").innerHTML = "Feil i personnr";
        return false;
    }
    document.getElementById("feilPersonnr").innerHTML = "";
    return true;
}
function valider_navn()
{
    regex = /^[a-ÂA-≈. ]{2,20}$/;
    if (!regex.test(this.skjema.navn.value))
    {
        document.getElementById("feilNavn").innerHTML = "Feil i navnet";
        return false;
    }
    document.getElementById("feilNavn").innerHTML = "";
    return true;
}
function valider_adresse()
{
    regex = /^[a-ÂA-≈0-9. ]{2,30}$/;
    if (!regex.test(this.skjema.adresse.value))
    {
        document.getElementById("feilAdresse").innerHTML = "Feil i adresse";
        return false;
    }
    document.getElementById("feilAdresse").innerHTML = "";
    return true;
}
function valider_telefonnr()
{
    regex = /^[0-9]{8}$/;
    if (!regex.test(this.skjema.telnr.value))
    {
        document.getElementById("feilTelefonnr").innerHTML = "Feil i telefonnr";
        return false;
    }
    document.getElementById("feilTelefonnr").innerHTML = "";
    return true;
}
function valider_bilnr()
{
    regex = /^[A-Z][A-Z][0-9]{5}$/;
    if (!regex.test(this.skjema.bilnr.value))
    {
        document.getElementById("feilBilnr").innerHTML = "Feil i bilnr";
        return false;
    }
    document.getElementById("feilBilnr").innerHTML = "";
    return true;
}
function valider_farge()
{
    regex = /^[a-z¯ÊÂA-Zÿ∆≈]{2,10}$/;
    if (!regex.test(this.skjema.farge.value))
    {
        document.getElementById("feilFarge").innerHTML = "Feil i farge";
        return false;
    }
    document.getElementById("feilFarge").innerHTML = "";
    return true;
}
function valider_modell()
{
    regex = /^[0-9]{4}$/;
    if (!regex.test(this.skjema.aarmodel.value))
    {
        document.getElementById("feilModell").innerHTML = "Feil i modell";
        return false;
    }
    document.getElementById("feilModell").innerHTML = "";
    return true;
}
function valider_merke()
{
    regex =  /^[a-ÂA-≈. ]{2,20}$/;
    if (!regex.test(this.skjema.merke.value))
    {
        document.getElementById("feilMerke").innerHTML = "Feil i merke";
        return false;
    }
    document.getElementById("feilMerke").innerHTML = "";
    return true;
}
function valider_alle()
{
    persNrOK = valider_personnr();
    navnOK = valider_navn();
    adresseOK = valider_adresse();
    telefonnrOK = valider_telefonnr();
    bilNrOK = valider_bilnr();
    fargeOK = valider_farge();
    modellOK = valider_modell();
    merkeOK = valider_merke();
    if (persNrOK && navnOK && adresseOK && telefonnrOK
        && bilNrOK && fargeOK && modellOK && merkeOK)
    {
        return true;
    }
    return false;
}

