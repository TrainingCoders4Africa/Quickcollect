package enquete.quickcollect;


import java.util.ArrayList;
import java.util.HashMap;
import android.app.ListActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.CheckBox;
import android.widget.ListView;

public class checkBoxListVue extends ListActivity {
    private ListView list;
	
	/** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main_list);
        
        //R�cup�ration automatique de la liste (l'id de cette liste est nomm� obligatoirement @android:id/list afin d'�tre d�tect�)
		list = getListView();
        
		// Cr�ation de la ArrayList qui nous permettra de remplir la listView
		ArrayList<HashMap<String, String>> listItem = new ArrayList<HashMap<String, String>>();

		// On d�clare la HashMap qui contiendra les informations pour un item
		HashMap<String, String> map;

		map = new HashMap<String, String>();
		map.put("nom", "Mouse");
		map.put("prenom", "Mickey");
		listItem.add(map);

		map = new HashMap<String, String>();
		map.put("nom", "Bunny");
		map.put("prenom", "Bugs");
		listItem.add(map);

		//Utilisation de notre adaptateur qui se chargera de placer les valeurs de notre liste automatiquement et d'affecter un tag � nos checkbox

		MyListAdapter mSchedule = new MyListAdapter(this.getBaseContext(), listItem,
				R.layout.detail_list, new String[] { "nom", "prenom" }, new int[] {
						R.id.nom, R.id.prenom });

		// On attribue � notre listView l'adaptateur que l'on vient de cr�er
		list.setAdapter(mSchedule);
    }
    
    //Fonction appel�e au clic d'une des checkbox
	public void MyHandler(View v) {
		CheckBox cb = (CheckBox) v;
		//on r�cup�re la position � l'aide du tag d�fini dans la classe MyListAdapter
		int position = Integer.parseInt(cb.getTag().toString());
		
		// On r�cup�re l'�l�ment sur lequel on va changer la couleur
		View o = list.getChildAt(position).findViewById(
				R.id.blocCheck);

		//On change la couleur
		if (cb.isChecked()) {
			o.setBackgroundResource(R.color.green);
		} else {
			o.setBackgroundResource(R.color.blue);
		}
	}
}
