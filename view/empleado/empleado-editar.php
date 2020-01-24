<h1 class="page-header">
    CAMPOS A IMPORTAR
</h1>

<ol class="breadcrumb">
    <li><a href="?c=Empleado">Importar</a></li>
    <li class="active">CAMPOS</li>
</ol>

<form id="frm-import">

    <input type="hidden" name="separador" value="<?php echo $separador; ?>"/>
    <input type="hidden" name="tabla" value="<?php echo $tabla; ?>"/>

    <?php echo $select; ?>
    <hr/>

</form>


<div class="text-right">
    <button class="btn btn-success" onclick="importar()">Guardar</button>
</div>


<div id='resp'></div>
<script>
  function importar () {
    $.ajax({
      type: 'POST',
      url: 'index.php?c=Empleado&a=Guardar',
      data: $('#frm-import').serialize(),
      success: function (response) {
        console.log(response)
        if (response == 'S') {
          $('#resp').html('<strong>Importado!</strong>')
          alert('Importado Exitosamente!')
        } else {
          $('#resp').html('<strong>Fallo Importacion!</strong>')
          alert('Fallo Importacion!')
        }

      },
    })

  }


</script>