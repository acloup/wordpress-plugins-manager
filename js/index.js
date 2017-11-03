		
	Number.prototype.pad = function(size) {
      var s = String(this);
      while (s.length < (size || 2)) {s = "0" + s;}
      return s;
    }

	$("#is_submit_data").on('click', function() {
		is_submit_data_click();
	});

	$("#form_submit_data").on('submit', function(e) {
		e.preventDefault();
	});	

	$("body").on('click', '#is_submit_selection', function() {		
		is_submit_selection_click();
	});	

	$("body").on('submit', '#form_submit_selection', function(e) {		
		e.preventDefault();
	});	

	function is_submit_selection_click() {

		var html = '';
		var data = '{';
		var i = 0;

		$(".selection").each(function(){
			if ($(this).is(':checked')) {
				console.log($(this));
				i++;
				data += $(this).val().replace(new RegExp("'", 'g'), '"') + ';';				
			}
		});

		data = "a:" + i + ":" + data;
		data += '}';	

		html += '<b>Copy and past this new value in the database :<b><br><br><textarea cols="100" rows="10" class="form-control">' + data + '</textarea><br><a href="index.php#database-all-plugins" class="btn btn-secondary btn-block">RESTART</a>';
		$("#zone").fadeOut('fast', function(){
			$(this).html(html);
		}).fadeIn('slow');

		return false;
	}

	function is_submit_data_click() {

		var html = '';

		var data = $.trim($("#data").val());
		var tmp = data.split(":{");

		$.ajax({
		  method: "POST",
		  url: "session.php",
		  data: { data: data}
		});		

		var count = tmp[0].replace("a:","");
		var plugins_array = tmp[1].split(";");

		html += "<b>Currently, you have " + count + " enabled plugins</b>.";
		html += "<br>";
		html += "Uncheck the ones you want to disable and then click \"Send selection\".";
		html += "<br><br>";
		html += '<form action="#" method="post" name="form_submit_selection" id="form_submit_selection"><div class="list-group">';

		var k = 1;

		plugins_array.forEach(function(e){

			var number = 0;
			var name = '';
			var filename = '';
			var input_value = '';

			if (e.substring(0,1) == 'i') {			
				number = parseInt(e.split(":")[1])+parseInt(1);				
				input_value +=  e;
			} else if (e.substring(0,1) == 's'){
				filename = e.split(":")[2];
				filename = filename.replace(new RegExp('"', 'g'), '');

				name = filename.replace(new RegExp('-', 'g'), ' ');
				name = name.replace(new RegExp('/', 'g'), ' - ');
				name = name.replace(new RegExp('.php', 'g'), '');			
				name = name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
				    return letter.toUpperCase();
				});
				
				input_value +=  e;
			}

			if(name != '') {			
				html += '<li class="list-group-item d-flex justify-content-between align-items-center" style="text-align:left;">';
				html += '<label for="' + filename + '" style="margin-bottom:0;width:100%;">';	
				html += '<input type="checkbox" class="selection" checked';
				html += ' name="selection[]"';
				html += ' id="' + filename + '" value="' + input_value.replace(new RegExp('"', 'g'), "'") + '">';
				html += '&nbsp;' + name;
				html += '</label>';
				html += '<span class="badge badge-secondary badge-pill">' + (k/2).pad(2) + '</span>';
				html += '</li>';
			}

			k++;
		
		});

		html += '</div><br>';
		html += '<input type="submit" name="is_submit_selection" id="is_submit_selection" value="SEND SELECTION" class="btn btn-success btn-block"></form>';

		$("#zone").fadeOut('fast', function(){
			$(this).html(html);
		}).fadeIn('slow');

		return false;
	}