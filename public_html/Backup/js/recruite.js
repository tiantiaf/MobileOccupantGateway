function getGroupAsOptions() {
	$.getJSON('../api/get_group.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var groupList = data.data;
			
			htmlString += '<option value="na">--Select Group--</option>';
			for (var i = 0; i < surveyCount; i++) {
				htmlString += '<option value="' + groupList[i].group_name + '">' + groupList[i].group_name + '</option>';
			}
			htmlString += '</optgroup>';
			$("#group_user").html(htmlString);
		} else {
			htmlString = '<option>No Groups Found</option>';
			$("#group_user").html(htmlString);
		}
	});
}

function getSendGroupAsOptions() {
	$.getJSON('../api/get_group.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var groupList = data.data;
			
			htmlString += '<option value="na">--Select Group--</option>';
			for (var i = 0; i < surveyCount; i++) {
				htmlString += '<option value="' + groupList[i].group_name + '">' + groupList[i].group_name + '</option>';
			}
			htmlString += '</optgroup>';
			$("#send_group_type").html(htmlString);
		} else {
			htmlString = '<option>No Groups Found</option>';
			$("#send_group_type").html(htmlString);
		}
	});
}