<!DOCTYPE html>
<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>

	<title>TEST</title>
</head>
<body>
	<a href="{{ url('/pdf') }}">Download PDF</a>
	<table>
		<tr>
			<th>No</th>
			<th>Product Price</th>
			<th>Price</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Laptop</td>
			<td>33,000</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Tablet</td>
			<td>15,000</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Mobile</td>
			<td>10,000</td>
		</tr>
	</table>

	div id="content">
     <h3>Hello, this is a H3 tag</h3>

    <p>a pararaph</p>
	</div>
	<div id="editor"></div>
	<button id="cmd">generate PDF</button>

<script>

	var doc = new jsPDF();
	var specialElementHandlers = {
	    '#editor': function (element, renderer) {
	        return true;
	    }
	};

	$('#cmd').click(function () {
	    doc.fromHTML($('#content').html(), 15, 15, {
	        'width': 170,
	            'elementHandlers': specialElementHandlers
	    });
	    doc.save('sample-file.pdf');
	});

</script>


</body>
</html>