<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
</head>
<body>
  <img src="googleg1.jpg" width="400"
     height="500" >

    <?$correctos = $_POST["respcor"]?>
    <? $numpre = $_POST["quesnum"]?>

<div id="myData"></div>
<script type="text/javascript">

let respuestacorrecta = "";
let respuestacorrectaTexto = "";
let tamanioarrayrespuestas = "";
let tamaniorespuestas = ""

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

    //Generamos un numero random
    function generateRandomInteger(max)
    {
        return Math.floor(Math.random() * max) + 1;
    }

let numeroRandom = generateRandomInteger(5);

    //Traemos la data del Json y la metemos en divs
    function appendData(data)
    {
        let mainContainer = document.getElementById("myData");
        let div = document.createElement("div");
        linebreak2 = document.createElement("br");
        div.innerHTML = data[numeroRandom].pregunta;
        mainContainer.appendChild(div);
        mainContainer.appendChild(linebreak2);

            //Con la data del json traemos las preguntas y las metemos en checkbox
            for (let i = 0; i < data[numeroRandom].preguntas.length; i++)
            {
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
                document.body.appendChild(label);
            }
            tamaniorespuestas = data[numeroRandom].preguntas.length
            tamanioarrayrespuestas = data[numeroRandom].respuestacorrecta.length;
            respuestacorrecta = respuestacorrecta + data[numeroRandom].respuestacorrecta;
                for(respuestas of data[numeroRandom].respuestacorrecta)
                {
                    var matches = respuestas.match(/\d+/)[0];
                    alert("Son una respuesta  " + matches)
                    respuestacorrectaTexto = respuestacorrectaTexto+"<br>" + data[numeroRandom].preguntas[matches];
                }
    }
    function singlecheckbox(resultado){
        var checkboxsimple= document.getElementById(resultado);
        var result= " ";
        if (checkboxsimple.checked == true)
          {
            var idcheckboxsimple= document.getElementById(resultado).id;
            result = idcheckboxsimple + "";
          }
          else
            result = ""
         return result ;
    }
    //Revisamos cada checkbox si esta checkeado trayendolo con el ID
    function getCheckboxValue()
    {
        var result= "";
        for(let i = 0; i<tamaniorespuestas; i++){
            result = result + singlecheckbox ("s"+i)
        }
        var resultsincomas = respuestacorrecta.split(',').join('');
         if(result == respuestacorrecta.replaceAll(',',''))
         {
           // alert("Correct!");
            var numPreguntas= document.getElementById("quesnum");
            var numpreguntasnumero = parseInt(numPreguntas.value) +1
            numPreguntas.value = numpreguntasnumero.toString();
            var respuestaCorrectas= document.getElementById("respcor");
            var respuestacorrectasnumero = parseInt(respuestaCorrectas.value) +1 ;
            respuestaCorrectas.value = respuestacorrectasnumero.toString();
            //Se despliega la respuesta correcta en el h4
         return document.getElementById("result").innerHTML= "CORRECT!!"+ "<br>" + "The correct answer is " + respuestacorrectaTexto;
        }
         else
         {
            //alert("The correct Answer is" + respuestacorrecta.replaceAll(',',''));
            var numPreguntas= document.getElementById("quesnum");
            var numpreguntasnumero = parseInt(numPreguntas.value) +1
            numPreguntas.value = numpreguntasnumero.toString();
            return document.getElementById("result").innerHTML= "TRY AGAIN!"+ "<br>" + "The correct answer is " + respuestacorrectaTexto;
         }
    }
</script>


<button onclick= "getCheckboxValue()">Check my answer!</button>
<h4 id="result"></h4>

<form action="/gpc/gpcquiz2.php" method="post">
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
