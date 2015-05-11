function loadSurveys() {
	$.getJSON('../api/get_surveys.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var surveyList = data.data;
			for (var i = 0; i < surveyCount; i++) {
				console.log(surveyList[i].geodata);
				if (surveyList[i].geodata != null) {
					//geodata = surveyList[i].geodata;
					//test: geodata = 'http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyB1OdEdd4ActSe9x2AmVeZPEOiq5jbnOTg&zoom=13&size=320x200&maptype=roadmap&markers=color:red%7Ccolor:red%7Clabel:C%7C40.718217,-73.998284&sensor=false';
					geodata = 'http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyB1OdEdd4ActSe9x2AmVeZPEOiq5jbnOTg&zoom=17&size=320x200&maptype=roadmap&markers=color:red%7Ccolor:red%7Clabel:S%7C' + surveyList[i].geodata + '&sensor=false';
					htmlString += '<li class="span4">' + '<div class="thumbnail">' +
					//'<img src="http://placehold.it/320x200" alt="ALT NAME">' +
					'<img src="' + geodata + '" alt="ALT NAME">' + '<div class="caption">' + '<h3>' + surveyList[i].survey_name + '</h3>' + '<p>' + surveyList[i].survey_title + '</p>' + '<p align="center">' + '<a target="_blank" href="survey_preview.php?survey_id=' + surveyList[i].survey_id + '" class="btn btn-primary btn-block">Open</a>' + '</p></div></div></li>';
					
				} else {
					htmlString += '<li class="span4">' + '<div class="thumbnail">' + '<img src="../img/320x200.gif" alt="GEO: NA">' + '<div class="caption">' + '<h3>' + surveyList[i].survey_name + '</h3>' + '<p>' + surveyList[i].survey_title + '</p>' + '<p align="center">' + '<a target="_blank" href="survey_preview.php?survey_id=' + surveyList[i].survey_id + '" class="btn btn-primary btn-block">Open</a>' + '</p></div></div></li>';
				}

			}
			$("#survey_list").html(htmlString);
		} else {
			htmlString = '<div class="alert alert-info"><h4>No Surveys Found</h4></div>';
			$("#survey_list").html(htmlString);
		}
	}).fail(function(jqxhr, textStatus, error) {
		var err = textStatus + ', ' + error;
		htmlString = '<div class="alert alert-error"><h4>Request Failed:</h4> ' + err + '</div>';
		$("#survey_list").html(htmlString);
		console.log("Request Failed: " + err);
	});
}

function getSurveyAsOptions() {
	$.getJSON('../api/get_surveys.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var surveyList = data.data;
			htmlString += '<optgroup label="Active">';
			htmlString += '<option value="na">--Select Survey--</option>';
			for (var i = 0; i < surveyCount; i++) {
				htmlString += '<option value="' + surveyList[i].survey_id + '">' + surveyList[i].survey_name + '</option>';
			}
			htmlString += '</optgroup>';
			$("#q_survey").html(htmlString);
		} else {
			htmlString = '<option>No Surveys Found</option>';
			$("#q_survey").html(htmlString);
		}
	});
}

function getPushSurveyAsOptions() {
	$.getJSON('../api/get_surveys.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var surveyList = data.data;
			htmlString += '<optgroup label="Active">';
			htmlString += '<option value="na">--Select Survey--</option>';
			for (var i = 0; i < surveyCount; i++) {
				htmlString += '<option value="' + surveyList[i].survey_id + '">' + surveyList[i].survey_name + '</option>';
			}
			htmlString += '</optgroup>';
			$("#q_push_survey").html(htmlString);
		} else {
			htmlString = '<option>No Surveys Found</option>';
			$("#q_push_survey").html(htmlString);
		}
	});
}

function getSegmentsAsOptions(survey_id) {
	$.getJSON('../api/get_segments.php?survey_id='+survey_id, function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var segmentCount = data.code;
			var segmentList = data.data;
			for (var i = 0; i < segmentCount; i++) {
				htmlString += '<option value="' + segmentList[i].segment_id + '">' + segmentList[i].segment_title + '</option>';
			}
			htmlString += '</optgroup>';
			$("#q_segment").html(htmlString);
		} else {
			htmlString = '<option>No Segments Found</option>';
			$("#q_segment").html(htmlString);
		}
	});
}

