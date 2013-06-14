package controllers;

import play.*;
import play.mvc.*;
import play.db.*;
import java.sql.*;
import javax.sql.*;
import play.libs.Json;
import play.data.DynamicForm;
import org.codehaus.jackson.node.ObjectNode; 
import views.html.*;
import views.html._include.*;
import java.util.List;
import java.util.ArrayList;
import java.util.Random;
import java.util.GregorianCalendar;

public class Map extends Controller {

	public static Result index() {
		return ok(map.render(header.render(), header_app.render(), navigation.render("app_map"), navigation_app.render("app_map")));
	}

	public static Result getLogWeatherWindow(){
		// Verbindung aufbauen
		Connection conn = DB.getConnection();
		String trip = "";

		if(conn != null){
			trip = getFormOptions("SELECT tnr as id, titel as description FROM tripinfo ORDER BY tnr asc;", conn);
		}
		return ok(app_weather_log_window.render(trip));
	}

	public static Result getWeatherWarning(){
		
		ObjectNode respJSON = Json.newObject();
		String msg = "Keine Meldungen";
		Random r = new Random();
		int Low = 0;
		int High = 100;
		int rand = r.nextInt(High-Low) + Low;
		
		if(rand > 90){
			msg = "Starke Gewitter:<br>In Verbindung mit Sturmböen, schweren Sturmböen, Starkregen oder Hagel";
		}else if(rand > 80){
			msg = "Eisglätte:<br>durch überfrierende Nässe nach starker Taubildung, durch sehr starke Reifablagerungen oder bei vorhandener frischer Schneedecke";
		}else if(rand > 75){
			msg = "Warnung vor Dauerregen:<br>In Teilen Süddeutschlands noch schauerartige Regenfälle. ";
		}else if(rand > 70){
			msg = "Warnung vor Wind- und Sturmböen:<br>Überlinger und Untersee starke bis stürmische Böen aus Nordwesten bis Norden. Dabei Böen 7 Bft (um 55 km/h), am Untersee und in Hochlagen auch 8 Bft (um 70 km/h). ";
		}
		respJSON.put("warningLevel", rand);
		respJSON.put("msg", msg);
		respJSON.put("timestamp", new GregorianCalendar().getTimeInMillis());
		try{
			Thread.sleep(5000);			
		}catch(InterruptedException e){
			System.out.print("");
		}
		return ok(respJSON);
	}

	private static String getFormOptions(String sql, Connection conn) {
		Statement query;
		ResultSet result;
		String data = "";
		try {
			// Abfrage erzeugen
			query = conn.createStatement();
			// Sql Abfrage ausführen und Eintraege speichern
			result = query.executeQuery(sql);
			while (result.next()) {
				StringBuilder row = new StringBuilder();
				row.append("<option value='" + result.getString(1) + "'>" + result.getString(2) + "</option>");
				data += row.toString();
			}
		} catch (Exception e) {
			e.printStackTrace();
		}  
		return data;
	}

}