
<html>
<head>
	<link rel="stylesheet" href="css/highlightText.css" type="text/css">

	<script>
	function makeEditableAndHighlight(colour) {
	    var range, sel = window.getSelection();
	    if (sel.rangeCount && sel.getRangeAt) {
	        range = sel.getRangeAt(0);
	    }
	    document.designMode = "on";
	    if (range) {
	        sel.removeAllRanges();
	        sel.addRange(range);
	    }
	    // Use HiliteColor since some browsers apply BackColor to the whole block
	    if (!document.execCommand("HiliteColor", false, colour)) {
	        document.execCommand("BackColor", false, colour);
	    }
	    document.designMode = "off";
	}

	function highlightSelection(colour) {
	    var range, sel;
	    if (window.getSelection) {
	        // IE9 and non-IE
	        try {
	            if (!document.execCommand("BackColor", false, colour)) {
	                makeEditableAndHighlight(colour);
	            }
	        } catch (ex) {
	            makeEditableAndHighlight(colour)
	        }
	    } else if (document.selection && document.selection.createRange) {
	        // IE <= 8 case
	        range = document.selection.createRange();
	        range.execCommand("BackColor", false, colour);
	    }
	}
	</script>
</head>
<body>
	<div onmouseup="highlightSelection('yellow')">
	    The jury trial is one of the handful of democratic
	<br>
	    institutions that allow <b>individual citizens</b>, rather than
	<br>
	the government, to make important societal decisions.
	<br>
	A crucial component of the jury trial, at least in serious
	<br>
	criminal cases, is the rule that verdicts be unanimous
	<br>
	among the jurors (usually twelve in number). Under
	<br>
	this requirement, dissenting jurors must either be
	<br>
	convinced of the rightness of the prevailing opinion, or,
	<br>
	conversely, persuade the other jurors to change their
	<br>
	minds. In either instance, the unanimity requirement
	<br>
	compels the jury to deliberate fully and truly before
	<br>
	reaching its verdict. Critics of the unanimity
	<br>
	requirement, however, see it as a costly relic that
	<br>
	extends the deliberation process and sometimes, in a
	<br>
	hung (i.e., deadlocked) jury, brings it to a halt at the
	<br>
	hands of a single, recalcitrant juror, forcing the judge to
	<br>
	order a retrial. Some of these critics recommend
	<br>
	reducing verdict requirements to something less than
	<br>
	unanimity, so that one or even two dissenting jurors
	<br>
	will not be able to force a retrial.
	<br>
	But the material costs of hung juries do not warrant
	<br>
	losing the beneﬁt to society of the unanimous verdict.
	<br>
	Statistically, jury trials are relatively rare; the vast
	<br>
	majority of defendants do not have the option of a jury
	<br>
	trial or elect to have a trial without a jury&mdash;or they
	<br>
	plead guilty to the original or a reduced charge. And
	<br>
</div>
</body>
</html>