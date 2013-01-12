package enquete.quickcollect;


import java.io.InputStream;
import java.text.BreakIterator;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
import org.w3c.dom.NodeList;
import org.w3c.dom.Element;
import android.R.anim;
import android.R.string;
import android.os.Bundle;
import android.preference.EditTextPreference;
import android.app.Activity;
import android.content.Intent;
import android.content.res.AssetManager;
import android.database.sqlite.SQLiteDatabase;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import enquete.quickcollect.database.BaseReponsesFiches;

@SuppressWarnings("unused")
public class Home extends Activity {
	// KEY_ID ;
	
	static  String KEY_NAME ;
	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        Button btn = (Button)findViewById(R.id.valider);
        btn.setOnClickListener(new View.OnClickListener() {

        	public void onClick(View v) {
        		EditText idenq = (EditText)findViewById(R.id.enqueteur);
        		String id = idenq.getText().toString();
        		//Enqueteur enq = new Enqueteur();
        		//enq.setID_ENQUETEUR(id);
        		Intent in = new Intent(getApplicationContext(), Liste.class);
        		in.putExtra(KEY_NAME, id);
        		startActivity(in);
                        		
        	}
        });
       
    }
	public int verifUser(String iduser)
	 {
		 Document doc = this.XMLfromAsset("Enqueteur.xml");
		 int numResults = XMLfunctions.numResults(doc);
		 int n;
	     int nbrequestion = numResults;
	    
	    	 for(int i=0;i<numResults;i++){
	         NodeList nodes = doc.getElementsByTagName("input");
	     
	    	 Element e = (Element)nodes.item(i);
			 String id = XMLfunctions.getValue(e, "id");
	     	if(id.compareTo(iduser)>=0)
	     	{
	     		return 1;
	     		
	     	}

	     }
	    	 return 1;
	     
	 }
	public Document XMLfromAsset(String name){
	       
		AssetManager mgr = getAssets();
		Document document = null;
		try{
		InputStream in = mgr.open(name);
		 
		DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
		DocumentBuilder db = dbf.newDocumentBuilder();
		
		document = db.parse(in);
			
		}
		catch (Exception e) {
            e.printStackTrace();
        }
		
		return document;
}
/*
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
		startActivity(in);
 }
 
 private void showListe(){
	    Intent in = new Intent(getApplicationContext(), ListeFiches.class);
		startActivity(in); 
	 
 }
 private void suppbase(){
	BaseReponsesFiches bdr = new BaseReponsesFiches(this, "idev.db", null, 1);
	
	SQLiteDatabase db = bdr.getWritableDatabase();
	bdr.onUpgrade(db, 1, 2);
	
	 
 }*/
}
