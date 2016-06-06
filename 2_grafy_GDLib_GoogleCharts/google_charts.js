google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawChart);

var graph_data_column = [["2012/13",62,20,11,13,7,5,0,1],
						["2013/14",53,20,19,6,3,1,0,0],
						["2014/15",53,9,19,22,0,0,0,3]];

var graph_data_pie13 = [["A",20],["B",11],["C",13],["D",7],["E",5],["FX",0],["FN",1]];
var graph_data_pie14 = [["A",20],["B",19],["C",6],["D",3],["E",1],["FX",0],["FN",0]];
var graph_data_pie15 = [["A",9],["B",19],["C",22],["D",0],["E",0],["FX",0],["FN",3]];
			
			
function drawChart(){
	
	var data_columnchart = new google.visualization.DataTable();
	data_columnchart.addColumn('string','rok');
	data_columnchart.addColumn('number','celkovo');
	data_columnchart.addColumn('number','A');
	data_columnchart.addColumn('number','B');
	data_columnchart.addColumn('number','C');
	data_columnchart.addColumn('number','D');
	data_columnchart.addColumn('number','E');
	data_columnchart.addColumn('number','FX');
	data_columnchart.addColumn('number','FN');
	
	data_columnchart.addRows(graph_data_column);
				
	var data_piechart13 = new google.visualization.DataTable();
	data_piechart13.addColumn('string', 'znamka');
	data_piechart13.addColumn('number', 'pocet');
	
	var data_piechart14 = new google.visualization.DataTable();
	data_piechart14.addColumn('string', 'znamka');
	data_piechart14.addColumn('number', 'pocet');
	
	var data_piechart15 = new google.visualization.DataTable();
	data_piechart15.addColumn('string', 'znamka');
	data_piechart15.addColumn('number', 'pocet');
	
	data_piechart13.addRows(graph_data_pie13);				
	data_piechart14.addRows(graph_data_pie14);				
	data_piechart15.addRows(graph_data_pie15);					
		
	var options_columnchart = {
		title: 'Štatistika výsledkov študentov z predmetu v akademických rokoch 2012/13 - 2014/15',					
		legend: { position: 'top', maxLines: 1 },
		hAxis: {title:'ak. rok'},
		vAxis: {title: 'počet študentov', slantedTextAngle:90}
	};
	
	var options_piechart13 = {
		width:400,
		height:400,
		title: '2012/13',
		is3D: false,
		position: 'labeled'
	}
	var options_piechart14 = {
		width:400,
		height:400,
		title: '2013/14',
		is3D: false,
		position: 'labeled'
	}
	var options_piechart15 = {
		width:400,
		height:400,
		title: '2014/15',
		is3D: false,
		position: 'labeled'
	}
	
	var chart_column = new google.visualization.ColumnChart(document.getElementById('column'));
	var chart_pie13 = new google.visualization.PieChart(document.getElementById('pie13'));
	var chart_pie14 = new google.visualization.PieChart(document.getElementById('pie14'));
	var chart_pie15 = new google.visualization.PieChart(document.getElementById('pie15'));
	
	chart_column.draw(data_columnchart,options_columnchart);
	chart_pie13.draw(data_piechart13,options_piechart13);
	chart_pie14.draw(data_piechart14,options_piechart14);
	chart_pie15.draw(data_piechart15,options_piechart15);
}