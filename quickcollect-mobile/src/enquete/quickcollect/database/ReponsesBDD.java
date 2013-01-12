package enquete.quickcollect.database;

import java.sql.Array;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Map;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

public class ReponsesBDD {
	private static final int VERSION_BDD = 1;
	private static final String NOM_BDD = "idev.db";
 
	private static final String TABLE_REPONSES = "table_reponses_fiches";
	private static final String COL_ID = "ID";
	private static final int NUM_COL_ID = 0;
	private static final String COL_ENQTEUR = "ID_ENQTEUR";
	private static final int NUM_COL_ENQTEUR = 1;
	private static final String COL_RUBR = "ID_RUBR";
	private static final int NUM_COL_RUBR = 2;
	private static final String COL_IDQUES = "IDQUESTION";
	private static final int NUM_COL_IDQUES = 3;
	private static final String COL_REP = "Reponse";
	private static final int NUM_COL_REP = 4;
	private  ArrayList<String>  tabidfiche = new ArrayList<String>();
	
	
	private SQLiteDatabase bdd;
	 
	private BaseReponsesFiches maBaseSQLite;
	public ReponsesBDD(Context context) {
		// TODO Auto-generated constructor stub
		maBaseSQLite = new BaseReponsesFiches(context, NOM_BDD, null, VERSION_BDD);

	}
	


		// ouverture en lecture ecriture
		public void open(){
			//on ouvre la BDD en écriture
			bdd = maBaseSQLite.getWritableDatabase();
		}
		
		// fermeture
		public void close(){
			//on ferme l'accès à la BDD
			bdd.close();
		}
		
		public SQLiteDatabase getBDD(){
			return bdd;
		}
		public long insertReponsesFiches(ReponsesFiches rf){
			//Création d'un ContentValues (fonctionne comme une HashMap)
			ContentValues values = new ContentValues();
			//on lui ajoute une valeur associé à une clé (qui est le nom de la colonne dans laquelle on veut mettre la valeur)
			values.put(COL_ID, rf.getIdfiche());
			values.put(COL_ENQTEUR, rf.getIdenqueteur());
			values.put(COL_RUBR, rf.getIdrubrique());
			values.put(COL_IDQUES, rf.getIdquestion());
			values.put(COL_REP, rf.getReponse());
			//on insère l'objet dans la BDD via le ContentValues
			return bdd.insert(TABLE_REPONSES, null, values);
		}
		
		public ReponsesFiches getReponses(){
			//Récupère dans un Cursor les valeur correspondant à un livre contenu dans la BDD (ici on sélectionne le livre grâce à son titre)
			Cursor c = bdd.query(TABLE_REPONSES, new String[] {COL_ID, COL_ENQTEUR, COL_RUBR, COL_IDQUES, COL_REP}, null, null, null, null, null);
			return cursorToReponsesFiches(c);
		}
	 public ArrayList<String> getIdFiches(){
		 Cursor result = bdd.rawQuery("SELECT DISTINCT "+COL_ID+" from "+TABLE_REPONSES, null);
		
		 // parcours result
		 if(result == null)
			  return null;
		 
		 result.moveToFirst();
		 while (!result.isAfterLast()) {
		 String idfiche = result.getString(0);
		 tabidfiche.add (idfiche);
		
		 // Faire quelque chose de ces valeurs...
		 result.moveToNext();
		 }
		 result.close();
		 return tabidfiche; 
	 }
	 public Cursor getFichesById(String id){
		 
		 Cursor result = bdd.rawQuery("SELECT *  from "+TABLE_REPONSES+" where "+COL_ID+"  = '"+id+"'", null);
		  if(result == null)
			  return null;
		  else
		 return result;
	 }
	 
	 public int suppfiche(String id){
		 //bdd.rawQuery("DELETE  from "+TABLE_REPONSES+" where "+COL_ID+"  = '"+id+"'", null);
		return bdd.delete(TABLE_REPONSES, COL_ID + "= '" + id+ "'", null);
	 }
		//Cette méthode permet de convertir un cursor en un livre
		private ReponsesFiches cursorToReponsesFiches(Cursor c){
			//si aucun élément n'a été retourné dans la requête, on renvoie null
			if (c.getCount() == 0)
				return null;
	 
			//Sinon on se place sur le premier élément
			c.moveToFirst();
			//On créé un livre
			ReponsesFiches rep = new ReponsesFiches();
			//on lui affecte toutes les infos grâce aux infos contenues dans le Cursor
			rep.setIdfiche(c.getString(NUM_COL_ID));
			rep.setIdquestion(c.getString(NUM_COL_IDQUES));
			rep.setReponse(c.getString(NUM_COL_REP));
			//On ferme le cursor
			c.close();
	 
			//On retourne le livre
			return rep;
		}
		

}
