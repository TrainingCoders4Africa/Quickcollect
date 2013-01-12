package enquete.quickcollect;
import java.io.InputStream;
import java.util.Date;
import java.util.ArrayList;
import java.util.List;
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
import org.w3c.dom.Node;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
//import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

import enquete.quickcollect.database.BaseReponsesFiches;
import enquete.quickcollect.database.ReponsesBDD;
import enquete.quickcollect.database.ReponsesFiches;

import android.app.Activity;
import android.content.Intent;
import android.content.res.AssetManager;
import android.database.sqlite.SQLiteDatabase;
//import android.graphics.Color;
//import android.graphics.Typeface;
import android.os.Bundle;
import android.os.StrictMode;
import android.text.InputType;
import android.text.format.DateFormat;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
//import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Spinner;
//import android.widget.LinearLayout;
//import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class NewFiche extends Activity {
     public int nbrequestion;
     public String nameenquete;
     public int indencours;
     public String idenqueteur;
     static  String KEY_NAME;
     HttpPost httppost;
     StringBuffer buffer;
     HttpClient httpclient ;
     String ddate;
     //id enquetteur
     String id_enqueteur;
     String rep_ques;
     String name;
     String choixsp;
 	public String getChoixsp() {
		return choixsp;
	}

	public void setChoixsp(String choixsp) {
		this.choixsp = choixsp;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getRep_ques() {
		return rep_ques;
	}

	public void setRep_ques(String rep_ques) {
		this.rep_ques = rep_ques;
	}

	public String getId_enqueteur() {
 		return id_enqueteur;
 	}

 	public void setId_enqueteur(String id_enqueteur) {
 		this.id_enqueteur = id_enqueteur;
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
	 @Override
	    public void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	        //StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
	       // StrictMode.setThreadPolicy(policy); 
	        setContentView(R.layout.activity_newfiche);	
	        Intent in = getIntent();
		    String id = in.getStringExtra(KEY_NAME);
		    setId_enqueteur(id);
	        Document doc = this.XMLfromAsset();
	        int numResults = XMLfunctions.numResults(doc);
	        nameenquete = XMLfunctions.nameEnquete(doc);
	        nbrequestion = numResults;
	        indencours = 0;
	        TextView ename = (TextView)findViewById(R.id.nameenquete);
	        ename.setText(nameenquete);
	        String d = (String) DateFormat.format("EEEE,dd MMMM,hh:mm:ss", new Date());
        	ddate = d;
	        
	        afficherElement();
	   
	        	
	        	

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
	        	String format = XMLfunctions.getValue(e, "format");
	        	
	        	if(type.compareTo("spinner") == 0){
	        		String options = XMLfunctions.getValue(e, "values");
	        		String[] opt = options.split (","); 
	        		//label  rubrique
	        		TextView labelrub =(TextView)findViewById(R.id.labelr);
	        		labelrub.setText(labelr);
	        		// textview non visible pour garder le id de la question
	        		TextView rub = (TextView)findViewById(R.id.idr);
	        		rub.setText(idr);
	        		setRep_ques("sp");
	        		
	        		//label de la question
	        		TextView t = (TextView)findViewById(R.id.label);
	        		t.setText(label);
	        		Spinner sp =(Spinner)findViewById(R.id.questionsp);
	        		List<String> list = new ArrayList<String>();
	        		for(int i=0;i<opt.length;i++){
	        			String val = opt[i];
	        			list.add(val);
	        		}
	        		ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this,
	        				android.R.layout.simple_spinner_item, list);
	        			dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
	        			sp.setAdapter(dataAdapter);
	        			EditText text = (EditText)findViewById(R.id.question);
		        		text.setVisibility(View.INVISIBLE);
	        			sp.setVisibility(View.VISIBLE);
	        			sp.setOnItemSelectedListener( new OnItemSelectedListener() {
	        					public void onNothingSelected(AdapterView<?> arg0) { }
	        					public void onItemSelected(AdapterView<?> parent, View v,
	        					int position, long id) {
	        					// Code that does something when the Spinner value changes
	        						Spinner sp =(Spinner)findViewById(R.id.questionsp);
		        					setChoixsp(sp.getSelectedItem().toString());
	        					}
	        					});
	        			//setChoixsp(sp.getSelectedItem().toString());
	        			/*sp.setOnItemSelectedListener(new View.OnClickListener() {
							
							

	    		        	public void onClick(View v) {
	    		        		Spinner sp =(Spinner)findViewById(R.id.questionsp);
	        					setChoixsp(sp.getSelectedItem().toString());
	        					
	    		        	}
	        			}
	        					);*/
	        			
	        			
	        			
	        			//LinearLayout l = (LinearLayout)findViewById(R.id.linearLayoutFiche);
	        			//l.addView(sp);
	        	}
	        	if(type.compareTo("texte") == 0){
	        		/*if(indencours > 0){
	        		 EditText enqueteur = (EditText)findViewById(R.id.idenqueteur);
	        		 enqueteur.setText(idenqueteur);
	        		 enqueteur.setEnabled(false);
	        		
	        		}*/
	        		//label  rubrique
	        		TextView labelrub =(TextView)findViewById(R.id.labelr);
	        		labelrub.setText(labelr);
	        		// textview non visible pour garder le id de la question
	        		TextView rub = (TextView)findViewById(R.id.idr);
	        		rub.setText(idr);
	        		setRep_ques("txt");
	        		
	        		//label de la question
	        		TextView t = (TextView)findViewById(R.id.label);
	        		t.setText(label);
	        		//champ question
	        		//LinearLayout l = (LinearLayout)findViewById(R.id.linearLayoutFiche);
	        		Spinner sp =(Spinner)findViewById(R.id.questionsp);
	        		sp.setVisibility(View.INVISIBLE);
	        		EditText text = (EditText)findViewById(R.id.question);
	        		text.setVisibility(View.VISIBLE);
	        		
	        		// textview non visible pour garder le id de la question
	        		TextView ques = (TextView)findViewById(R.id.idquestion);
	        		ques.setText(idquestion);
	        		if(format.compareTo("numeric") == 0){
	        			EditText ed = (EditText)findViewById(R.id.question);
	        			ed.setInputType(InputType.TYPE_CLASS_NUMBER);
	        		}
	        		else{
	        			EditText ed = (EditText)findViewById(R.id.question);
	        			ed.setInputType(InputType.TYPE_CLASS_TEXT);
	        		}
	        		
	        		
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
		        		//EditText IDE = (EditText)findViewById(R.id.idenqueteur);
		        		//String IDEN = 
		        		//idenqueteur = getId_enqueteur();
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
		        		String repp = getRep_ques();
		        		if(repp.compareTo("txt") == 0){
		        		EditText rep = (EditText)findViewById(R.id.question);
		            	setName(rep.getText().toString());
		            	rep.setText("");
		        		}
		        		if(repp.compareTo("sp") == 0){
			        		Spinner rep = (Spinner)findViewById(R.id.questionsp);
			            	setName(getChoixsp());
			            	
			        		}
		            	
		            	
		            	String ind = "fiche"+"-"+getId_enqueteur()+"-"+ddate;
		            	
		            	//Toast.makeText(this,ind+idenqueteur+idrubrique+idques+name, Toast.LENGTH_LONG).show();
		            	addData(ind,getId_enqueteur(),idrubrique, idques,getName());
		            	//sendData(ind,idenqueteur,idrubrique, idques,name);
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
	     Toast.makeText(this,"!!!!Nouvelle Fiche Enregistrée!!!!", Toast.LENGTH_LONG).show();
	     Intent in = new Intent(getApplicationContext(), Liste.class);
 		  in.putExtra(KEY_NAME, getId_enqueteur());
 		  startActivity(in);
	     
	     }
		 
	 }
	 public void addData(String i, String enqueteur, String idrubrique, String idques, String name){
		 
	   //Toast.makeText(this,i+enqueteur+idrubrique+idques+name,Toast.LENGTH_LONG).show();
		 ReponsesBDD repBdd = new ReponsesBDD(this);
		 ReponsesFiches reponses = new ReponsesFiches(i,enqueteur,idrubrique, idques,name);
         
         //On ouvre la base de données pour écrire dedans
         repBdd.open();
         //On insère le livre que l'on vient de créer
         double d= repBdd.insertReponsesFiches(reponses);
         if(d>0)
        	 Toast.makeText(this,"!!!rep question Enregistrée!!!!", Toast.LENGTH_LONG).show();
         else
        	 Toast.makeText(this,"!!!Erreur rep question not save!!!!", Toast.LENGTH_LONG).show(); 
         
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
				suppbase();
				return true;
			case R.id.liste:
				// Comportement du bouton "Aide"
				showListe();
				return true;
			
			default:
				return super.onOptionsItemSelected(item);
			}
		}
	 private void newfiche(){
		 
			Intent in = new Intent(getApplicationContext(), NewFiche.class);
			in.putExtra(KEY_NAME, this.getId_enqueteur());
			startActivity(in);
	 }
	 
	 private void showListe(){
		    Intent in = new Intent(getApplicationContext(), Liste.class);
		    in.putExtra(KEY_NAME, this.getId_enqueteur());
			startActivity(in); 
		 
	 }
	 private void suppbase(){
		BaseReponsesFiches bdr = new BaseReponsesFiches(this, "idev.db", null, 1);
		
		SQLiteDatabase db = bdr.getWritableDatabase();
		bdr.onUpgrade(db, 1, 2);
		
		 
	 }
	
	
	 
	

}
