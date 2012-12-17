package enquete.quickcollect.database;

import android.content.Context;
import android.database.DatabaseErrorHandler;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteDatabase.CursorFactory;
import android.database.sqlite.SQLiteOpenHelper;

public class BaseReponsesFiches extends SQLiteOpenHelper {
	private static final String TABLE_REPONSES = "table_reponses_fiches";
	private static final String COL_ID = "ID";
	private static final String COL_ENQTEUR = "ID_ENQTEUR";
	private static final String COL_RUBR = "ID_RUBR";
	private static final String COL_IDQUES = "IDQUESTION";
	private static final String COL_REP = "Reponse";
 
	private static final String CREATE_BDD = "CREATE TABLE " + TABLE_REPONSES + " ("
	+ COL_ID + " INTEGER, " + COL_ENQTEUR + " TEXT NOT NULL, " + COL_RUBR + " TEXT NOT NULL, " + COL_IDQUES + " TEXT NOT NULL, "
	+ COL_REP + " TEXT NOT NULL);";
	public BaseReponsesFiches(Context context, String name,
			CursorFactory factory, int version) {
		super(context, name, factory, version);
		// TODO Auto-generated constructor stub
	}
	
	

	@Override
	public void onCreate(SQLiteDatabase db) {
		// TODO Auto-generated method stub
        db.execSQL(CREATE_BDD);
	}

	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
		// TODO Auto-generated method stub
		db.execSQL("DROP TABLE " + TABLE_REPONSES + ";");
		onCreate(db);

	}

}
