package enquete.quickcollect;


import java.util.List;
import java.util.Map;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.SimpleAdapter;

public class MyListAdapter extends SimpleAdapter
{
	private LayoutInflater	mInflater;

	public MyListAdapter (Context context, List<? extends Map<String, ?>> data,
			int resource, String[] from, int[] to)
	{
		super (context, data, resource, from, to);
		mInflater = LayoutInflater.from (context);

	}

	@Override
	public Object getItem (int position)
	{
		return super.getItem (position);
	}

	@Override
	public View getView (int position, View convertView, ViewGroup parent)
	{
		//Ce test permet de ne pas reconstruire la vue si elle est d�j� cr��e
		if (convertView == null)
		{
			// On r�cup�re les �l�ments de notre vue
			convertView = mInflater.inflate (R.layout.detail_list, null);
			// On r�cup�re notre checkBox
			CheckBox cb = (CheckBox) convertView.findViewById (R.id.check);
			// On lui affecte un tag comportant la position de l'item afin de
			// pouvoir le r�cup�rer au clic de la checkbox
			cb.setTag (position);
		}
		return super.getView (position, convertView, parent);
	}

}

