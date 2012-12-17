package enquete.quickcollect;
import java.io.InputStream;
import java.util.ArrayList;
//import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
//import android.sax.Element;
import org.w3c.dom.Element;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
//import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

import enquete.quickcollect.database.ReponsesBDD;
import enquete.quickcollect.database.ReponsesFiches;

import android.app.Activity;
import android.content.Intent;
import android.content.res.AssetManager;
//import android.graphics.Color;
//import android.graphics.Typeface;
import android.os.Bundle;
import android.os.StrictMode;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
//import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
//import android.widget.LinearLayout;
//import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class NewFiche extends Activity {
     public int nbrequestion;
     public String nameenquete;
     public int indencours;
     public String idenqueteur;
     static final String KEY_NAME = "name";
     HttpPost httppost;
     StringBuffer buffer;
     HttpClient httpclient ;
 
	 @Override
	    public void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
	        StrictMode.setThreadPolicy(policy); 
	        setContentView(R.layout.activity_newfiche);	
	        Document doc = this.XMLfromAsset();
	        int numResults = XMLfunctions.numResults(doc);
	        nameenquete = XMLfunctions.nameEnquete(doc);
	        nbrequestion = numResults;
	        indencours = 0;
	        TextView ename = (TextView)findViewById(R.id.nameenquete);
	        ename.setText(nameenquete);
	       
	        
	        afficherElement();
	   
	        	
	        	

	 }
	 
	    @Override 
	    public boolean onCreateOptionsMenu(Menu menu) {
	        getMenuInflater().inflate(R.menu.activity_home, menu);
	        return true;
	    }
	 
	 @Override
		public boolean onOptionsItemSelected(MenuItem item) {
			switch (item.getItemId()) {
			case R.id.add:
				newfiche();
				// Comportement du bouton "A Propos"
				return true;
			case R.id.edit:
				// Comportement du bouton "Aide"
				return true;
			
			default:
				return super.onOptionsItemSelected(item);
			}
		}
	 private void newfiche(){
		 
		 
		 
		 Intent intent = new Intent(getApplicationContext(), NewFiche.class);
	 	
			//On démarre l'autre Activity
			startActivity(intent);
	 }
	 
	 public void afficherElement(){
		 
	     if(indencours < nbrequestion){
	        	// recuperer la question au rang ind l'afficher et envoyer les saisie au Controller et ind
	        	//LinearLayout  L =(LinearLayout) findViewById(R.id.linearLayoutFiche);
	        	Document doc = this.XMLfromAsset();
		        NodeList nodes = doc.getElementsByTagName("input");
		        Element e = (Element)nodes.item(indencours);
		        //element lie à la question
				String idquestion = XMLfunctions.getValue(e, "id");
	        	String type = XMLfunctions.getValue(e, "type");
	        	String label =  XMLfunctions.getValue(e, "label");
	        	// rubrique
	        	String idr = XMLfunctions.getValue(e, "idr");
	        	String labelr =  XMLfunctions.getValue(e, "labelr");
	        	
	        	if(type.compareTo("texte") == 0){
	        		if(indencours > 0){
	        		 EditText enqueteur = (EditText)findViewById(R.id.idenqueteur);
	        		 enqueteur.setText(idenqueteur);
	        		 enqueteur.setEnabled(false);
	        		
	        		}
	        		//label  rubrique
	        		TextView labelrub =(TextView)findViewById(R.id.labelr);
	        		labelrub.setText(labelr);
	        		// textview non visible pour garder le id de la question
	        		TextView rub = (TextView)findViewById(R.id.idr);
	        		rub.setText(idr);
	        		
	        		
	        		//label de la question
	        		TextView t = (TextView)findViewById(R.id.label);
	        		t.setText(label);
	        		
	        		
	        		// textview non visible pour garder le id de la question
	        		TextView ques = (TextView)findViewById(R.id.idquestion);
	        		ques.setText(idquestion);
	        		
	        		
	        		// textView pour type de la question
	        		TextView typequestion = (TextView)findViewById(R.id.typequestion);
	        		typequestion.setText(type);
	        		
	        		
	        		//EditText pour la reponse
	        		/*EditText tex = new EditText(this);
	        		tex.setId(R.id.question);
	        		L.addView(tex);*/
	        		
	        	}
	        	
	        	Button btn = (Button)findViewById(R.id.suivant);
	        
	        	//repBdd = new ReponsesBDD(this);
	        	btn.setOnClickListener(new View.OnClickListener() {

		        	public void onClick(View v) {
		        		//Création d'une instance de ma classe LivresBDD
		        		
		        		// récupération de id enqueteur
		        		EditText IDE = (EditText)findViewById(R.id.idenqueteur);
		        		String IDEN = IDE.getText().toString();
		        		idenqueteur = IDEN;
		                 // récupération de id rubrique
		        		TextView rubr = (TextView)findViewById(R.id.idr);
		        		String idrubrique = rubr.getText().toString();
		        		
		        		// récupération id de la question
		        		TextView tid = (TextView)findViewById(R.id.idquestion);
		        		String idques = tid.getText().toString();
		        		
		        		// recupere type question
		        		//TextView ttype = (TextView)findViewById(R.id.typequestion);
		        		//String typeques = ttype.getText().toString(); 
		        		
		        		// récupération réponse à la question
		        		EditText rep = (EditText)findViewById(R.id.question);
		            	String name = rep.getText().toString();
		            	rep.setText("");
		            	String ind = "essai";
;		            	//addData(1,idenqueteur,idrubrique, idques,name);
		            	sendData(ind,idenqueteur,idrubrique, idques,name);
		            	// Enregistrement et base et envoie vers un serveur distant
		            	// creer la nouvelle fiche et recupere le dernier id inserer dans la table table_fiche
		        		   
			        		
			               /* ReponsesFiches reponses = new ReponsesFiches(1,idenqueteur,idrubrique, idques,name);
			                
			                //On ouvre la base de données pour écrire dedans
			                repBdd.open();
			                //On insère le livre que l'on vient de créer
			                repBdd.insertReponsesFiches(reponses);*/
		            	/*Intent intent = new Intent(getApplicationContext(), Enquete.class);
			    		//intent.putExtra(KEY_NAME, typeques);
			    		startActivity(intent); */
		            	//Toast.makeText(this, name, Toast.LENGTH_LONG).show();
		            	
		        	   indencours++;
		        	   afficherElement();
		                	
		                }
		        });
	        
	        	
	        }
	     else{
	     Toast.makeText(this,"!!!Nouvelle Fiche Enregistrée!!!!", Toast.LENGTH_LONG).show();
	     
	     }
		 
	 }
	 public void addData(int i, String enqueteur, String idrubrique, String idques, String name){
		 
	//Toast.makeText(this,i+enqueteur+idrubrique+idques+name,Toast.LENGTH_LONG).show();
		 ReponsesBDD repBdd = new ReponsesBDD(this);
		 ReponsesFiches reponses = new ReponsesFiches(1,idenqueteur,idrubrique, idques,name);
         
         //On ouvre la base de données pour écrire dedans
         repBdd.open();
         //On insère le livre que l'on vient de créer
         double d= repBdd.insertReponsesFiches(reponses);
         if(d>0)
        	 Toast.makeText(this,"!!!rep question Enregistrée!!!!", Toast.LENGTH_LONG).show();
         
	 }
	 // envoie vers le serceur distant
	 public void sendData(String i, String enqueteur, String idrubrique, String idques, String name){
		 
		 httpclient = new DefaultHttpClient();
         httppost = new HttpPost("http://www.ansaarudine-pikine.org/addData.php");
 
                  try {
                      ArrayList<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
                      nameValuePairs.add(new BasicNameValuePair("idfiche", i));
                      nameValuePairs.add(new BasicNameValuePair("idenqueteur", enqueteur));
                      nameValuePairs.add(new BasicNameValuePair("idrubrique", idrubrique));
                      nameValuePairs.add(new BasicNameValuePair("idquestion", idques));
                      nameValuePairs.add(new BasicNameValuePair("rep", name));
                      httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));                  
                      HttpResponse response = httpclient.execute(httppost);
                  // HttpEntity entity = response.getEntity();
                   //InputStream is = entity.getContent();
                      Log.i("postData", response.getStatusLine().toString());
                       }
                       catch(Exception e)
                       {
                           Log.e("log_tag", "Error:  "+e.toString());
                       }
		 
	 }
	 
	// parser from asset
		public Document XMLfromAsset(){
	       
			AssetManager mgr = getAssets();
			Document document = null;
			try{
			InputStream in = mgr.open("QuickcollectXML.xml");
			 
			DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
			DocumentBuilder db = dbf.newDocumentBuilder();
			
			document = db.parse(in);
				
			}
			catch (Exception e) {
	            e.printStackTrace();
	        }
			
			return document;
			
	}

}
