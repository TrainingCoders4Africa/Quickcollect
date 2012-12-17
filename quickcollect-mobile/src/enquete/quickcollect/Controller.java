package enquete.quickcollect;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import java.lang.Integer;;

public class Controller extends Activity {
	String  KEY_ID ;
	static final String KEY_IDQ = "idQ";
	static final String KEY_REP = "rep";
	 @Override
	    public void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	      //  setContentView(R.layout.activity_home);
	        Intent in = getIntent();
	        
	        // Get XML values from previous intent
	       String name = in.getStringExtra(KEY_ID);
	       
	       int ind = Integer.parseInt(name);
	        if(ind == 0){
	        	// renvoyer le i au niveau de l'activité NewFiche
	        	Intent intent = new Intent(getApplicationContext(), NewFiche.class);
	    		intent.putExtra(KEY_ID, 0);
	    		startActivity(intent);
	        	
	        }
	        else
	        {
	        	if(ind!=0){
	        	   // on récupere id, idQ,rep enregistrer dans la base incrémenté i et renvoyer au NewFiche
	        		
	        		
	            }
	        
	        }
	        
	        
	        //
	       
	       
	    }

}
