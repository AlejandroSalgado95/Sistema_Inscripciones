

var activeDelete = false;
var activeModify = false;
var activeAdd = false;
var saved = false;

var inputMode = false;
var clonedTable = "" ;
var pressedBtn = "";

var id = [];
var capacity = [];
var deptAdmin = [];

$(document).ready(function() {

	$("#settings").click (function(e){

		if (!activeDelete && !activeAdd){

			e.preventDefault();
			modifiableTable();
		}
		
	});


	$("#add").click (function(e){

		if (!activeDelete && !activeModify){
			e.preventDefault();
			addableTable();
		}
		
	});

	$("#delete").click (function(e){

		if (!activeModify && !activeAdd){
			e.preventDefault();
			deletableTable();
		}
		
	});

	$("#save").click (function(e){

		e.preventDefault();
		saveChanges(pressedBtn);
		
	});

	$("#saveNewRecord").click (function(e){

		e.preventDefault();
		if (!validateNewRecord( $("#newRowFieldset :text"), $("#newRowFieldset [name = 'err']") ) ){

			console.log("NO FALTO NINGUN CAMPO NECESARIO");
			addTableRow();



		} else {

			console.log("FALTARON CAMPOS NECESARIOS POR LLENAR");

		}
		
	});



});


function deletableTable() {

	pressedBtn = "delete";
	var table = document.getElementById("classroomTable");

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
    		deleteBtn.addEventListener("click", function(){ /*table.deleteRow(this.parentNode.parentNode.rowIndex);*/
    														deleteTableRow(this.parentNode.parentNode.rowIndex, this.parentNode.parentNode.firstChild.nextSibling.innerHTML);  } );

		}

		activeDelete = true;

	} else {

		var addBtn = document.getElementById("add").firstChild.nextSibling.src = "../views/img/plus.png" ;
		var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/gear.png" ;

		console.log("BOTON:" + addBtn.innerHTML);

			var table = document.getElementById("classroomTable");

			for (var i = 0, row; row = table.rows[i]; i++){

				row.deleteCell(row.cells.length - 1);
			}


		saveTable();
		activeDelete = false;


	}
	 console.log("hola");


}


function modifiableTable() {

	pressedBtn = "modify";
	var table = document.getElementById("classroomTable");

	if (!activeModify){

		var addBtn = document.getElementById("add").firstChild.nextSibling.src = "../views/img/blocked5.png" ;
		var deleteBtn = document.getElementById("delete").firstChild.nextSibling.src = "../views/img/blocked5.png" ;

		saveTable();

		var saveBtn = document.getElementById("save");
		saveBtn.style.display = "block";

		for (var i = 1, row; row = table.rows[i]; i++) {
	   	//iterate through rows
	   	//rows would be accessed using the "row" variable assigned in the for loop

	   		for (var j = 1, col; col = row.cells[j]; j++) {
	    	 //iterate through columns
	    	 //columns would be accessed using the "col" variable assigned in the for loop
	    	    
	    	    //Esto tambien funciona
	    	    /*
	    	    var x = document.createElement("input");
				x.setAttribute("type", "text")
				x.value = col.innerHTML;
				col.innerHTML = "";
				col.appendChild(x);
				*/

				value = col.innerHTML;
				col.innerHTML = "<input type = 'text' value = '" + value + "' >";

	  		 }  

		}

		activeModify = true;

	} else {

		//var div = document.getElementById("tableDiv");
		var addBtn = document.getElementById("add").firstChild.nextSibling.src = "../views/img/plus.png" ;
		var deleteBtn = document.getElementById("delete").firstChild.nextSibling.src = "../views/img/delete10.png" ;

		if (!saved){

			var table = document.getElementById("classroomTable");
			table.innerHTML = clonedTable;


		} else {

			var table = document.getElementById("classroomTable");

			for (var i = 1, row; row = table.rows[i]; i++) {

		   		for (var j = 1, col; col = row.cells[j]; j++) {
		    	
		    	 	 col.innerHTML = col.firstChild.value;
		  		 }  

			}
		}

		saved = false;
		

		var saveBtn = document.getElementById("save");
		saveBtn.style.display = "none";

		activeModify = false;
	}

	 console.log("hola");



}



function addableTable(){

	
	pressedBtn = "add";

	if (!activeAdd){

		var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/blocked5.png" ;
		var deleteBtn = document.getElementById("delete").firstChild.nextSibling.src = "../views/img/blocked5.png" ;

		var newRowFieldset = document.getElementById("newRowFieldset");
		newRowFieldset.style.display = "block";
		activeAdd = true;

	} else {

		var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/gear.png" ;
		var deleteBtn = document.getElementById("delete").firstChild.nextSibling.src = "../views/img/delete10.png" ;

		cleanFieldset();
	    var newRowFieldset = document.getElementById("newRowFieldset");
		newRowFieldset.style.display = "none";
		activeAdd = false;

	}


}

