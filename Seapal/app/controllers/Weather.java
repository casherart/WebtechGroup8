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

public class Weather extends Controller {
  
	public static Result insert() {
  
		DynamicForm data = form().bindFromRequest();
		Connection conn = DB.getConnection();
		Statement query;            
		ResultSet result;
		ObjectNode respJSON = Json.newObject();
		int nextId = 0;

		try {
			query = conn.createStatement();
			
			if(data.get("wId") != "") {
				query.execute("UPDATE seapal_weather SET"
					+ " temperatur = " + data.get("temp")
						+ ", airpreasure = " + data.get("airpress")
							+ ", wind_strength = " + data.get("wind_strength")
								+ ", wind_direction = " + data.get("wind_direction")
									+ ", wave_height = " + data.get("whight")
										+ ", wave_direction = " + data.get("wave_direction")
											+ ", clouds = " + data.get("clouds")
												+ ", rain = " + data.get("rain")
													+ " WHERE ID = " + data.get("wId") + " AND (bnr = 1 OR bnr = 2);");
			} else {
				query.execute("INSERT INTO seapal_weather(temperatur, airpreasure, wind_strength, wind_direction, wave_height, wave_direction, clouds, rain, tnr, bnr) VALUES("
					+ "'" + data.get("temp") + "',"
						+ "'" + data.get("airpress") + "',"
							+ "'" + data.get("wind_strength") + "',"
								+ "'" + data.get("wind_direction") + "',"
									+ "'" + data.get("whight") + "',"
										+ "'" + data.get("wave_direction") + "',"
											+ "'" + data.get("clouds") + "',"
												+ "'" + data.get("rain") + "',"
													+ "'" + data.get("trip") + "',1);");					
			}
			
			result = query.executeQuery("SHOW TABLE STATUS FROM seapal LIKE 'seapal_weather'");
			if (result.next()) {
				nextId = result.getInt("Auto_increment");
			}
			conn.close();

			respJSON.put("wId", "" + (nextId - 1));

		} catch (Exception e) {
			respJSON.put("wId", "Error: " + e);
		}

		return ok(respJSON);
	}
  
	public static Result delete(int wnr) {

		Connection conn = DB.getConnection();
		Statement query;            
		ResultSet result;
		ObjectNode respJSON = Json.newObject();
  
		try {
			query = conn.createStatement();
			query.execute("DELETE FROM seapal_weather WHERE tnr = " + wnr);

			conn.close();

			respJSON.put("wID", "ok");

		} catch (Exception e) {
			respJSON.put("wID", "Error: " + e);
		}
  
		return ok(respJSON);
	}
  
