<? 
$archivo_name = $_FILES['subir']['name'];
$archivo_size = $_FILES['subir']['size'];
$archivo_type = $_FILES['subir']['type'];
$cant= filesize($_FILES["subir"]['tmp_name']);

if($archivo_type=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){}else {
echo "<script> alert('Archivo Incorrecto') </script>";
exit();}

if (is_uploaded_file($_FILES['subir']['tmp_name'])) {
	$validar=move_uploaded_file($_FILES['subir']['tmp_name'], "EXCEL/PlantillaExcel/Temp.xlsx");
	if($validar){echo "<script> parent.importar() </script>";}
	else {echo "<script> alert('Error') </script>";}
	
	
} else {
	echo "<script> alert('Error') </script>";
	exit();
	
	}
?>