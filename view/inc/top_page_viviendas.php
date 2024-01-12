<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de inmuebles</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    	
		<script type="text/javascript">
        	$(function() {
        		$('#fecha_publicacion').datepicker({
        			dateFormat: 'dd/mm/yy', 
        			changeMonth: true, 
        			changeYear: true, 
        			yearRange: '1900:2036',
        			onSelect: function(selectedDate) {
        			}
        		});
        	});
	    </script>
		
	    <link href="view/css/style.css" rel="stylesheet" type="text/css" />
	    <script src="module/viviendas/model/validate_viviendas.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <body>