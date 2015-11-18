<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        function hent_data()
        {

              var request = new XMLHttpRequest();
              var getUrl = "http://localhost/Ajax/Ajax/HentData.php?valgtNavn="+
                    this.skjema.valgtNavn.value; 
             request.open("Get",getUrl,true);
             request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status == 200)
               {
             var infor = HentData.parse(request.responseText);
                    for (i=0;i<infor.length;i++)
                  {
                       utStreng+=infor[i].ruternr+" "+infor[i].belop+" ";
                       utStreng+=infor[i].kortnr+" <br>";
                  }
                  document.getElementById("utdata").innerHTML = utStreng;
                }
        }  
              // $.ajax({
              //   url:getUrl,
              //   success:function(resultat){

              //      $("#utdata").html(infor);
              //   },
              //   error:function(xhr,status,error){
              //       $("#utdata").html("Feil");
              //   }
              // });
request.send(null);
        }
        function hent_data_loop()
        {
              
              hent_data();
              setTimeout("hent_data_loop()",20000);
              //alert("hei");
        }
    </script>
  </head>
  <body>
      <?php
          $db= new mysqli("127.0.0.1","root","","s184519");
          if($db->connect_error)
          {
            die("Feil i db");
          }
          $sql = "Select * from Ruter";
          $resultat=$db->query($sql);
      ?>
      <h2>Finne data om navnet!</h2>
      <h3>Velg et navn:</h3>
      <form name="skjema" action ="HentData.php">
          <select name ="valgtNavn"onChange="hent_data_loop()">
              <?php
              while ($rad=$resultat->fetch_assoc())
              {
                 $navn = $rad[ruternr];
                 echo "<option>$navn</option>";
              }
              ?>
          </select>
       </form>
      <div id="utdata"></div>
   </body>
</html>
