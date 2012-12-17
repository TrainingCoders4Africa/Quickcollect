package enquete.quickcollect;

import java.io.InputStream;
import android.content.Context;
import android.app.Activity;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;

import android.content.res.*;

public class ParseXml extends Activity {

	public ParseXml() {
		// TODO Auto-generated constructor stub
	}
	
	// parser from asset
	public Document XMLfromAsset(){
       
		AssetManager mgr = getAssets();
		Document document = null;
		try{
		InputStream in = mgr.open("machin.xml");
		 
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
