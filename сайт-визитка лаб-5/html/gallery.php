<!DOCTYPE html>
<html lang="en">
<html>
<head>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gallery</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet"  href="../style/gallery.css">
  <script type="text/javascript">
  var block; // Основной блок
  var block_r; // Блок для изменения размеров
  var delta_w = 0; // Изменение по ширине
  var delta_h = 0; // Изменение по высоте
  /* После загрузки страницы */
  onload = function () {
    
    block = document.getElementById("block"); // Получаем основной блок
    block_r = document.getElementById("block_resize"); // Получаем блок для изменения размеров
    document.onmouseup = clearXY; // Ставим обработку на отпускание кнопки мыши
    block_r.onmousedown = saveWH; // Ставим обработку на нажатие кнопки мыши
  }
  /* Функция для получения текущих координат курсора мыши */
  function getXY(obj_event) {
    if (obj_event) {
      x = obj_event.pageX;
      y = obj_event.pageY;
    }
    else {
      x = window.event.clientX;
      y = window.event.clientY;
      if (ie) {
        y -= 2;
        x -= 2;
      }
    }
    return new Array(x, y);
  }
  function saveWH(obj_event) {
    var point = getXY(obj_event);
    w_block = block.clientWidth; // Текущая ширина блока
    h_block = block.clientHeight; // Текущая высота блока
    delta_w = w_block - point[0]; // Измеряем текущую разницу между шириной и x-координатой мыши
    delta_h = h_block - point[1]; // Измеряем текущую разницу между высотой и y-координатой мыши
    /* Ставим обработку движения мыши для разных браузеров */
    document.onmousemove = resizeBlock;
    if (op || ff) document.addEventListener("onmousemove", resizeBlock, false);
    return false; // Отключаем стандартную обработку нажатия мыши
  }
  /* Функция для измерения ширины окна */
  function clientWidth() {
    return document.documentElement.clientWidth == 0 ? document.body.clientWidth : document.documentElement.clientWidth;
  }
  /* Функция для измерения высоты окна */
  function clientHeight() {
    return document.documentElement.clientHeight == 0 ? document.body.clientHeight : document.documentElement.clientHeight;
  }
  /* При отпускании кнопки мыши отключаем обработку движения курсора мыши */
  function clearXY() {
    document.onmousemove = null;
  }
  function resizeBlock(obj_event) {
    var point = getXY(obj_event);
    new_w = delta_w + point[0]; // Изменяем новое приращение по ширине
    new_h = delta_h + point[1]; // Изменяем новое приращение по высоте
    block.style.width = new_w + "px"; // Устанавливаем новую ширину блока
    block.style.height = new_h + "px"; // Устанавливаем новую высоту блока
    /* Если блок выходит за пределы экрана, то устанавливаем максимальные значения для ширины и высоты */
    if (block.offsetLeft + block.clientWidth > clientWidth()) block.style.width = (clientWidth() - block.offsetLeft)  + "px";
    if (block.offsetTop + block.clientHeight > clientHeight()) block.style.height = (clientHeight() - block.offsetTop) + "px";
  }
</script>  
</head>
<body>
	<header><h2>Галерея</h2></header>

	
<div id="block">

  <img id="image" title="1. Изменить размер картинки можно растягивая ее за черный уголок. 
2. При нажатии на изображение оно меняется  на следующее." src="../style/img/1.jpg" onClick="imgsrc();">

  <div id="block_resize"></div>

</div>
<form action="../php/index.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<script language="javascript">//Переключение картинок
        var i=0;
        var image=document.getElementById("image");
        var imgsArray=new Array( 
            <?php
        
            $dir = '../style/img/'; 
            $img_files = preg_grep('/^([^.])/',scandir($dir));
            $i = 1;
            foreach ($img_files as $f) {
                echo "'/style/img/" . $f . "'";
                if ($i++<count($img_files)) echo ",";
            }
            ?> 
            );
        function imgsrc(){
                var i=getRandomInt(0,imgsArray.length);
                image.src=imgsArray[i];
            }
             
             function getRandomInt(min, max) {
                 var randNum =Math.floor(Math.random() * (max - min)) + min;
                 return randNum;
             }
    </script>
</body>
</html>