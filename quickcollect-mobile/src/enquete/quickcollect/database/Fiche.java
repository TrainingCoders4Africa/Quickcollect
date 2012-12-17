package enquete.quickcollect.database;

public class Fiche {
    
	private int id;
	
	public Fiche() {
		// TODO Auto-generated constructor stub
	}
	public Fiche(int i) {
		// TODO Auto-generated constructor stub
		setId(i);
	}
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String toString(){
		return "ID : "+id;
	}

}
