<script type="text/javascript">
function confirmLink(ecod, theSqlQuery) {
    confirmMsg='Confirmation';
    var is_confirmed = confirm(confirmMsg + ' :\n' + theSqlQuery);
    if (is_confirmed) {
        //theLink.href += '&is_js_confirmed=1';
        //Supprimer enquête
        $.get("../fonctions/supp_enquete.php", { ecod: ecod},
        function(data){
            alert("Suppression: " + data);
            document.location.href = "liste_enquetes.php";
       });
    }
    return is_confirmed;
} // end of the 'confirmLink()' function
//creer_rubrique
function creer_rubrique(ecod) {
    //theLink.href += '&is_js_confirmed=1';
    //Supprimer enquête
    $.get("../fonctions/nouvelle_rubrique.php", { ecod: ecod},
    function(data){
        //alert("Suppression: " + data);
        document.location.href = 'detail_rubrique.php?id='+ecod+'&idr='+data;
        
    });
}
</script>
<script type="text/javascript">
function fnClickOpenEnq(code) {
   
    //liste des enqueteurs
   $.get("../formulaire/liste_enqueteur.php", { code: code},
    function(data){
        //alert("Data Loaded: " + data);
        document.getElementById("tab1").innerHTML="";
        var idtb="#tab1";
         $(''+idtb+'').append(data);
    });
   //liste des résultats
   $.get("../formulaire/liste_resultat.php", { code: code},
    function(data){
        document.getElementById("tab2").innerHTML="";
        var idtb="#tab2";
         $(''+idtb+'').append(data);
    });
}
</script>
