package enquete.quickcollect;

import java.util.ArrayList;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import enquete.quickcollect.database.BaseReponsesFiches;
import enquete.quickcollect.database.ReponsesBDD;
import android.app.Activity;
import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.os.StrictMode;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

public class ListeFiches extends ListActivity {
	 HttpClient httpclient ;
	 HttpPost httppost;
	 static  String KEY_NAME ;
	 String id_enqueteur;
	
	public String getId_enqueteur() {
		return id_enqueteur;
	}

	public void setId_enqueteur(String id_enqueteur) {
		this.id_enqueteur = id_enqueteur;
	}

	public void onCreate(Bundle icicle) {
		
	    super.onCreate(icicle);
	    Intent in = getIntent();
	    String id = in.getStringExtra(KEY_NAME);
	    this.setId_enqueteur(id);
	    StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
	     StrictMode.setThreadPolicy(policy); 
        //ListView v = (ListView)findViewById(R.id.viewfiche);
        ReponsesBDD rbdd = new ReponsesBDD(this);
        rbdd.open();
        ArrayList<String> tabindices = rbdd.getIdFiches();
        if(tabindices.size() == 0){
        	Toast.makeText(this,"Liste Vide", Toast.LENGTH_LONG).show();
        	Toast.makeText(this,this.getId_enqueteur(), Toast.LENGTH_LONG).show();

        }
        else
        {
          setListAdapter(new MobileArrayAdapter(this, tabindices));
        
        }
    }
	
	@Override
	protected void onListItemClick(ListView l, View v, int position, long id) {
      
		//get selected items
		String selectedValue = (String) getListAdapter().getItem(position);
		ReponsesBDD rbdd = new ReponsesBDD(this);
        rbdd.open();
        Cursor c = rbdd.getFichesById(selectedValue);
        if(c == null)
        	Toast.makeText(this, "Ereur Pase de données a envoyer", Toast.LENGTH_SHORT).show();	
        else
        {
        	c.moveToFirst();
   		   while (!c.isAfterLast()) {
   		  String idfiche = c.getString(0);
   		  String enq = c.getString(1);
   		  String rub = c.getString(2);
   		  String iques = c.getString(3);
   		  String rep = c.getString(4);
   		  sendData(idfiche, enq, rub, iques, rep);
   		   c.moveToNext();
   		 }
   		 
   		   int i=rbdd.suppfiche(selectedValue);
           if(i>0){
        	   Intent in = new Intent(getApplicationContext(), ListeFiches.class);
   		    in.putExtra(KEY_NAME, this.getId_enqueteur());
   			startActivity(in);
        	   
           }
        	   //Toast.makeText(this, "suppression ok", Toast.LENGTH_SHORT).show(); 
          
        }
		//Cursor c = 
		//Toast.makeText(this, selectedValue, Toast.LENGTH_SHORT).show();
 
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
                 //  HttpEntity entity = response.getEntity();
                  //InputStream is = entity.getContent();
                     Log.i("postData", response.getStatusLine().toString());
                      }
                      catch(Exception e)
                      {
                          Log.e("log_tag", "Error:  "+e.toString());
                      }
		 
	 }
	
	/*protected void onListItemClick(ListView l, View v, int position, long id) {
	    String item = (String) getListAdapter().getItem(position);
	    Toast.makeText(this, item + " selected", Toast.LENGTH_LONG).show();
	  }*/
  
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
		    Intent in = new Intent(getApplicationContext(), ListeFiches.class);
		    in.putExtra(KEY_NAME, this.getId_enqueteur());
			startActivity(in); 
		 
	 }
	 private void suppbase(){
		BaseReponsesFiches bdr = new BaseReponsesFiches(this, "idev.db", null, 1);
		
		SQLiteDatabase db = bdr.getWritableDatabase();
		bdr.onUpgrade(db, 1, 2);
		
		 
	 }

}