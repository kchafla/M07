<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Exemple de formulari</title>
</head>

<body>
    <div style="margin: 30px 10%;">
        <h3>Formulario</h3>
        <form enctype="multipart/form-data" action="processa_dades.php" method="post" id="myform" name="myform">

            <label>Texto </label><input type="text" value="" size="30" maxlength="100" name="mytext" id="" /><br/><br/>

            <input type="radio" name="myradio" value="1"/> Primera opcion
            <input type="radio" checked="checked" name="myradio" value="2"/> Segunda opcion<br/><br/>

            <input type="checkbox" name="mycheckbox[]" value="1"/> Primera casilla
            <input type="checkbox" checked="checked" name="mycheckbox[]" value="2" /> Segunda casilla<br/><br/>

            <label>Selecciona ... </label>
            <select name="myselect" id="">
                <optgroup label="group 1">
                    <option value="1" selected="selected">Primer objeto</option>
                </optgroup>
                <optgroup label="group 2" >
                    <option value="2">Segundo objeto</option>
                </optgroup>
            </select><br/><br/>

            <textarea name="mytextarea" id="" rows="3" cols="30">Texto ...</textarea><br/><br/>

            <input type="file" name="myfile" id=""/><br/><br/>

            <button id="mysubmit" type="submit">Enviar</button><br/><br/>

        </form>
    </div>
</body>
</html>