<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<nav class = "navbar navbar-dark bg-dark">
    <div class="container">
        <h1 class="navbar-brand">PHP MYSQL CRUD</h1>
    </div>

</nav>
<div class="row">
        <div class="col-md-4">          
            <div class="card card-body">
                <form id = 'formestudiante'>
                    <div class="form-gruop">
                        <input type="text" name="cedula" id="cedula" class="form-control"
                        placeholder="CEDULA" autofocus required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" rows="2" class="form-control"
                        placeholder="NOMBRE" autofocus required="true">
                    </div>
                    <div class="form-gruop">
                        <input type="text" name="apellido" id="apellido" class="form-control"
                        placeholder="APELLIDO" autofocus required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="direccion" id="direccion" rows="2" class="form-control"
                        placeholder="DIRECCION" autofocus required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefono" id="telefono" rows="2" class="form-control"
                        placeholder="TELEFONO" autofocus required="true">
                    </div>
                    <input type="submit" class="btn btn-success btn-block"
                    name="btn" id="btn" value="Enviar">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>CEDULA</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>DIRECCION</th>
                        <th>TELEFONO</th>
                    </tr>
                </thead>
                <tbody id="estudiantes">
                    
                </tbody>    
            </table>
        </div>
    </div>

    <script src="./vista/jspuro.js"></script>

</body>
</html>