function getPushSegmentsAsOptions(push_survey_id) {
	$.getJSON('../api/get_push_segments.php?push_survey_id='+push_survey_id, function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var segmentCount = data.code;
			var segmentList = data.data;
			for (var i = 0; i < segmentCount; i++) {
				htmlString += '<option value="' + segmentList[i].segment_id + '">' + segmentList[i].segment_title + '</option>';
			}
			htmlString += '</optgroup>';
			$("#q_segment").html(htmlString);
		} else {
			htmlString = '<option>No Segments Found</option>';
			$("#q_segment").html(htmlString);
		}
	});
}

function getSetPushSurveyAsOptions() {
	$.getJSON('../api/get_surveys.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var surveyList = data.data;
			htmlString += '<optgroup label="Active">';
			htmlString += '<option value="na">--Select Survey--</option>';
			for (var i = 0; i < surveyCount; i++) {
				htmlString += '<option value="' + surveyList[i].survey_id + '">' + surveyList[i].survey_name + '</option>';
			}
			htmlString += '</optgroup>';
			$("#q_push_set_survey").html(htmlString);
		} else {
			htmlString = '<option>No Surveys Found</option>';
			$("#q_push_set_survey").html(htmlString);
		}
	});
}

function getContexualUser() {
	$.getJSON('../api/get_users.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var userCount = data.code;
			var userList  = data.data;
			htmlString += '<optgroup label="Active">';
			htmlString += '<option value="na">--Select Users--</option>';
			for (var i = 0; i < userCount; i++) {
				var temp = userList[i].email;
				htmlString += '<option value="'+ userList[i].email  + '">' + userList[i].email +  '</option>';
			}
			htmlString += '</optgroup>';
			$("#q_contextual_user").html(htmlString);
		} else {
			htmlString = '<option>No Users Found</option>';
			$("#q_contextual_user").html(htmlString);
		}
	});
}


function getCoordinates(bldgNo, bldgStreet, bldgCity, bldgState, bldgZip) {
	var address = bldgNo + ' ' + bldgStreet + ' ' + bldgCity + ' ' + bldgState + ' - ' + bldgZip;
	$.getJSON('../api/get_location.php?address=' + address, function(data) {
		var status = data.status;
		if (status == 'OK') {
			$('#survey_geo').val(data.lat + ', ' + data.lng);
			//alert(data.lat + ', ' + data.lng);
			geoImageUrl = '<img src="http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyB1OdEdd4ActSe9x2AmVeZPEOiq5jbnOTg&zoom=17&size=320x200&maptype=roadmap&markers=color:red%7Ccolor:red%7Clabel:S%7C' + data.lat + ',' + data.lng + '&sensor=false"/>';
			$('#locImage').html(geoImageUrl);
		} else {
			$('#survey_geo').val(data.status);
			alert(data.status);
		}
	});
}

function resetGeoModal() {
	$('#bldgNo').val('');
	$('#bldgStreet').val('');
	$('#bldgCity').val('');
	$('#bldgState').val('');
	$('#bldgZip').val('');
	$('#locImage').html('');
}

