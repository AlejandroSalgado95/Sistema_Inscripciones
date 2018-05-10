

var activeDelete = false;
var activeModify = false;
var activeAdd = false;
var saved = false;

var inputMode = false;
var clonedTable = "" ;
var pressedBtn = "";

var id = [];
var professor = [];
var lastname = [];
var phone = [];
var email = [];

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

	$("#tiporeporte").change(function(e){
		console.log("se cambio el valor del dropdown tiporeporte");
		e.preventDefault();

		var dayDropDown = document.getElementById("diaDropDown");
		var placeDropDown = document.getElementById("salonDropDown");;
		var topicDropDown = document.getElementById("claveMateriaDropDown");;

		if ( $(this).val() == "enlugarfecha" ){

			console.log("se hace esta funcion por elegir enlugarfecha");
			
			dayDropDown.style.display = "inline";
			placeDropDown.style.display = "inline";
			topicDropDown.style.display = "none";



		} else if ( $(this).val() == "enmateria" ){

			console.log("se hace esta funcion por elegir enmateria");
			
			dayDropDown.style.display = "none";
			placeDropDown.style.display = "none";
			topicDropDown.style.display = "inline";
		}
		
	});



});


function deletableTable() {

	pressedBtn = "delete";
	var table = document.getElementById("courseTable");

	if (!activeDelete){

		var addBtn = document.getElementById("add").firstChild.nextSibling.src = "../views/img/blocked5.png";
		var modifyBtn = document.getElementById("settings").firstChild.nextSibling.src = "../views/img/blocked5.png";

		//saveTable();

		//var saveBtn = document.getElementById("save");
		//saveBtn.style.display = "block";

		//var tr = table.rows[0].insertCell(table.rows[0].length);
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

		//var div = document.getElementById("tableDiv");

		/*if (!saved){

			var table = document.getElementById("courseTable");
			table.innerHTML = clonedTable;

		} else {*/

			var table = document.getElementById("courseTable");

			for (var i = 0, row; row = table.rows[i]; i++){

				row.deleteCell(row.cells.length - 1);
			}

		/*}

		saved = false;

		var saveBtn = document.getElementById("save");
		saveBtn.style.display = "none";*/

		/*
		for (var i = 1, row; row = table.rows[i]; i++) {

	   		for (var j = 1, col; col = row.cells[j]; j++) {
	    	
	    	 	 col.innerHTML = col.firstChild.value;
	  		 }  

		}


		for (var i = 0, row; row = table.rows[i]; i++){

			row.deleteCell(row.cells.length - 1);
		}*/

		saveTable();
		activeDelete = false;


	}

	 //table.insertRow(0);

	 console.log("hola");



}


function modifiableTable() {

	pressedBtn = "modify";
	var table = document.getElementById("courseTable");

	if (!activeModify){

		var addBtn = document.getElementById("add").firstChild.nextSibling.src = "../views/img/blocked5.png" ;
		var deleteBtn = document.getElementById("delete").firstChild.nextSibling.src = "../views/img/blocked5.png" ;

		saveTable();

		var saveBtn = document.getElementById("save");
		saveBtn.style.display = "block";

		//var tr = table.rows[0].insertCell(table.rows[0].length);
		/*
		var tr = table.rows[0];
		th = document.createElement('th');
		tr.appendChild(th);*/
	
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

			var table = document.getElementById("courseTable");
			table.innerHTML = clonedTable;


		} else {

			var table = document.getElementById("courseTable");

			for (var i = 1, row; row = table.rows[i]; i++) {

		   		for (var j = 1, col; col = row.cells[j]; j++) {
		    	
		    	 	 col.innerHTML = col.firstChild.value;
		  		 }  

			}
		}

		saved = false;
		

		var saveBtn = document.getElementById("save");
		saveBtn.style.display = "none";

		/*
		for (var i = 1, row; row = table.rows[i]; i++) {

	   		for (var j = 1, col; col = row.cells[j]; j++) {
	    	
	    	 	 col.innerHTML = col.firstChild.value;
	  		 }  

		}


		for (var i = 0, row; row = table.rows[i]; i++){

			row.deleteCell(row.cells.length - 1);
		}*/


		activeModify = false;


	}

	 //table.insertRow(0);

	 console.log("hola");



}



