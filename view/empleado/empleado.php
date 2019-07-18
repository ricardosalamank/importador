<h1 class="page-header">IMPORTADOR</h1>

<!------
<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Empleado&a=Crud">Nuevo Empleado</a>
</div>
------>

<form id="frm-empleado" action="?c=Empleado&a=forValid" method="post" enctype="multipart/form-data">
 
    <div class="form-group">
        <label>Adjunta Archivo A Importar</label>
        <input type="file" name="archivo"  class="form-control"  />
    </div>

    <div class="form-group">
        <label>Separador</label>
        <input type="text" name="separador" class="form-control" placeholder="Ingrese su separador" data-validacion-tipo="requerido|min:1" />
    </div>

    <div class="form-group">
        <label>Tabla</label>
        <input type="text" name="tabla" class="form-control" placeholder="Ingrese su tabla" data-validacion-tipo="requerido|min:3" />
    </div>

    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Validar</button>
    </div>
</form>


<!------
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Nombre</th>
            <th>Apellido</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->nombre; ?></td>
            <td><?php echo $r->apellido; ?></td>
            <td>
                <a href="?c=Empleado&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Empleado&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
----->