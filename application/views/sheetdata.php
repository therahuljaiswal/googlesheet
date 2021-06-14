<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Task</title>
		<style>
		</style>
</head>
<body>
<div id="container">
	<table id="googleSheet" class="display">
	<thead>
		<th>ID</th>
		<th>Company</th>
		<th>Contact Person</th>
		<th>Client Name</th>
		<th>Country</th>		
	</thead>
	<tbody>
	<?php foreach($filedata as $singleData) {  ?>
	 <tr>
		 <td><?php echo $singleData['ID']; ?></td>
		 <td><?php echo $singleData['Company']; ?></td>
		 <td><?php echo $singleData['Contact_Person']; ?></td>
		 <td><?php echo $singleData['Client_Name']; ?></td>
		 <td><?php echo $singleData['Country']; ?></td>
	 </tr>
	<?php } ?>
	</tbody>
	</table>
</div>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function(){
    $('#googleSheet').DataTable({            
		'responsive': true,
		searching: false,
		dom: 'frtipB',
		buttons:[
				{
				extend: 'csv',
				text: 'Export to csv'
				}		
			]
    });
});
</script>
  <style>
	.dt-buttons {   
		text-align: center;
		margin-left: 20px;
	}
  </style>
</body>
</html>