function addableTable(){

	/*var table = document.getElementById("courseTable");

	var x = document.createElement("tr");
	var y = document.createElement("td");
	y.innerHTML = "Hola";

	x.appendChild(y);
	x.appendChild(y);
	x.appendChild(y);
	x.appendChild(y);
	x.appendChild(y);

	table.appendChild(x);*/
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


	//$("#courseTable").append('<tr><td></td><td></td><td></td><td></td><td></td></tr>');


}

function validateNewRecord(textInputs, warnings){

	var MissingInfo = false;

	for( var i = 0; i < textInputs.length; i++) 
    {
    	//console.log(textInputs[i].value);
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


		var action = "Profesores";
		var type = "ModificarBD";
		var modificationType = "Agregar";

		var topic = $("#materiadato").val();
		var schedule = $("#horariodato").val();
		var lab = $("#laboratoriodato").val();
		var classroom = $("#salondato").val();
		var language = $("#idiomadato").val();
		var topicType = $("#tipodato").val();

	    var jsonToSend = {
			"action" : action,
			"type" : type,
			"modificationType" : modificationType,
			"topic" : topic,
			"schedule" : schedule,
			"lab" : lab,
			"classroom" : classroom,
			"language" : language,
			"topicType" :  topicType
		};

		console.log(topic);
		console.log(schedule);
		console.log(lab);
		console.log(classroom);
		console.log(language);
		console.log(topicType);

		
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
						alert("No fue posible agregar el curso, esto debido a que ya existe un curso ocurriendo en el mismo horario y salon" );
					else if (dataReceived == 1){
						alert("Se agrego con exito el curso" );
						/*
						$("#courseTable").append('<tr><td>' + newId  + '</td><td>' + newName + '</td><td>' + newLastName + '</td><td>' + newPhone + '</td><td>' + newEmail + '</td></tr>');
						saveTable();
						cleanFieldset();
						alert("Se agregó con éxito al profesor con la nómina: " + newId);*/
					}
						

			}
		});


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


function deleteTableRow(rowIndex, personID){

	var table = document.getElementById("courseTable");
	//table.deleteRow(rowIndex);
	//console.log("Se borro al profesor con la nomina: " + personID);

	var txt;
	var response = confirm("¿Estás seguro de querer borrar al profesor cuya nomina es : " + personID + "?");

	if (response == true) {

		var action = "Profesores";
		var type = "ModificarBD";
		var modificationType = "Borrar";

	    //txt = "You pressed OK!";
	    var jsonToSend = {
			"action" : action,
			"type" : type,
			"modificationType" : modificationType,
			"id" : personID
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
						alert("No fue posible eliminar al profesor con la nómina: " + personID + ", esto debido a que el profesor está asociado con al menos un curso. Para eliminar a este profesor, primero modifique o elimine los cursos con los cuales este está asociado." );
					else if (dataReceived == 1){

						alert("Se eliminó con éxito al profesor con la nómina: " + personID);
						table.deleteRow(rowIndex);
					}
						

			}
		});




	} 

}


function saveTable(){

	var table = document.getElementById("courseTable");
	clonedTable = table.innerHTML;
	console.log(clonedTable);


}


function saveChanges(actionedButton){

	saved = true;

	if (pressedBtn == "modify"){

		modifiableTable();

		prepareJsonTable();

		var action = "Profesores";
		var type = "ModificarBD";
		var modificationType = "Editar";
		
		var jsonToSend = {
			"action" : action,
			"type" : type,
			"modificationType" : modificationType,
			"id" : id,
			"name" : professor,
			"lastname" : lastname,
			"phone" : phone,
			"email" : email
		};

		console.log(id);
		console.log(name);
		console.log(lastname);
		console.log(phone);
		console.log(email);
		
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
					alert("Se modificaron " + dataReceived + " profesores.");

			}
		});


	} else if (pressedBtn == "delete"){

		deletableTable();

	} 

	var table = document.getElementById("courseTable");
	clonedTable = table.innerHTML;
	console.log(clonedTable);

}

function prepareJsonTable(){

	var table = document.getElementById("courseTable");

	id.length = 0;
	professor.length = 0;
	lastname.length = 0;
	phone.length = 0;
	email.length = 0;

	for (var i = 0, j = 1, row; row = table.rows[j]; i++, j++) {

		id[i] = row.cells[0].innerHTML;
		professor[i] = row.cells[1].innerHTML;
		console.log(row.cells[1].innerHTML);
		lastname[i] =  row.cells[2].innerHTML;
		phone[i] = row.cells[3].innerHTML;
		email[i] = row.cells[4].innerHTML;

	}


}