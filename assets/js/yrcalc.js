<!--- Calculate Pre-primary year --->
function Calculate() {
	<!-- Clear the output first -->
	document.getElementById('pkYearField').innerHTML = '';
	document.getElementById('kYearField').innerHTML = '';
	document.getElementById('ppYearField').innerHTML = '';
	document.getElementById('4YearField').innerHTML = '';
	document.getElementById('7YearField').innerHTML = '';
	document.getElementById('12YearField').innerHTML = '';

	<!-- Get the input values -->
	var month = parseInt(document.YrCalc.Month.options[document.YrCalc.Month.selectedIndex].value);
	var year = parseInt(document.YrCalc.Year.options[document.YrCalc.Year.selectedIndex].value);

	<!-- Calculate the Pre-primary year -->
	if (year != 0 && month != 0) {
		if (year < 1997 || month < 7)
			var ppyear = year + 5;
		else
			var ppyear = year + 6;

		<!-- Write out the result -->
		var yearText = document.createTextNode(ppyear);
    	var target = document.getElementById("ppYearField");
    	target.appendChild(yearText);

			yearText = document.createTextNode(ppyear - 1);
    	target = document.getElementById("kYearField");
    	target.appendChild(yearText);

			yearText = document.createTextNode(ppyear - 2);
    	target = document.getElementById("pkYearField");
    	target.appendChild(yearText);

    	yearText = document.createTextNode(ppyear + 4);
    	target = document.getElementById("4YearField");
    	target.appendChild(yearText);

    	yearText = document.createTextNode(ppyear + 7);
    	target = document.getElementById("7YearField");
    	target.appendChild(yearText);

    	yearText = document.createTextNode(ppyear + 12);
    	target = document.getElementById("12YearField");
    	target.appendChild(yearText);
	}
}
