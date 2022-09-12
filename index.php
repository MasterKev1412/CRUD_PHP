<!doctype html>
<html lang="en">

<head>
  <title>CRUD PHP</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    
<!-- Button trigger modal -->
<div class="d-grid gap-2">
<button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="limpiarForms();">
  AGREGAR
</button>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">INGRESE DATOS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <div class="container">
    <form class="d-flex" action="estudiantes_crud.php" method="post">
        <div class="col">
        <div class="mb-3">
                <label for="txt_id" class="form-label">ID</label>
                <input type="text" name="txt_id" id="txt_id" class="form-control" placeholder="0" readonly>
            </div>

            <div class="mb-3">
                <label for="txt_carne" class="form-label">CODIGO</label>
                <input type="text" name="txt_carne" id="txt_carne" class="form-control" placeholder="E001" onchange="carnetValidacion(this);" require>
            </div>

            <div class="mb-3">
                <label for="txt_nombres" class="form-label">NOMBRES</label>
                <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Kevin Jose" require>
            </div>

            <div class="mb-3">
                <label for="txt_apellidos" class="form-label">APELLIDOS</label>
                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Lopez Perez" require>
            </div>

            <div class="mb-3">
                <label for="txt_direccion" class="form-label">DIRECCION</label>
                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="# casa # avenida, zona" require>
            </div>
            
            <div class="mb-3">
                <label for="txt_telefono" class="form-label">TELEFONO</label>
                <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="00000000" require>
            </div>


            <div class="mb-3">
                <label for="txt_correo" class="form-label">CORREO</label>
                <input type="text" name="txt_correo" id="txt_correo" class="form-control" placeholder="ejemplo@gmail.com" require>
            </div>


            <div class="mb-3">
              <label for="lbl_sangre" class="form-label">TIPO DE SANGRE</label>
              <select class="form-control" name="drop_sangre" id="drop_sangre">
                <option value=0>-----SANGRE-----</option>

                <?php 
                
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
                $db_conexion ->real_query("select id_tipos_sangre as id,sangre from tipos_sangre;");
                $resultado = $db_conexion->use_result();
                while ($fila = $resultado->fetch_assoc()) {

            
                    echo"<option value=".$fila['id'].">". $fila['sangre']. "</option>";


                }
                $db_conexion ->close();
                ?>
                
              </select>
            </div>
            
            <div class="mb-3">
                <label for="txt_fn" class="form-label">FECHA DE NACIMIENTO</label>
                <input type="date" name="txt_fn" id="txt_fn" class="form-control" require>
            </div>
            
            <div class="mb-3">
                
                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="AGREGAR" require>
                <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value="MODIFICAR" require>
                <input type="submit" class="btn btn-danger" id="btn_eliminar"  name="btn_eliminar" 
                 onclick="javascript:if(!confirm('Desea Eliminar Este Estudiante?')) return false " value="ELIMINAR" require>
            
            </div>

        </div>
    </form>
            </div> 



      </div>
      
    </div>
  </div>
</div>

<div class="container">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <h4>REGISTRO DE ESTUDIANTES</h4>
                <tr>
                    <th>CARNE</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>DIRECCION</th>
                    <th>TELEFONO</th>
                    <th>CORREO</th>
                    <th>TIPO DE SANGRE</th>
                    <th>FECHA DE NACIMIENTO</th>
                </tr>
                </thead>
                <tbody class="table-group-divider" id="tbl_empleados">

                <?php 
                
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
                $db_conexion ->real_query("select e.id_estudiante as id, e.carne,e.nombres, e.apellidos, e.direccion, e.telefono, e.correo_electronico, s.sangre,e.fecha_nacimiento, s.id_tipos_sangre from estudiantes as e inner join tipos_sangre as s on e.id_tipo_sangre = s.id_tipos_sangre;");
                $resultado = $db_conexion->use_result();
                while ($fila = $resultado->fetch_assoc()) {
 
            
                    echo"<tr data-id=".$fila['id']." data-ids=".$fila['id_tipos_sangre'].">";

                    echo"<td>".$fila['carne']."</td>";
                    echo"<td>".$fila['nombres']."</td>";
                    echo"<td>".$fila['apellidos']."</td>";
                    echo"<td>".$fila['direccion']."</td>";
                    echo"<td>".$fila['telefono']."</td>";
                    echo"<td>".$fila['correo_electronico']."</td>";
                    echo"<td>".$fila['sangre']."</td>";
                    echo"<td>".$fila['fecha_nacimiento']."</td>";

                    echo"</tr>";



                }
                $db_conexion ->close();
                ?>


                </tbody>
                <tfoot>
                    
                </tfoot>
        </table>
 </div> 
    


 
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>

  <script>
    $("#tbl_estudiantes").on('click','tr td',function (e) { 
        
        var target,id,ids,carne,nombres,apellidos,direccion,telefono,correo,nacimiento;
        target = $(event.target);
        id = target.parent().data('id');
        ids = target.parent().data('ids');
        carne = target.parent('tr').find("td").eq(0).html();
        nombres = target.parent('tr').find("td").eq(1).html();
        apellidos = target.parent('tr').find("td").eq(2).html();
        direccion = target.parent('tr').find("td").eq(3).html();
        telefono = target.parent('tr').find("td").eq(4).html();
        correo = target.parent('tr').find("td").eq(5).html();
        nacimiento = target.parent('tr').find("td").eq(7).html();

        $("#txt_id").val(id);
        $("#txt_carne").val(carne);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_direccion").val(direccion);
        $("#txt_telefono").val(telefono);
        $("#txt_correo").val(correo);
        $("#drop_sangre").val(ids);
        $("#txt_fn").val(nacimiento);
        $("#exampleModal").modal("show");
        
        
    });
  </script>
  <script type="text/javascript">
    function limpiarForms(){
      $('#txt_id').val(0);
      $("#drop_sangre").val(0);
      $("#txt_carne").val("");
      $("#txt_nombres").val("");
      $("#txt_apellidos").val("");
      $("#txt_direccion").val("");
      $("#txt_telefono").val("");
      $("#txt_correo").val("");
      $("#txt_fn").val("");
    }
    function carnetValidacion(text) {
      const pattern = /(^E{1})([0-9]{3})$/;
      if (!pattern.test(text.value)) {
        text.setCustomValidity
          ('INGRESE CODIGO VALIDO E001-E999');
      }else {
        text.setCustomValidity('');
    }
    return true;
    }
    </script>
</body>

</html>