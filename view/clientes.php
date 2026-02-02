<?php require("layout/header.php"); ?>

<h1>CLIENTES</h1>
<br />
<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Fecha de nacimiento</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>Dirección</th>
            <th>Código postal</th>
            <th>Población</th>
            <th>Provincia</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($clientes->filas) :
            foreach ($clientes->filas as $fila) :
        ?>
                <tr>
                    <td style="text-align: center; width: 5%;"><?php echo $fila->id; ?></td>
                    <td><?php echo $fila->nombre; ?></td>
                    <td><?php echo $fila->apellidos; ?></td>
                    <td><?php echo $fila->fechanacimiento; ?></td>
                    <td><?php echo $fila->email; ?></td>
                    <td><?php echo Crypt::Desencriptar($fila->contrasenya); ?></td>
                    <td><?php echo $fila->direccion; ?></td>
                    <td><?php echo $fila->cp; ?></td>
                    <td><?php echo $fila->poblacion; ?></td>
                    <td><?php echo $fila->provincia; ?></td>
                    
                    <td style="text-align: right; width: 50%;">
                        <a href="index.php?c=clientes&m=editar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-success">Editar</button></a>
                        <a href="index.php?c=clientes&m=borrar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-danger borrar"
                                onclick="return confirm('¿Estás seguro de borrar el registro <?php
                                echo $fila->id; ?>?');">Borrar</button></a>
                    </td>
                </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <a href="index.php?c=clientes&m=nuevo">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                </a>
                <a href="index.php?c=clientes&m=exportar">
                    <button type="button" class="btn btn-success">Exportar</button>
                </a>
              <!--
                <a href="index.php?c=clientes&m=exportarjson">
                    <button type="button" class="btn btn-primary">Exportar Json</button>
                </a>
                -->
                <a href="?c=clientes&m=imprimir" target="_blank">
                    <button type="button" class="btn btn-primary">Imprimir</button>
                </a>
    
            </td>
        </tr>
    </tfoot>
</table>
<?php require("layout/footer.php"); ?>