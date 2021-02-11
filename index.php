<!DOCTYPE html>
<html>
<head>
	<title>Wheather Report</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- Select2 CSS --> 
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Select2 JS --> 
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<style type="text/css">
		.search{
			background-color: #a8324e;
			width: 300px;
			height: 150px;
			margin-top: 5%;
			margin-left: 35%;
			border-radius: 5px;
		}
		#getval{
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="search" style="text-align: center;"><br><br>
		<select id='country' style="width: 200px;">
			<option value=''>Select City</option> 
		</select><br>
		<input type='button' class="btn btn-primary" id="getval" value="Get">
	</div>
	<div id="demo">

		</div>
</body>
<script type="text/javascript">
	$(function(){
		$("#country").select2();
		$.ajax({
			type:"GET",
			url:"citylist.json",
			dataType:"json",
			success: data=>{
				for (var i = 0; i < data.length; i++) {
					if (data[i]['country']=='IN') {
						$("#country").append("<option value="+data[i]['id']+">"+data[i]['name']+"</option>");
					}
				}
			}
		});

		$("#getval").click(()=>{
			var city = $('#country option:selected').val();
			$("#demo").empty();
			$.ajax({
				type: "POST",
				url: "curl.php",
				dataType: "json",
				data: {city},
				success: result=>{
					console.log(result);
					for(let i=0;i<result['data'].length;i++){
						$('#demo').append("<div>City : "+result['city_name']+"</div><div>Country : "+result['country_code']+"</div><div>Temprature : "+result['data'][i]['temp']+ '&deg;C'+"</div><div>Date : "+result['data'][i]['datetime']+"</div><div>Min Tamprature :"+result['data'][i]['min_temp']+ ' &deg;C'+"</div><div>Max Tamprature :"+result['data'][i]['max_temp']+ '&deg;C'+"</div><div>Wind Speed : "+result['data'][i]['wind_spd']+ ' km/h'+"</div><div>Description : "+result['data'][i]['weather']['description']+"</div><div>Wind Direction : "+result['data'][i]['wind_cdir_full']+"</div><br><br><br>");}
					}
				});
		});
		
	});
</script>

</html>