var activeDelete = false;
var activeModify = false;
var activeAdd = false;
var saved = false;

var inputMode = false;
var clonedTable = "";
var pressedBtn = "";

var clave = [];
var grupo = [];
var professor = [];

$(document).ready(function() {
	
	$("#settings").click (function(e){
		if (!activeDelete && !activeAdd) {
			e.preventDefault();
			modifiableTabe();
		}
	});
	
	$("#add").click (function(e){
		if(!activeDelete && !activeModify) {
			e.preventDefault();
			addableTable();
		}
	});
	
	$("#delete").click (function(e){

		if (!activeModify && !activeAdd){
			e.preventDefault();
			console.log("achoo");
			deletableTable();
		}
		
	});
	
	$("#save").click (function(e){

		e.preventDefault();
		saveChanges(pressedBtn);
		
	});
	
	$("#saveNewRecord").click (function(e){

		e.preventDefault();
		addTableRow();


		
	});

	$("#dropDownMateria").change(function(e){
    	e.preventDefault();
    	console.log("Se cambio el valor del drop down");
    	chargeGroups();
	});
	
});


function addableTable() {
	pressedBtn = "add";
	
	var newRowFieldset = document.getElementById("newRowFieldset");
	
	if(!activeAdd) {
		
		var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/blocked5.png" ;
		var deleteBtn = document.getElementById("delete").firstChild.nextSibling.src = "../views/img/blocked5.png" ;

		newRowFieldset.style.display  = "block";
		activeAdd = true;
		chargeGroups();
		
	} else {
		
		var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/gear.png" ;
		var deleteBtn = document.getElementById("delete").firstChild.nextSibling.src = "../views/img/delete10.png" ;

		newRowFieldset.style.display = "none";
		activeAdd = false;
	}
}


function addTableRow() {
	
	var action = "Asignaciones";
	var type = "ModificarBD";
	var modificationType = "Agregar";
	
	var newClave = $('select[name=materia]').val();
	var newGrupo = $('select[name=grupo]').val();
	var newProfessor = $('select[name=professor]').val();
	
	var jsonToSend = {
		"action" : action,
		"type" : type,
		"modificationType" : modificationType,
		"clave" : newClave,
		"grupo" : newGrupo,
		"professor" : newProfessor
	};
	
	
	$.ajax({
		
		url: "index.php",
		cache : false,
		type : "POST",
		data : jsonToSend,
		ContentType : "application/json",
		dataType : "json",
		
		
		
		error : function(errorMessage, textStatus, errorThrown) {
		        console.log(errorMessage);
		        console.log(textStatus);
		        console.log(errorThrown);
		},
		
		success: function(dataRecieved) {
			
			console.log("modified rows: " + dataRecieved);
			
			if (dataRecieved == 0)
				alert("No fue posible crear el curso deseado");
			else if (dataRecieved == 1) {
				
				$("#assignationsTable").append('<tr><td>' + newClave  + '</td><td>' + newGrupo + '</td><td>'  + newProfessor + '</td></tr>');
				saveTable();
				addableTable();
				alert("Se agrego con exito el curso: " + newClave);
			}
		}
	});

	console.log(newClave);
		
	console.log(newGrupo);

	console.log(newProfessor);
}

