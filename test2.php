<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <select id="box1" onChange="myNewFunction(this);">
      <option value="98">dog</option>
      <option value="7122">cat</option>
      <option value="142">bird</option>

   </select>
   <button onclick="myFunction()">submit</button>
   <div id="text"></div>
   <script>
      function myNewFunction(sel) {
         alert(sel.options[sel.selectedIndex].text);

      }

      function myFunction() {
         let sel = document.getElementById("box1");
         let text = sel.options[sel.selectedIndex].text;
         document.getElementById("text").innerText = text;
      }
   </script>
</body>

</html>