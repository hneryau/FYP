<!doctype html>
<html>
<head>

<script src="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript" src="CreateQuestionEditor/ckeditor.js"></script>



<script>
	var i=0;
	var questionNumber = 0;
	
	function addnewfib() {
			i++;
			questionNumber++;
			$('#y')
			.append('<div class="question" id="question'+i+'">');
			$('#question'+i)
			.append('Question Number:&nbsp;'+" "+ '<input type="number" name="qn'+i+'" value="'+i+'" ><br>')
			.append('Question Content:<br><b><font color="red">You may use (A), (B), (C), (D) as the answer blanks.</font></b><br>'+" "+ '<textarea name="editor'+i+'"></textarea>')
			.append('<b><font color="red">If the answer has alternative answer(s), use "&&" to separate each answer in the text box. Eg. "color&&colour" </font></b>')
			.append('<br>Partial Mark? <input type="checkbox" name="partialmark'+i+'" id="partialmark'+i+'" onChange="partialmark('+i+')" required>')
			.append('<br><table>')
			.append('<th width="100">Answer</th><th></th><th width="30">Answer Score</th>')
			.append('<tr><td align="center">A</td><td><textarea name ="answera'+i+'"></textarea></td><td><input style="visibility:hidden" type="number" name="ansascore'+i+'" id="ansascore'+i+'" value ="1" onChange="totalise('+i+')" required></td><td><input type="checkbox" name="inva'+i+'" value="inva'+i+'">Reversible?<input type="checkbox" name="csa'+i+'" checked="checked">Case Sensitive?</td></tr>')
			.append('<tr><td align="center">B</td><td><textarea name ="answerb'+i+'"></textarea></td><td><input style="visibility:hidden" type="number" name="ansbscore'+i+'" id="ansbscore'+i+'" value ="1" onChange="totalise('+i+')" required></td><td><input type="checkbox" name="invb'+i+'" value="invb'+i+'">Reversible?<input type="checkbox" name="csb'+i+'" checked="checked">Case Sensitive?</td></tr>') 
			.append('<tr><td align="center">C</td><td><textarea name ="answerc'+i+'"></textarea></td><td><input style="visibility:hidden" type="number" name="anscscore'+i+'" id="anscscore'+i+'" value ="1" onChange="totalise('+i+')" required></td><td><input type="checkbox" name="invc'+i+'" value="invc'+i+'">Reversible?<input type="checkbox" name="csc'+i+'" checked="checked">Case Sensitive?</td></tr>')
			.append('<tr><td align="center">D</td><td><textarea name ="answerd'+i+'"></textarea></td><td><input style="visibility:hidden" type="number" name="ansdscore'+i+'" id="ansdscore'+i+'" value ="1" onChange="totalise('+i+')" required></td><td><input type="checkbox" name="invd'+i+'" value="invd'+i+'">Reversible?<input type="checkbox" name="csd'+i+'" checked="checked">Case Sensitive?</td></tr>')
			.append('<tr><td align="center">Question Score:&nbsp;</td><td> <input type="number" value ="1" id ="mark'+i+'" name ="mark'+i+'"></td></tr>')
			.append('</table><br>')
			.append('<input value="Remove Question" type = "button" onClick="removequestion('+i+')" name="remove'+i+'">')
			.append('<input type="hidden" name="type'+i+'" value="FIB">');
			CKEDITOR.replace( 'editor'+i );
	}

	function addnewmc(){
		i++;
		questionNumber++;
		$('#y')
		.append('<div class="question" id="question'+i+'">')
		$('#question'+i)
		.append('Question Number:&nbsp;'+" "+ '<input type="text" name="qn'+i+'" value="'+i+'" ><br>')
		.append('Question Content:<br>'+" "+ '<textarea name="editor'+i+'"></textarea>')
		.append('<br><table>')
		.append('<th>Answer</th><th width="30">Choice</th>')
		.append('<tr><td align="center"><input type="radio" value="A" name="ans'+i+'"/></td><td><input type="text" name ="choicea'+i+'"></td></tr>')
		.append('<tr><td align="center"><input type="radio" value="B" name="ans'+i+'"/></td><td><input type="text" name ="choiceb'+i+'"></td></tr>')
		.append('<tr><td align="center"><input type="radio" value="C" name="ans'+i+'"/></td><td><input type="text" name ="choicec'+i+'"></td></tr>')
		.append('<tr><td align="center"><input type="radio" value="D" name="ans'+i+'"/></td><td><input type="text" name ="choiced'+i+'"></td></tr>')
		.append('<tr><td align="center">Question Score:&nbsp;</td><td><input type="text" value ="1" name ="mark'+i+'"></td></tr>')
		.append('</table><br>')
		.append('<input value="Remove Question" type = "button" onClick="removequestion('+i+')" name="remove'+i+'">')
		.append('<input type="hidden" name="type'+i+'" value="MC">');
		CKEDITOR.replace( 'editor'+i );
	}
	function removequestion(a){
		$('#question'+a).remove();
		questionNumber--;
	}
	function submitform(){
		$('#y').append('<input type="hidden" name="total" value="'+questionNumber+'">');
		document.myform.submit();
	}
	 function totalise(a) {    
	 	var ansascore   = parseInt(document.getElementById('ansascore'+a).value);
    	var ansbscore   = parseInt(document.getElementById('ansbscore'+a).value);
    	var anscscore   = parseInt(document.getElementById('anscscore'+a).value);
		var ansdscore   = parseInt(document.getElementById('ansdscore'+a).value);
		var result = document.getElementById('mark'+a);
    	result.value = ansascore+ansbscore+anscscore+ansdscore;
	}
	
	function partialmark(a) {
		var checkbox = document.getElementById('partialmark'+a);
		var ansascore   = document.getElementById('ansascore'+a);
    	var ansbscore   = document.getElementById('ansbscore'+a);
    	var anscscore   = document.getElementById('anscscore'+a);
		var ansdscore   = document.getElementById('ansdscore'+a);
		var result = document.getElementById('mark'+a);
		if (checkbox.checked==true){
			result.setAttribute('readonly');
			
			ansascore.style.visibility = 'visible'; 
			ansbscore.style.visibility = 'visible'; 
			anscscore.style.visibility = 'visible'; 
			ansdscore.style.visibility = 'visible';
			
		}
		if (checkbox.checked==false){
			result.removeAttribute('readonly');
			 ansascore.style.visibility = 'hidden'; 
			ansbscore.style.visibility = 'hidden'; 
			anscscore.style.visibility = 'hidden'; 
			ansdscore.style.visibility = 'hidden'; 
		}
		
	}
	

</script>

<meta charset="utf-8">
<title>Create Question</title>
</head>

<body>
<form name="myform" action="doCreateQuestion.php<?php echo '?test_id='.$_GET['test_id']."&book_id=".$_GET['book_id']."&chapter_id=".$_GET['chapter_id']."&author_id=".$_GET['author_id']?>" method="post">

<div id='y'></div>

<input type="button" onClick="addnewmc()"value="Add MC" id="showbutton"/>
<input type="button" onClick="addnewfib()"value="Add FIB" id="showbutton"/>
<input type="button" onclick="submitform()" value="Submit"/>
</form>
</body>
</html>