function getWeatherStats() {
	$('#customModalContent').highcharts({
		chart : {
			type : 'line'
		},
		title : {
			text : 'Monthly Average Temperature'
		},
		subtitle : {
			text : ''
		},
		xAxis : {
			categories : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis : {
			title : {
				text : 'Temperature (°C)'
			}
		},
		tooltip : {
			enabled : true,
			formatter : function() {
				return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y + '°C';
			}
		},
		plotOptions : {
			line : {
				dataLabels : {
					enabled : true
				},
				enableMouseTracking : true
			}
		},
		series : [{
			name : 'External',
			data : [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
		}, {
			name : 'Watt Hall',
			data : [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
		}]
	});
}

function getWindSpeed() {
	$('#customModalContent').highcharts({
		chart : {
			type : 'spline'
		},
		title : {
			text : 'Luminosity during two days'
		},
		subtitle : {
			text : ''
		},
		xAxis : {
			type : 'datetime'
		},
		yAxis : {
			title : {
				text : 'Lux'
			},
			min : 0,
			minorGridLineWidth : 0,
			gridLineWidth : 0,
			alternateGridColor : null,
			plotBands : [{// Light air
				from : 0.3,
				to : 1.5,
				color : 'rgba(68, 170, 213, 0.1)',
				label : {
					text : 'Pitch Black',
					style : {
						color : '#606060'
					}
				}
			}, {// Light breeze
				from : 1.5,
				to : 3.3,
				color : 'rgba(0, 0, 0, 0)',
				label : {
					text : 'Dark',
					style : {
						color : '#606060'
					}
				}
			}, {// Gentle breeze
				from : 3.3,
				to : 5.5,
				color : 'rgba(68, 170, 213, 0.1)',
				label : {
					text : 'Average Dark',
					style : {
						color : '#606060'
					}
				}
			}, {// Moderate breeze
				from : 5.5,
				to : 8,
				color : 'rgba(0, 0, 0, 0)',
				label : {
					text : 'Less Bright',
					style : {
						color : '#606060'
					}
				}
			}, {// Fresh breeze
				from : 8,
				to : 11,
				color : 'rgba(68, 170, 213, 0.1)',
				label : {
					text : 'Bright',
					style : {
						color : '#606060'
					}
				}
			}, {// Strong breeze
				from : 11,
				to : 14,
				color : 'rgba(0, 0, 0, 0)',
				label : {
					text : 'Very Bright',
					style : {
						color : '#606060'
					}
				}
			}, {// High wind
				from : 14,
				to : 15,
				color : 'rgba(68, 170, 213, 0.1)',
				label : {
					text : 'Extremely Bright',
					style : {
						color : '#606060'
					}
				}
			}]
		},
		tooltip : {
			valueSuffix : ' m/s'
		},
		plotOptions : {
			spline : {
				lineWidth : 4,
				states : {
					hover : {
						lineWidth : 5
					}
				},
				marker : {
					enabled : false
				},
				pointInterval : 3600000, // one hour
				pointStart : Date.UTC(2009, 9, 6, 0, 0, 0)
			}
		},
		series : [{
			name : 'Hestavollane',
			data : [4.3, 5.1, 4.3, 5.2, 5.4, 4.7, 3.5, 4.1, 5.6, 7.4, 6.9, 7.1, 7.9, 7.9, 7.5, 6.7, 7.7, 7.7, 7.4, 7.0, 7.1, 5.8, 5.9, 7.4, 8.2, 8.5, 9.4, 8.1, 10.9, 10.4, 10.9, 12.4, 12.1, 9.5, 7.5, 7.1, 7.5, 8.1, 6.8, 3.4, 2.1, 1.9, 2.8, 2.9, 1.3, 4.4, 4.2, 3.0, 3.0]

		}, {
			name : 'Voll',
			data : [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.1, 0.0, 0.3, 0.0, 0.0, 0.4, 0.0, 0.1, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.6, 1.2, 1.7, 0.7, 2.9, 4.1, 2.6, 3.7, 3.9, 1.7, 2.3, 3.0, 3.3, 4.8, 5.0, 4.8, 5.0, 3.2, 2.0, 0.9, 0.4, 0.3, 0.5, 0.4]
		}],
		navigation : {
			menuItemStyle : {
				fontSize : '10px'
			}
		}
	});
}

function loadSurveysForStat() {
	$('#customModal .modal-body').attr('style', 'max-height:450px');
	var initialHtml = '<div class="span6" id="criteria"><div class="span3" id="s_choose"><label>Survey</label>' + '<select id="f_survey" class="selectpicker" name="f_survey" datasize="5" required="required"></select>' + '</div><div id="q_choose"></div></div>' + '<div class="span6" id="feedback-stat"></div>';

	$('#customModalContent').html(initialHtml);

	$.getJSON('../api/get_surveys.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var surveyList = data.data;
			htmlString += '<optgroup label="Active">';
			htmlString += '<option value="-1">All Survey Stat</option>';
			for (var i = 0; i < surveyCount; i++) {
				htmlString += '<option value="' + surveyList[i].survey_id + '">' + surveyList[i].survey_name + '</option>';
			}

			htmlString += '</optgroup>';
			$("#f_survey").html(htmlString);
		} else {
			htmlString = '<option>No Surveys Found</option>';
			$("#f_survey").html(htmlString);
		}
	});

	getAllFeedbackStat();
}

function getAllFeedbackStat() {
	$(function() {
		$('#feedback-stat').highcharts({
			chart : {
				type : 'column'
			},
			title : {
				text : 'Survey Feedback'
			},
			subtitle : {
				text : ''
			},
			xAxis : {
				categories : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis : {
				min : 0,
				title : {
					text : 'Responses'
				}
			},
			tooltip : {
				headerFormat : '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat : '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
				footerFormat : '</table>',
				shared : true,
				useHTML : true
			},
			plotOptions : {
				column : {
					pointPadding : 0.2,
					borderWidth : 0
				}
			},
			series : [{
				name : 'Test',
				data : [49, 71, 106, 129, 144, 176.0, 135.0, 148.0, 216.0, 194.0, 95.0, 54.0]

			}, {
				name : 'Survey 1',
				data : [83.0, 78.0, 98.0, 93.0, 106.0, 84.0, 105.0, 104.0, 91.0, 83.0, 106.0, 92.0]

			}, {
				name : 'Test Survey',
				data : [48.0, 38.0, 39.0, 41.0, 47.0, 48.0, 59.0, 59.0, 52.0, 65.0, 59.0, 51.0]

			}, {
				name : 'Survey 4',
				data : [42.0, 33.0, 34.0, 39.0, 52.0, 75.0, 57.0, 60.0, 47.0, 39.0, 46.0, 51.0]

			}, {
				name : 'Test with Geo',
				data : [42.0, 33.0, 34.0, 39.0, 52.0, 75.0, 57.0, 60.0, 47.0, 39.0, 46.0, 51.0]
			}]
		});
	});
}

function specificSurveyStat() {
	$(function() {
		$('#feedback-stat').highcharts({
			chart : {
				plotBackgroundColor : null,
				plotBorderWidth : null,
				plotShadow : false
			},
			title : {
				text : 'Specific Survey Stat'
			},
			tooltip : {
				pointFormat : '{series.name}: <b>{point.percentage}%</b>',
				percentageDecimals : 1
			},
			plotOptions : {
				pie : {
					allowPointSelect : true,
					cursor : 'pointer',
					dataLabels : {
						enabled : true,
						color : '#000000',
						connectorColor : '#000000',
						formatter : function() {
							return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
						}
					}
				}
			},
			series : [{
				type : 'pie',
				name : 'Test Survey',
				data : [['Likert 1', 45.0], ['Likert 2', 26.8], {
					name : 'Likert 3',
					y : 12.8,
					sliced : true,
					selected : true
				}, ['Likert 5', 8.5], ['Likert 6', 6.2], ['Likert 7', 0.7]]
			}]
		});
	});
}

function getLuminosity(userid) {
	var x = new Array();
	/*
	$('#customModal .modal-body').attr('style', 'max-height:450px');
	var initialHtml = '<div class="span6" id="light_criteria"><div class="span3" id="light_user_choose"><label>Light Data</label>' 
					+ '<select id="f_light_data" class="selectpicker" name="f_light_data" datasize="5" required="required"></select>'
					+ '</div><div id="light_user_choose"></div></div>' + '<div class="span6" id="feedback-stat"></div>';

	$('#customModalContent').html(initialHtml);
	
	$.getJSON('../api/get_users_light.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var userCount = data.code;
			var userList = data.data;
			htmlString += '<optgroup label="Active">';
			htmlString += '<option value="-1">User</option>';
			for (var i = 0; i < userCount; i++) {
				htmlString += '<option value="' + userList[i].userid + '</option>';
			}

			htmlString += '</optgroup>';
			$("#f_light_data").html(htmlString);
		} else {
			htmlString = '<option>No Surveys Found</option>';
			$("#f_light_data").html(htmlString);
		}
		*/
	
		$.getJSON('../api/get_light_data.php?userid='+userid, function(data) {
			
			var result = data.code;
			
			var htmlString = "";
			
			if (data.code > 0) {
				var lightNum;
				var lightData;
				
				lightNum = data.code;
				lightData = data.data;
				
				for (var i = 0; i < lightNum; i++) {
					htmlString += '<option value="' + "light" + lightData[i].light + '</option>';
					x[i] = parseFloat(lightData[i].light);
				}
				
			}
			
			$('#customModalContent').highcharts({
				chart : {
					type : 'spline'
				},
				title : {
					text : 'Luminosity during two days'
				},
				subtitle : {
					text : ''
				},
				xAxis : {
					type : 'datetime'
				},
				yAxis : {
					title : {
						text : 'Lux'
					},
					min : 0,
					minorGridLineWidth : 0,
					gridLineWidth : 0,
					alternateGridColor : null,
					plotBands : [{// Light air
						from : 0.3,
						to : 1.5,
						color : 'rgba(68, 170, 213, 0.1)',
						label : {
							text : 'Pitch Black',
							style : {
								color : '#606060'
							}
						}
					}, {// Light breeze
						from : 1.5,
						to : 3.3,
						color : 'rgba(0, 0, 0, 0)',
						label : {
							text : 'Dark',
							style : {
								color : '#606060'
							}
						}
					}, {// Gentle breeze
						from : 3.3,
						to : 5.5,
						color : 'rgba(68, 170, 213, 0.1)',
						label : {
							text : 'Average Dark',
							style : {
								color : '#606060'
							}
						}
					}, {// Moderate breeze
						from : 5.5,
						to : 8,
						color : 'rgba(0, 0, 0, 0)',
						label : {
							text : 'Less Bright',
							style : {
								color : '#606060'
							}
						}
					}, {// Fresh breeze
						from : 8,
						to : 11,
						color : 'rgba(68, 170, 213, 0.1)',
						label : {
							text : 'Bright',
							style : {
								color : '#606060'
							}
						}
					}, {// Strong breeze
						from : 11,
						to : 14,
						color : 'rgba(0, 0, 0, 0)',
						label : {
							text : 'Very Bright',
							style : {
								color : '#606060'
							}
						}
					}, {// High wind
						from : 14,
						to : 15,
						color : 'rgba(68, 170, 213, 0.1)',
						label : {
							text : 'Extremely Bright',
							style : {
								color : '#606060'
							}
						}
					}]
				},
				tooltip : {
					valueSuffix : ' m/s'
				},
				plotOptions : {
					spline : {
						lineWidth : 4,
						states : {
							hover : {
								lineWidth : 5
							}
						},
						marker : {
							enabled : false
						},
						pointInterval : 3600000, // one hour
						pointStart : Date.UTC(2009, 9, 6, 0, 0, 0)
					}
				},
				series : [{
					name : 'Hestavollane',
					data : [x[0], x[1], x[2], x[3], x[4], x[5], x[6], x[7], x[8], x[9], x[10], x[11], x[12], x[13], x[14], x[15], x[16], x[17], x[18], x[19], x[1], x[1], x[1], x[1], x[1], x[1], x[1], x[1], x[1], x[1], 10.9, 12.4, 12.1, 9.5, 7.5, 7.1, 7.5, 8.1, 6.8, 3.4, 2.1, 1.9, 2.8, 2.9, 1.3, 4.4, 4.2, 3.0, 3.0]

				}, {
					name : 'Voll',
					data : [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.1, 0.0, 0.3, 0.0, 0.0, 0.4, 0.0, 0.1, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.6, 1.2, 1.7, 0.7, 2.9, 4.1, 2.6, 3.7, 3.9, 1.7, 2.3, 3.0, 3.3, 4.8, 5.0, 4.8, 5.0, 3.2, 2.0, 0.9, 0.4, 0.3, 0.5, 0.4]
				}],
				navigation : {
					menuItemStyle : {
						fontSize : '10px'
					}
				}
			
			});
			
		});
		
	//});
	
	
}

function generateSegments() {
	var initialHtml = '<div class="span6" id="insideMainSegmentDiv"></div>';
	$('#customModalContent').append(initialHtml);
	for (var i = 0; i < 6; i++) {
		index = i+1;
		$('#insideMainSegmentDiv').append('<input type="text" class="span2" placeholder="Segment ' + index + '" id="seg_' + index + '">'+
										  '&nbsp;&nbsp;<input type="text" class="span3" placeholder="Description" id="seg_desc_' + index + '">');
	}
	
	$('#customFooterButtons').append('<button class="btn btn-primary" data-dismiss="modal" id="add_segments">Add</button>');
}

function addSegments(){
	var segments = '';
	for(var i = 1; i <= 6;i++){
		segmentId = '#seg_'+i;
		segmentTitle = $(segmentId).val();
		if(segmentTitle != null && segmentTitle != ''){
			segmentDesc = $('#seg_desc_'+i).val();
			segments += segmentId +'='+segmentTitle +';'+ segmentDesc;
		}
	}
	
	$('#segments').val(segments);
}


function generateExportTableList(){
	$.getJSON('../api/get_export_list.php', function(data) {
		var htmlString = "";
		if(data.count > 0){
			tableList = data.data;
			for (var i = 0; i < data.count; i++) {
				htmlString += '<li><a href="exportTocsv.php?tablename="'+tableList[i]+'">'+tableList[i]+'</a></li>';
			}

			$("#export-tables-list").html(htmlString);
		} else {
			htmlString = '<li>No Tables Found</li>';
			$("#export-tables-list").html(htmlString);
		}
	});

}

function getDeleteSurveyAsOptions() {
	$.getJSON('../api/get_surveys.php', function(data) {
		var htmlString = "";
		if (data.code > 0) {
			var surveyCount = data.code;
			var surveyList = data.data;
			htmlString += '<optgroup label="Active">';
			htmlString += '<option value="na">--Select Survey--</option>';
			for (var i = 0; i < surveyCount; i++) {
				htmlString += '<option value="' + surveyList[i].survey_id + '">' + surveyList[i].survey_name + '</option>';
			}
			htmlString += '</optgroup>';
			$("#q_delete_survey").html(htmlString);
		} else {
			htmlString = '<option>No Surveys Found</option>';
			$("#q_delete_survey").html(htmlString);
		}
	});
}

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