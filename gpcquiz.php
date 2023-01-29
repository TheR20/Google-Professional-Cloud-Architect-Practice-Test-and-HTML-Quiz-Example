<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
</head>
<body>
  <img src="googleg1.jpg" id="monachina" width="800"
     height="500" >

    <?$correctos = $_POST["respcor"]?>
    <? $numpre = $_POST["quesnum"]?>

<div id="myData"></div>
<script type="text/javascript">

let respuestacorrecta = "";
let respuestacorrectaTexto = "";
let tamanioarrayrespuestas = "";
let tamaniorespuestas = "";
let arraypreguntas = [];
let arraypreguntasrandom = [];
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



   function createuniqueRan() {
  let arrayContainer = []; // this arrays holds the five random numbers generated;
  let displayContainer = document.getElementById("array");
  const genNum = Math.floor(Math.random() * data[numeroRandom].preguntas.length);
  arraypreguntasrandom.push(genNum);
  console.time();
  for (let counter = 0; counter < data[numeroRandom].preguntas.length-1; counter++) {
    //the counter is less than five because we already initialise arraypreguntasrandom[0] with genNum
    let newGen = Math.floor(Math.random() * data[numeroRandom].preguntas.length);
    while (arraypreguntasrandom.lastIndexOf(newGen) !== -1) {
      newGen = Math.floor(Math.random() * data[numeroRandom].preguntas.length);
    }
    arraypreguntasrandom.push(newGen);
  }
    }

createuniqueRan();
//generateUniqueRandom(10)


            //Con la data del json traemos las preguntas y las metemos en checkbox
            for (let i = 0; i < data[numeroRandom].preguntas.length; i++)
            {

              // let numero= generateUniqueRandom(data[numeroRandom].preguntas.length);
                //alert("numero unico "+ numero);
                 //let numero= 1


                const label = document.createElement("label");
                const checkbox = document.createElement("input");
                linebreak = document.createElement("br");
                checkbox.type="checkbox";
                checkbox.id= data[numeroRandom].preguntas[arraypreguntasrandom[i]].id;
                //alert("numero unico "+ arraypreguntasrandom[i])
               // alert("El id es "+ data[numeroRandom].preguntas[i].id)
                checkbox.name=""+ data[numeroRandom].id;
                checkbox.value = ""+ data[numeroRandom].preguntas[arraypreguntasrandom[i]].preg;
                const textContent = document.createTextNode(data[numeroRandom].preguntas[arraypreguntasrandom[i]].preg);
               // alert("La pregunta es "+ data[numeroRandom].preguntas[i].preg[i])
                label.appendChild(checkbox);
                label.appendChild(textContent);
                label.appendChild(linebreak);
                label.appendChild(linebreak);
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
                    respuestacorrectaTexto = respuestacorrectaTexto+"<br>" + data[numeroRandom].preguntas[matches].preg;
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
        var fotomonachina= document.getElementById("monachina");
        var numPreguntas= document.getElementById("quesnum");
        var numpreguntasnumero = parseInt(numPreguntas.value) +1
         if(result == respuestacorrecta.replaceAll(',',''))
         {
           // alert("Correct!");
            fotomonachina.src = "googleg3.jpg";
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
            fotomonachina.src = "googleg2.jpg";
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
