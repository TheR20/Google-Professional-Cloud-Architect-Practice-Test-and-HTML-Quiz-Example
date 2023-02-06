<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Professional Cloud Architect Practice Exam</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<style>
    .center{
      display: flex;
      flex-direction: column;
  justify-content: center;
  align-items: center;
    },
  .bold{

font-weight:900;
    }

</style>
<body style="background-color:#eaeaea ;">
    <br>


    <?$correctos = $_POST["respcor"]?>
    <? $numpre = $_POST["quesnum"]?>
    <? $totalnumpre = $_POST["numpreguntas"]?>

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

let numeroRandom = generateRandomInteger(75);

    //Traemos la data del Json y la metemos en divs
    function appendData(data)
    {
        let mainContainer = document.getElementById("myData");
        let div = document.createElement("div");
        linebreak2 = document.createElement("br");
        div.innerHTML = data[numeroRandom].pregunta;
         div.classList.add('container') ;
         div.style.fontWeight = "bold";
        mainContainer.appendChild(div);
        mainContainer.appendChild(linebreak2);


      //Generador numeros random.
   function createuniqueRan() {
     let arrayContainer = []; // this arrays holds the five random numbers generated;
     let displayContainer = document.getElementById("array");
     const genNum = Math.floor(Math.random() * data[numeroRandom].preguntas.length);
     arraypreguntasrandom.push(genNum);
     console.time();
         for (let counter = 0; counter < data[numeroRandom].preguntas.length-1; counter++)
         {
            //the counter is less than five because we already initialise arraypreguntasrandom[0] with genNum
            let newGen = Math.floor(Math.random() * data[numeroRandom].preguntas.length);
            while (arraypreguntasrandom.lastIndexOf(newGen) !== -1) {
              newGen = Math.floor(Math.random() * data[numeroRandom].preguntas.length);
            }
            arraypreguntasrandom.push(newGen);
         }
    }

//Generamos numeros random que no se repitan que usaremos para acomodar las preguntas.
createuniqueRan();
                 let div2 = document.createElement("div");
                 let div3 = document.createElement("div");
                 let divpreguntas = document.getElementById("preguntas");
                 div3.classList.add('center') ;

            //Con la data del json traemos las preguntas y las metemos en checkbox
            for (let i = 0; i < data[numeroRandom].preguntas.length; i++)
            {
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
              /// label.appendChild(div2);
                label.appendChild(checkbox);
                label.appendChild(textContent);
                //label.appendChild(linebreak);

                div2.appendChild(label);
                div2.appendChild(linebreak);
                 div3.appendChild(div2);

                 divpreguntas.appendChild(div3);
                //document.body.appendChild(div3);


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

        var botonchecars= document.getElementById("botonchecar").disabled = true;
         var botonenviar= document.getElementById("botonenviar").disabled = false;
        var result= "";
        for(let i = 0; i<tamaniorespuestas; i++){
            result = result + singlecheckbox ("s"+i)
        }
        var resultsincomas = respuestacorrecta.split(',').join('');
       // var fotomonachina= document.getElementById("monachina");
        var numPreguntas= document.getElementById("quesnum");
        var numpreguntasnumero = parseInt(numPreguntas.value) +1
         if(result == respuestacorrecta.replaceAll(',',''))
         {
           // alert("Correct!");

            //fotomonachina.src = "googleg3.jpg";
            numPreguntas.value = numpreguntasnumero.toString();
            var respuestaCorrectas= document.getElementById("respcor");
            var respuestacorrectasnumero = parseInt(respuestaCorrectas.value) +1 ;
            respuestaCorrectas.value = respuestacorrectasnumero.toString();
            //Se despliega la respuesta correcta en el h2
            checkitsdone();
           // alert("Ya Acabaste wey si");
         return document.getElementById("result").innerHTML= "CORRECT!!"+ "<br>" + "The correct answer is " + respuestacorrectaTexto;
        }
         else
         {

            //alert("The correct Answer is" + respuestacorrecta.replaceAll(',',''));
          //  fotomonachina.src = "googleg2.jpg";
            numPreguntas.value = numpreguntasnumero.toString();
            checkitsdone();
           // alert("Ya Acabaste wey no");
            return document.getElementById("result").innerHTML= "TRY AGAIN!"+ "<br>" + "The correct answer is " + respuestacorrectaTexto;
         }
    }

    function checkitsdone(){
        var respuestanum= document.getElementById("quesnum");
            var respuestanum = parseInt(respuestanum.value)
            var respuestaCorrectas= document.getElementById("respcor");
            var respuestacorrectasnumero = parseInt(respuestaCorrectas.value)
            var totalnum = "<?php echo $totalnumpre; ?>" ;
            //alert("Total "+totalnum +" Vas en la pregunta "+ respuestanum);
        if(respuestanum >= totalnum)
        {
           // alert("YOU HAVE FINISHED YOUR EXAM!!! CONTRATS!");
            var botonchecars= document.getElementById("botonreiniciar").disabled = false;
            var botonenviar= document.getElementById("botonenviar").disabled = true;
            document.getElementById("resultfinal").innerHTML= "YOU HAVE FINISHED THE EXAM" +"<br>" + "CORRECT ANSWERS: " + respuestacorrectasnumero+ " OF "+respuestanum
        }
    }

    function regresar()
    {
        location.href = "https://megabanana.mx/gpc/gpcquiz2.php";
    }

</script>


<div class="field has-addons has-addons-centered" id="divpreguntaprincipal">

</div>

<div class="field has-addons has-addons-centered">
<button onclick= "getCheckboxValue()" class="button is-success" id="botonchecar">Check my answer!</button>
<button onclick= "regresar()" class="button is-warning" id="botonreiniciar" >Restart Exam!</button>
</div>
<div>
<div class="field has-addons has-addons-centered">
    <h2 id="resultfinal" style="font-weight:700;"></h2>
<h2 id="result" style="font-weight:600;"></h2>
    </div>
    </div>
 <div class="field has-addons has-addons-centered">
<form action="/gpc/gpcquiz.php" method="post">
    <label for="fname">Question Number:</label>
<input type="text"id="quesnum" class="label" value="<?php echo $correctos; ?>" name="respcor" >
<label for="fname">Correct Ones</label>
<input type="text" class="label" id="respcor" value="<?php echo $numpre; ?>" name="quesnum" >
<input type="hidden" class="label" id="respcor" value="<?php echo $totalnumpre; ?>" name="numpreguntas" >
<input type="submit" id="botonenviar" class="button is-info" value="Next Question" disabled>
</form>
<!--
       <div class="centroMargen">
<img src="googleg1.jpg" id="monachina" width="180"
     height="100" >
</div>-->
</div>
</div>
<br>
<div class="field has-addons has-addons-centered">
<h2 class="bold" style="font-weight:900;">ANSWERS:</h2> <br>
</div>
<div class="field has-addons has-addons-centered" id= "preguntas">
</div>
</body>
</html>
