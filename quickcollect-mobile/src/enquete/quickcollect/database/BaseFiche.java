package enquete.quickcollect.database;

import android.content.Context;
import android.database.DatabaseErrorHandler;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteDatabase.CursorFactory;
import android.database.sqlite.SQLiteOpenHelper;

public class BaseFiche extends SQLiteOpenHelper {
    
	private static final String TABLE_FICHE = "table_fiche";
	private static final String COL_ID = "ID";
 
	private static final String CREATE_BDD = "CREATE TABLE IF NOT EXISTS " + TABLE_FICHE + " ("
	+ COL_ID + " INTEGER PRIMARY KEY AUTOINCREMENT );" ;
	public BaseFiche(Context context, String name, CursorFactory factory,
			int version) {
		super(context, name, factory, version);
		// TODO Auto-generated constructor stub
	}

	

	@Override
	public void onCreate(SQLiteDatabase db) {
		// TODO Auto-generated method stub
        db.execSQL(CREATE_BDD);
	}

	@Override
	public void onUpgrade(SQLiteDatabase db, int oldversion, int newversion) {
		// TODO Auto-generated method stub
		db.execSQL("DROP TABLE " + TABLE_FICHE + ";");
		onCreate(db);

	}

}
