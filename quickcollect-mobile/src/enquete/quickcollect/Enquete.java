package enquete.quickcollect;

import enquete.quickcollect.database.Fiche;
import enquete.quickcollect.database.FichesBDD;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

@SuppressWarnings("unused")
public class Enquete extends Activity {
	static final String KEY_NAME = "name";
	 @Override
	    public void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	        setContentView(R.layout.activity_enquete);
	        //Intent in = getIntent();
	        FichesBDD fichebdd = new FichesBDD(this);
	        fichebdd.open();
	       // Fiche fic = new Fiche(1);
	        fichebdd.insertFiche();
	        
	        Fiche f = fichebdd.getFiche();
	        if(f == null)
	          Toast.makeText(this, "Fiche inexistant", Toast.LENGTH_LONG).show();
	        else
	        	Toast.makeText(this, f.toString(), Toast.LENGTH_LONG).show();
	        // Get XML values from previous intent
	        //String name = in.getStringExtra(KEY_NAME);
	        //Toast.makeText(this, name, Toast.LENGTH_LONG).show();
	        //TextView t =(TextView)findViewById(R.id.title);
	       // t.setText(name);
	        // actions
	       /* Button btnnewfiche = (Button) findViewById(R.id.newfiche);
	        btnnewfiche.setOnClickListener(new View.OnClickListener() {

	        	public void onClick(View v) {
	        	
	                	Intent intent = new Intent(getApplicationContext(), NewFiche.class);
	                	
	        			//On démarre l'autre Activity
	        			startActivity(intent);	
	                	
	                }
	        });*/
	 }
	 @Override
		public boolean onCreateOptionsMenu(Menu menu) {
			getMenuInflater().inflate(R.menu.activity_enquete, menu);
			return true;
		}
	 @Override
		public boolean onOptionsItemSelected(MenuItem item) {
			switch (item.getItemId()) {
			case R.id.add:
				// Comportement du bouton "A Propos"
				return true;
			case R.id.edit:
				// Comportement du bouton "Aide"
				return true;
			case R.id.supp:
				// Comportement du bouton "Rafraichir"
				return true;
			case R.id.menu_settings:
				// Comportement du bouton "Param�tres"
				return true;
			default:
				return super.onOptionsItemSelected(item);
			}
		}
	 
	 

}
