<?php

/**
 * @author quickCollect
 * @copyright 2012
 */

?>
   <script type="text/javascript">
            //***FHI********old content of js file.js********************************************
            //declaration d'une reference qui va contenir l'objet XMLHttprequest
            var xhr = null;
            //on verifie que l'objet  window.XMLHttpRequest existe si oui on instancie xhr, sinon on virifie que ActiveX existe
            //deux cas: celui des autres navigateurs et celui de microsoft

            //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
             function createXhrObject()
                        {
                            if (window.XMLHttpRequest)
                                return new XMLHttpRequest();

                            if (window.ActiveXObject)
                            {
                                var names = [
                                    "Msxml2.XMLHTTP.6.0",
                                    "Msxml2.XMLHTTP.3.0",
                                    "Msxml2.XMLHTTP",
                                    "Microsoft.XMLHTTP"
                                ];
                                for(var i in names)
                                {
                                    try{return new ActiveXObject(names[i]);}
                                    catch(e){}
                                }
                            }
                            window.alert("Votre navigateur ne prend pas en charge l'objet XMLHTTPRequest.");
                            return null; // non support?
                        }
             xhr = createXhrObject();
            //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
            //fonction qui permet de charger les zones enfants d'une zone donnee
            function charger(nbr_ques){
			     //	var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
				var chaine_last_sel='sel_'+nbr_ques;
				var typ_ques_id=parseInt(document.getElementById(chaine_last_sel).value); 
                var last_tr_typ_ques='#div_typ_ques_'+nbr_ques+'';
                
				$(last_tr_typ_ques).load('../../fonctions/typ_ques.php?typ_ques_id='+typ_ques_id+'&nbr_ques='+nbr_ques+'');
		   }

            
        </script>
		<script type="text/javascript">
            function ajouter_question(){
                
                //var j = i+1;
                //augmenter le nombre de questions de 1
                document.getElementById('nbr_ques').value =  parseInt(document.getElementById('nbr_ques').value) + 1;
                var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
                
                //on ajoute la div 
                var mon_div='<br /><div id="div_ques_'+nbr_ques+'">';
                mon_div+='<table><tr>';
                mon_div+='<th><span>Titre de la question</span></th>';
                mon_div+='<td><input id="ques_'+nbr_ques+'" name="ques_'+nbr_ques+'" placeholder="Nouvelle Question" style="text-align: left; " dir="ltr"/></td>';
                mon_div+='<td></td></tr>';
                mon_div+='<tr><th><span>Aide</span></th>';
                mon_div+='<td><input id="aide_'+nbr_ques+'" name="aide_'+nbr_ques+'" placeholder="Consignes d\'aide" style="text-align: left; " dir="ltr"/></td>';
                mon_div+='</tr><tr><th><span>Type de Question</span></th>';
                mon_div+='<td><select id="sel_'+nbr_ques+'" name="sel_'+nbr_ques+'" onchange="mis_a_jour_value2(\'sel_'+nbr_ques+'\');charger(\''+nbr_ques+'\');"></select>';
                mon_div+='</td><td></td></table><div id="div_typ_ques_'+nbr_ques+'"></div></div>';
                document.getElementById('tab_rub').innerHTML +=mon_div;
                charge('sel_'+nbr_ques);
                
                //modification du lien dans le div lign_supp_
                //document.getElementById('lien_lign_supp').innerHTML = '<a href="javascript:ajouter_ligne('+j+')"><img src="elus_locaux/new_hover.png" title="Ajouter un élu"/></a>';
            }

            function mis_a_jour_value(id_champ){
                var valeur = document.getElementById(''+id_champ+'').value;
                document.getElementById(''+id_champ+'').setAttribute('value',''+valeur+'');
            }
            function mis_a_jour_value2(id_champ){
                var i=document.getElementById(''+id_champ+'').selectedIndex;
                document.getElementById(''+id_champ+'').options[i].setAttribute('selected','selected');
            }

        </script>
                
        <script type="text/javascript">
        //charge les types de questions dans le select
        function charge(loc_html_id){
            xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
              var retour = xhr.responseText;
              document.getElementById(''+loc_html_id+'').innerHTML = retour;
              }
            }
            xhr.open("GET","../../fonctions/type_question.php?arid="+loc_html_id,true);
            xhr.send(null);
            }
        </script>
       
<script type="text/javascript">
function supprimer_option(nbr_q,p){
    var monli='#li_'+nbr_q+'_'+p;
    $(monli).remove();
    document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)-1; 
    alert("Suppression ok");
}
</script>

