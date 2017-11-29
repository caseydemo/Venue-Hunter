<!DOCTYPE html>
<html>
<head>
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

<script>
	var doc = new jsPDF();          
	var elementHandler = {
	  '#ignorePDF': function (element, renderer) {
	    return true;
	  }
	};
	var source = window.document.getElementsByTagName("body")[0];
	doc.fromHTML(
	    source,
	    15,
	    15,
	    {
	      'width': 180,'elementHandlers': elementHandler
	    });

	doc.output("dataurlnewwindow");
</script>


</body>
</html>