function validateNewRecord(textInputs, warnings){

	var MissingInfo = false;

	for( var i = 0; i < textInputs.length; i++) 
    {
   		if (i == 0){

        	 if (textInputs[i].value == "")
        	 {
        		MissingInfo = true;
        		textInputs[i].placeholder = "Required";
        		$(warnings[i]).css("display","inline-block");

        	 }
        	 else{
        	 	$(warnings[i]).css("display","none");
        	 	textInputs[i].placeholder = "";

        	 }

        }
        	 	

    }
	
	return MissingInfo;

}


function addTableRow(){


		var action = "Salones";
		var type = "ModificarBD";
		var modificationType = "Agregar";


		var newId = $("#newRowFieldset :text")[0].value;
		var newCapacity = $("#newRowFieldset :text")[1].value;
		var newDeptAdmin = $("#newRowFieldset :text")[2].value;
	
	    var jsonToSend = {
			"action" : action,
			"type" : type,
			"modificationType" : modificationType,
			"id" : newId,
			"capacity" : newCapacity,
			"deptAdmin" : newDeptAdmin
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

			success: function(dataReceived){

					console.log("modified rows: " + dataReceived);

					if (dataReceived == 0)
						alert("No fue posible agregar al salón: " + newId + ", esto debido a que ya existe el salón. Para dar de alta al nuevo salón utilice una número diferente, o bien, elimine al salón que actualmente está ocupando dicha número." );
					else if (dataReceived == 1){

						$("#classroomTable").append('<tr><td>' + newId  + '</td><td>' + newCapacity + '</td><td>' + newDeptAdmin + '</td></tr>');
						saveTable();
						cleanFieldset();
						alert("Se agregó con éxito el salón: " + newId);
					}
						

			}
		});
		
		console.log(newId);
		
		console.log(newCapacity);

		console.log(newDeptAdmin);

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


function deleteTableRow(rowIndex, classroomID){

	var table = document.getElementById("classroomTable");


	var txt;
	var response = confirm("¿Estás seguro de querer borrar el salón : " + classroomID + "?");

	if (response == true) {

		var action = "Salones";
		var type = "ModificarBD";
		var modificationType = "Borrar";

	    //txt = "You pressed OK!";
	    var jsonToSend = {
			"action" : action,
			"type" : type,
			"modificationType" : modificationType,
			"id" : classroomID
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

			success: function(dataReceived){

					console.log("modified rows: " + dataReceived);

					if (dataReceived == 0)
						alert("No fue posible eliminar el salón: " + classroomID + ", esto debido a que el salón está asociado con al menos un curso. Para eliminar a este salón, primero modifique o elimine los cursos con los cuales este está asociado." );
					else if (dataReceived == 1){

						alert("Se eliminó con éxito el salón: " + classroomID);
						table.deleteRow(rowIndex);
					}
						

			}
		});




	} 

}


function saveTable(){

	var table = document.getElementById("classroomTable");
	clonedTable = table.innerHTML;
	console.log(clonedTable);


}


function saveChanges(actionedButton){

	saved = true;

	if (pressedBtn == "modify"){

		modifiableTable();

		prepareJsonTable();

		var action = "Salones";
		var type = "ModificarBD";
		var modificationType = "Editar";
		
		var jsonToSend = {
			"action" : action,
			"type" : type,
			"modificationType" : modificationType,
			"id" : id,
			"capacity" : capacity,
			"deptAdmin" : deptAdmin
		};

		console.log(id);
		console.log(capacity);
		console.log(deptAdmin);
		
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

			success: function(dataReceived){

					console.log("modified rows: " + dataReceived);
					alert("Se modificaron " + dataReceived + " salones.");

			}
		});


	} else if (pressedBtn == "delete"){

		deletableTable();

	} 

	var table = document.getElementById("classroomTable");
	clonedTable = table.innerHTML;
	console.log(clonedTable);

}

function prepareJsonTable(){

	var table = document.getElementById("classroomTable");

	id.length = 0;
	capacity.length = 0;
	deptAdmin.length = 0;

	for (var i = 0, j = 1, row; row = table.rows[j]; i++, j++) {

		id[i] = row.cells[0].innerHTML;
		capacity[i] = row.cells[1].innerHTML;
		console.log(row.cells[1].innerHTML);
		deptAdmin[i] =  row.cells[2].innerHTML;
	}


}