<script type="text/javascript">
function supprimer_option2(nbr_q,p){
    var monli='#li_'+nbr_q+'_'+p;
    var monul='ul_'+nbr_q;
    var optid='#optid_'+nbr_q+'_'+p;
    
    var opt_id=$(optid).val();
    
    $.get("../../fonctions/supp_option.php", { optid: opt_id},
    function(data){
        alert("Data Loaded: " + data);
        $(monli).remove();
        document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)-1;
	});
}
//ajout de question
/*funtion fnClickAddques(cpt_ques){

    $.get("../../fonctions/ajout_question.php", {},
    function(data){
        alert("Data Loaded: " + data);
        //on incrémente le compteur des questions
        if(data=="ok"){
            var newcptq=parseInt(document.getElementById(nbr_ques).value)+1
           document.getElementById(nbr_ques).value=newcptq;
           var chaine='<div id="div_ques_".newcptq></div>';
    
        }
        
	});
}*/
//cases à cocher
function fnClickAddOpt(cptq) {
    var nbr_q=cptq;
    var cod='cod'+nbr_q;
    var p=document.getElementById(cod).value;
    var myid='ul_'+nbr_q;
    //identifiant de l'UL
    /*var myid='#ul_'+nbr_q;
    $(''+myid+'').append(
    //$('#monbody').append(
          $('<li>')
            .append(
                $('<input>').attr('type','checkbox')
            )
            .append($('<input>')
                .attr('type','text')
                .attr('id', 'opt_'+nbr_q+'_'+p)
            )
        );*/
    var chaine='<li id="li_'+nbr_q+'_'+p+'"><input type="checkbox"/>';
    chaine+='<input type="text" id="opt_'+nbr_q+'_'+p+'" name="opt_'+nbr_q+'_'+p+'" placeholder="Option '+p+'" style="text-align:left" onchange="mis_a_jour_value(this.id);"/>';
    chaine+='<span> <a href="javascript:supprimer_option('+nbr_q+', '+p+')">Supprimer</a></span>';
    document.getElementById(myid).innerHTML+=chaine+'</li>';
    document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)+1;
    document.getElementById('opt_'+nbr_q+'_'+p).focus();
}
//sélectionner dans une liste
function fnClickAddOpt2(cptq) {
    var nbr_q=cptq;
    var cod='cod'+nbr_q;
    var p=document.getElementById(cod).value;
    var myid='ul_'+nbr_q;
    ²
    var chaine='<li id="li_'+nbr_q+'_'+p+'"><span>'+p+'. </span>';
    chaine+='<input type="text" id="opt_'+nbr_q+'_'+p+'" name="opt_'+nbr_q+'_'+p+'" placeholder="Option '+p+'" style="text-align:left" onchange="mis_a_jour_value(this.id);"/>';
    chaine+='<span> <a href="javascript:supprimer_option('+nbr_q+', '+p+')">Supprimer</a></span>';
    document.getElementById(myid).innerHTML+=chaine+'</li>';
    document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)+1;
    document.getElementById('opt_'+nbr_q+'_'+p).focus();
}
//validation formulaire création d'enquete

</script>
<script type="text/javascript">
 function valider_form(){
			var categorie=document.getElementById('categorie').value;
			if (categorie== -1){
				alert("Veuillez renseigner une categorie pour continuer ...");
				return false;
			}else{
			     var societe=document.getElementById('societe').value;
			     if (societe== -1){
				    alert("Veuillez renseigner une societe pour continuer ...");
				    return false;
			     }else{
			         var enq_lib=document.getElementById('enq_lib').value;
                     if (enq_lib== ""){
				        alert("Veuillez renseigner le libellé de l'enquête pour continuer ...");
				        return false;
			         }else{
			             return true; 
			         }         
			     }
			}
            
		}
 
</script> 
<script type="text/javascript">
function supprimer_categorie(idcat){
    //alert("ok");
    $.get("supp_categorie.php", { idcat: idcat},
    function(data){
        alert("Reponse: " + data);
        
	});
    
}

function fnClickAddRow() {
var p=document.getElementById('cod').value;
var chaine='<tr><td id="vilv"><input type="hidden" name="code'+p+'" id="code'+p+'" value="'+p+'" readonly/>'+p+'</td>';
chaine+='<td>';
chaine+='<input id="etat'+p+'" name="etat'+p+'" type="checkbox" value="1" checked="checked"/> Actif </td>';
chaine+='<td><input type="text" id="cat'+p+'" name="cat'+p+'"/></td>';
//chaine+='<td><button name="sup'+p+'" id="sup'+p+' onclick="if(!confirm(\'Attention! Voulez-vous vraiment supprimer cette categorie?\')) {return false;}else {alert();};">Supprimer</button></td>';
   
document.getElementById('tbody').innerHTML+=chaine+'</tr>';
document.getElementById('cod').value=parseInt(document.getElementById('cod').value)+1;
}
function valider_categories(){
    var inputs= document.getElementById("example1").getElementsByTagName('INPUT');
	var val_node=0;
	for(i=0, taille=inputs.length; i < taille; i++){
	   var node=inputs[i];
       if(node.getAttribute("type") == "text") {
	       val_node=node.getAttribute("value");
	   	   if (val_node==""){
                alert ( "Veuillez remplir toutes les cases du tableau ou supprimer les cases vides." );
		        return false;
	       }
		}
	}
}


</script>