function deleteTableRow(rowIndex, materia, grupo, correo) {
	
	var table = document.getElementById("assignationsTable");
	
	var txt;
	var response = confirm("¿Estás seguro de querer borrar al maestro con correo " + correo + " del curso " + materia+ " grupo " + grupo +"?");

	if (response == true) {

		var action = "Asignaciones";
		var type = "ModificarBD";
		var modificationType = "Borrar";
		
		var jsonToSend = {
			"action" : action,
			"type" : type,
			"modificationType" : modificationType,
			"materia" : materia,
			"grupo" : grupo,
			"correo" : correo
		};

		$.ajax({
			
			ulr: "index.php",
			cache: false,
			type: "POST",
			data: jsonToSend,
			ContentType: "application/json",
			dataType: "json",
			
			error : function(errorMessage, textStatus, errorThrown) {
				console.log(errorMessage);
				console.log(textStatus);
		        console.log(errorThrown);
			},
			
			success: function(dataRecieved) {
				
				console.log(JSON.stringify(dataRecieved));
				
				if (dataRecieved == 0)
					alert("No fue posible dar de baja al profesor de ese curso");
				else if (dataRecieved == 1) {
					
					alert("Se dio de baja con exito al profesor de la clase " + materia + " grupo " + grupo +".");
					table.deleteRow(rowIndex);
				}
			}
		});
		
		
	}
}
	
	
function deletableTable() {
	
	pressedBtn = "delete";
	var table = document.getElementById("assignationsTable");

	if (!activeDelete){
		var addBtn = document.getElementById("add").firstChild.nextSibling.src = "../views/img/blocked5.png";
		var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/blocked5.png";

		var tr = table.rows[0];
		th = document.createElement('th');
		tr.appendChild(th);
		
		for (var i = 1, row; row = table.rows[i]; i++) {
	   	//iterate through rows
	   	//rows would be accessed using the "row" variable assigned in the for loop


	  		var cell = row.insertCell(row.cells.length);
    		cell.innerHTML = "<button class = 'option' > <img src='../views/img/delete6.png' height='15' width='15'></button>";
    		deleteBtn = cell.firstChild;
			console.log(deleteBtn.parentNode.parentNode.firstChild.nextSibling.innerHTML)
			console.log(deleteBtn.parentNode.parentNode.firstChild.nextSibling.nextElementSibling.innerHTML);
			console.log(deleteBtn.parentNode.parentNode.firstChild.nextSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML);
			
    		deleteBtn.addEventListener("click", function(){ /*table.deleteRow(this.parentNode.parentNode.rowIndex);*/
    														deleteTableRow(this.parentNode.parentNode.rowIndex, 
															this.parentNode.parentNode.firstChild.nextSibling.innerHTML,
															this.parentNode.parentNode.firstChild.nextSibling.nextElementSibling.innerHTML,
															this.parentNode.parentNode.firstChild.nextSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML);  } ); //nanitf

		}
		
		activeDelete = true;
		
		} else {

			var addBtn = document.getElementById("add").firstChild.nextSibling.src = "../views/img/plus.png" ;
			var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/gear.png" ;

			console.log("BOTON:" + addBtn.innerHTML);


			var table = document.getElementById("assignationsTable");

			for (var i = 0, row; row = table.rows[i]; i++){

				row.deleteCell(row.cells.length - 1);
			}

			saveTable();
			activeDelete = false;


		}

	 //table.insertRow(0);

	 console.log("hola");

}

function cleanFieldset(){

		var textInputs = $("#newRowFieldset :text");
		var warnings = $("#newRowFieldset [name = 'err']");

		for( var i = 0; i < textInputs.length; i++) 
	    {
	        	 	$(warnings[i]).css("display","none");
	        	 	textInputs[i].placeholder = "";
	        	 	textInputs[i].value = "";
	    }

}

function saveTable(){

	var table = document.getElementById("assignationsTable");
	clonedTable = table.innerHTML;
	console.log(clonedTable);


}

function chargeGroups(){

		var action = "Asignaciones";
		var type = "CargarGrupos";
		var actualTopic = $("#dropDownMateria").val();

		console.log(actualTopic);

		var jsonToSend = {
			"action" : action,
			"type" : type,
			"actualTopic" : actualTopic
		};


		
		$.ajax({
			
			ulr: "index.php",
			cache: false,
			type: "POST",
			data: jsonToSend,
			ContentType: "application/json",
			dataType: "json",
			
			error : function(errorMessage, textStatus, errorThrown) {
				console.log(errorMessage);
				console.log(textStatus);
		        console.log(errorThrown);
			},
			
			success: function(dataRecieved) {
				
				//console.log(JSON.stringify(dataRecieved));
				var groups = document.getElementById("dropDownGrupo");

				var content = "";

				for (var i = 0; i < Object.keys(dataRecieved).length; i++){

					console.log("grupo: " + JSON.stringify(dataRecieved[i]) );

					content += ("<option value ='" + dataRecieved[i] + "'>" + dataRecieved[i] + "</option>"
								);
				}

				groups.innerHTML = content;
				
			}
		});


}




