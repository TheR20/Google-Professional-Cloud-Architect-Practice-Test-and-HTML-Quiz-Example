<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
</head>
<body>
  <img src="mona.jpg" width="400"
     height="500" >

      <?$correctos = $_POST["respcor"]?>
           <? $numpre = $_POST["quesnum"]?>



<div id="myData"></div>
<script type="text/javascript">

let respuestacorrecta = "";
let respuestacorrectaTexto = "";
    fetch('people.json')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            appendData(data);
        })
        .catch(function (err) {
            console.log('error: ' + err);
        });


function generateRandomInteger(max) {
    return Math.floor(Math.random() * max) + 1;
}

let numeroRandom = generateRandomInteger(5);

    function appendData(data) {
        let mainContainer = document.getElementById("myData");
            let div = document.createElement("div");
            linebreak2 = document.createElement("br");
            div.innerHTML = data[numeroRandom].pregunta;
            mainContainer.appendChild(div);
             mainContainer.appendChild(linebreak2);
            respuestacorrecta = data[numeroRandom].respuestacorrecta;
            for (let i = 0; i < data[numeroRandom].preguntas.length; i++) {
    const label = document.createElement("label");
    const checkbox = document.createElement("input");
    linebreak = document.createElement("br");
    checkbox.type="checkbox";
    checkbox.id= "s"+i;
    checkbox.name=""+ data[numeroRandom].id;
    checkbox.value = ""+ data[numeroRandom].preguntas[i];
    const textContent = document.createTextNode(data[numeroRandom].preguntas[i]);
    label.appendChild(checkbox);
    label.appendChild(textContent);
    label.appendChild(linebreak);
    label.appendChild(linebreak);
    label.appendChild(linebreak);
    label.appendChild(linebreak);
    label.appendChild(linebreak);
    document.body.appendChild(label);
    if("s"+i == respuestacorrecta)
    respuestacorrectaTexto = ""+ data[numeroRandom].preguntas[i];
            }


    }

function getCheckboxValue() {
    var lang0= document.getElementById("s0");
  var lang1= document.getElementById("s1");
   var lang2= document.getElementById("s2");
   var lang3= document.getElementById("s3");
 var lang4= document.getElementById("s4");
 var lang5= document.getElementById("s5");
  var result= " ";
  if (lang0.checked == true){
    var lg0= document.getElementById("s0").id;
    result= lg0 + "";
  }
  else if (lang1.checked == true){
    var lg1= document.getElementById("s1").id;
    result= result + lg1 + " ";
  }
  else if (lang2.checked == true){
    var lg2= document.getElementById("2").id;
    result= result + lg2 ;
  }
  else if (lang3.checked == true){
    var lg3= document.getElementById("s3").id;
    result= result + lg3 ;
  }
  else if (lang4.checked == true){
    var lg4= document.getElementById("s4").id;
    result= result + lg4 ;
  }
  else if (lang5.checked == true){
    var lg5= document.getElementById("s5").id;
    result= result + lg5 ;
  }
   else {
  return document.getElementById("result").innerHTML= "Select any one";
  }
   if(result == respuestacorrecta){
    alert("Correct!");
    var numPreguntas= document.getElementById("quesnum");
    var numpreguntasnumero = parseInt(numPreguntas.value) +1
    numPreguntas.value = numpreguntasnumero.toString();
    var respuestaCorrectas= document.getElementById("respcor");
    var respuestacorrectasnumero = parseInt(respuestaCorrectas.value) +1
    respuestaCorrectas.value = respuestacorrectasnumero.toString();;
}
else{
    alert("The correct Answer is" + respuestacorrecta);
    var numPreguntas= document.getElementById("quesnum");
    var numpreguntasnumero = parseInt(numPreguntas.value) +1
    numPreguntas.value = numpreguntasnumero.toString();
}


  return document.getElementById("result").innerHTML= "The correct answer is " + respuestacorrectaTexto;


}

</script>


<button onclick= "getCheckboxValue()">Check my answer!</button>
<h4 id="result"></h4>

<form action="/gpc/gpcquiz.php" method="post">
    <label for="fname">Question Numer:</label>
<input type="text"id="quesnum" value="<?php echo $correctos; ?>" name="respcor" ><br>
<label for="fname">Correct Ones</label>
<input type="text" id="respcor" value="<?php echo $numpre; ?>" name="quesnum" ><br>
<input type="submit" value="Next Question">
</form>
<br>
<h2>ANSWERS:</h2>

</body>
</html>
