package enquete.quickcollect.database;

public class ReponsesFiches {
	
    private String idfiche;
    private String idenqueteur;
    private String idrubrique;
    private String idquestion;
    private String reponse;
	public ReponsesFiches() {
		// TODO Auto-generated constructor stub
	}
	public String getIdenqueteur() {
		return idenqueteur;
	}
	public void setIdenqueteur(String idenqueteur) {
		this.idenqueteur = idenqueteur;
	}
	public String getIdrubrique() {
		return idrubrique;
	}
	public void setIdrubrique(String idrubrique) {
		this.idrubrique = idrubrique;
	}
	public ReponsesFiches(String i,String enqueteur,String rub,String ques, String rep) {
		// TODO Auto-generated constructor stub
		setIdfiche(i);
		setIdenqueteur(enqueteur);
		setIdrubrique(rub);
		setIdquestion(ques);
		setReponse(rep);
	}
	public String getIdfiche() {
		return idfiche;
	}
	public void setIdfiche(String idfiche) {
		this.idfiche = idfiche;
	}
	public String getIdquestion() {
		return idquestion;
	}
	public void setIdquestion(String idquestion) {
		this.idquestion = idquestion;
	}
	public String getReponse() {
		return reponse;
	}
	public void setReponse(String reponse) {
		this.reponse = reponse;
	}
	
	

}
