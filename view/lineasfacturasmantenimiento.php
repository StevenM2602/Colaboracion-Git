<?php require("layout/header.php"); ?>
<h1>LINEAS DE FACTURAS</h1>
<br />
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>
<form action="<?php echo 'index.php?c=lineas_factura&m=' .
                    ($opcion == 'EDITAR' ? 'modificar&id=' . $linea->id : 'insertar'); ?>"
    method="POST">
    <!-- seleccionar factura-->
    <?php
    // Captura el ID de la factura desde GET o POST
    $factura_id = $_GET['factura_id'] ?? $_POST['factura_id'] ?? '';
    ?>

    <label for="factura_id" class="form-label">Factura N°</label>
    <input type="text"
        class="form-control"
        name="factura_id"
        id="factura_id"
        value="<?php echo ($opcion == 'EDITAR' ? $linea->factura_id : $factura_id); ?>"
        required
        readonly />
    <br />



    <!-- seleccionar articulo-->
    <label for="referencia" class="form-label">Referencia</label>
    <select class="form-select" name="referencia" id="referencia" required>
        <option value="" disable selected>Seleccionar el articulo</option>

        <?php foreach ($articulos->filas as $articulo) : ?>
            <option value="<?php echo $articulo->referencia; ?>"
                <?php if ($opcion == 'EDITAR') echo ($linea->referencia == $articulo->referencia ? 'selected' : ''); ?>>
                <?php echo $articulo->referencia; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br />

    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text"
        class="form-control"
        name="descripcion"
        id="descripcion"
        value="<?php echo ($opcion == 'EDITAR' ? $linea->descripcion : ''); ?>"
        required />
    <br />
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="text"
        class="form-control"
        name="cantidad"
        id="cantidad"
        value="<?php echo ($opcion == 'EDITAR' ? $linea->cantidad : ''); ?>"
        required />
    <br />
    <label for="precio" class="form-label">Precio</label>
    <input type="text"
        class="form-control"
        name="precio"
        id="precio"
        value="<?php echo ($opcion == 'EDITAR' ? $linea->precio : ''); ?>"
        required />
    <br />
    <label for="iva" class="form-label">Iva</label>
    <input type="text"
        class="form-control"
        name="iva"
        id="iva"
        value="<?php echo ($opcion == 'EDITAR' ? $linea->iva : ''); ?>"
        required />
    <br />


    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=lineas_factura'; ?>">
        <button type="button"
            class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>
<?php require("layout/footer.php"); ?>