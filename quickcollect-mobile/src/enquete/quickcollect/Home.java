package enquete.quickcollect;


import android.R.anim;
import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

@SuppressWarnings("unused")
public class Home extends Activity {
	String KEY_ID ;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        
       
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
	 
	   /* Intent intent = new Intent(getApplicationContext(), NewFiche.class);
 	
		//On démarre l'autre Activity
		startActivity(intent);*/
	// Starting new intent
		Intent in = new Intent(getApplicationContext(), NewFiche.class);
		startActivity(in);
 }
}
