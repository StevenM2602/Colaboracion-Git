<?php require("layout/header.php"); ?>
<h1>FACTURAS</h1>
<br />
<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Cliente</th>
            <th>Número</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($factura->filas) :
            foreach ($factura->filas as $fila) :
        ?>
                <tr>
                    <td style="text-align: center; width: 5%;"><?php echo $fila->id; ?></td>
                    <td style="text-align: center;"><?php echo $fila->nombre; ?></td>
                    <td style="text-align: center;"><?php echo $fila->numero; ?></td>
                    <td style="text-align: center;"><?php echo $fila->fecha; ?></td>
                    
                    <td style="text-align: right; width: 50%;">
                        <a href="index.php?c=facturas&m=editar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-success">Editar</button></a>
                        <a href="index.php?c=facturas&m=borrar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-danger borrar"
                                onclick="return confirm('¿Estás seguro de borrar la factura <?php
                                echo $fila->id; ?>?');">Borrar</button></a>
                                <a href="index.php?c=lineas_factura&factura_id=<?php echo $fila->id; ?>">
                                <button type="button" class="btn btn-primary">Líneas de factura</button>
</a>

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
                <a href="index.php?c=facturas&m=nuevo">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                </a>
                <a href="index.php?c=facturas&m=exportar">
                    <button type="button" class="btn btn-success">Exportar</button>
                </a>
            </td>
        </tr>
    </tfoot>
</table>
<?php require("layout/footer.php"); ?>