	public static Result load(int wID) {
		
		Connection conn = DB.getConnection();
		Statement query;
		ResultSet result;
		ObjectNode respJSON = Json.newObject();
		String str = "";

		if(conn != null)
		{
			try {
            	
				query = conn.createStatement();
    
				String sql = "SELECT  sw.id,"
					+ "sw.temperatur,"
						+ "sw.airpreasure,"
							+ "windStr.description as wind_strength,"
								+ "windDesc.description as wind_direction,"
									+ "sw.wave_height,"            		 
										+ "waveDesc.description as wave_direction,"
											+ "clouds.description as clouds,"
												+ "rain.description as rain,"
													+ "windDir.id as windDirId,"
														+ "windStr.id as windStrId,"
															+ "waveDir.id as waveDirId,"
																+ "clouds.id as cloudsId,"
																	+ "rain.id as rainId,"
																		+ "trip.titel as trip"
																			+ "FROM seapal_weather as sw LEFT JOIN wind_strength as windStr ON (sw.wind_strength = windStr.id)"
																				+ "LEFT JOIN wind_direction as windDir ON (sw.wind_direction = windDir.id)"							  	                        							  
																					+ "LEFT JOIN wave_direction as waveDir ON (sw.wave_direction = waveDir.id)"							  
																						+ "LEFT JOIN clouds ON (sw.clouds = clouds.id)"
																							+ "LEFT JOIN rain ON (sw.rain = rain.id)"
																								+ "LEFT JOIN direction as windDesc ON (windDesc.id = windDir.direction_id)"
																									+ "LEFT JOIN direction as waveDesc ON (waveDesc.id = waveDir.direction_id)"
																										+ "LEFT JOIN tripinfo as trip ON (sw.tnr = trip.tnr)"
																											+ "WHERE sw.id = " + wID;
	        
				result = query.executeQuery(sql);
                respJSON.put("status", "ok");
				respJSON.put("id", result.getString("id"));
				respJSON.put("temperature", result.getString("temperatur"));
				respJSON.put("airpreasure", result.getString("airpreasure"));
				respJSON.put("wind_strength", result.getString("wind_strength"));
				respJSON.put("wind_direction", result.getString("wind_direction"));
				respJSON.put("wave_height", result.getString("wave_height"));
				respJSON.put("wave_direction", result.getString("wave_direction"));
				respJSON.put("clouds", result.getString("clouds"));
				respJSON.put("windDirId", result.getString("windDirId"));
				respJSON.put("windStrId", result.getString("windStrId"));
				respJSON.put("waveDirId", result.getString("waveDirId"));
				respJSON.put("cloudsId", result.getString("cloudsId"));
				respJSON.put("rainId", result.getString("rainId"));
				respJSON.put("rain", result.getString("rain"));
				respJSON.put("trip", result.getString("trip"));
				
			conn.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	return ok(respJSON);
}

public static Result index() {
	// Verbindung aufbauen
	Connection conn = DB.getConnection();
	String trip = "", wind_str = "", clouds = "", rain = "", wind_dir = "", wave_dir = "";
	String weatherTable = "";
	  
	if(conn != null)
	{
		// Formularoptionen für Trips abrufen
		trip = getFormOptions("SELECT tnr as id, titel as description FROM tripinfo ORDER BY tnr asc;", conn);
		// Formularoptionen für Windstaerke abrufen
		wind_str = getFormOptions("SELECT id, description FROM wind_strength ORDER BY id asc;", conn);		
		// Formularoptionen für Wolken abrufen
		clouds = getFormOptions("SELECT id, description FROM clouds ORDER BY id asc;", conn);		
		// Formularoptionen für Regen abrufen
		rain = getFormOptions("SELECT id, description FROM rain ORDER BY id asc;", conn);		
		// Formularoptionen für Windrichtung abrufen
		wind_dir = getFormOptions("SELECT wd.id as id, d.description as description FROM wind_direction as wd left join direction as d on wd.direction_id = d.id ORDER BY id asc;", conn);		
		// Formularoptionen für Wellenrichtung abrufen
		wave_dir = getFormOptions("SELECT wd.id as id, d.description as description FROM wave_direction as wd left join direction as d on wd.direction_id = d.id ORDER BY id asc;", conn);		
		// Wetter Table
		weatherTable = getWeatherTable("SELECT id FROM seapal_weather WHERE bnr = 1 OR bnr = 2 order by id", conn);		
			
	}
	return ok(weather.render(header.render(), navigation.render("app_map"), navigation_app.render("app_weather"), weatherTable, trip, wind_str, clouds, rain, wind_dir, wave_dir));
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
	
private static String getWeatherTable(String sql, Connection conn) {
	Statement query;
	ResultSet result;
	String data = "";
	try {
		// Wettereintraege holen
		query = conn.createStatement();
		// Sql Abfrage ausführen
		result = query.executeQuery(sql);
			
		StringBuilder row = new StringBuilder();
		while (result.next()) {
			row.append("addWeatherToTable(" + result.getString("id") + ");");
			data += row.toString();
		}
	} catch (Exception e) {
		e.printStackTrace();
	} 
	return data;
} 
}