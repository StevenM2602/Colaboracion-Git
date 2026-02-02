<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("model/lineas_factura.php");
require_once("model/facturas.php");

class LineasControlador
{
    static function index()
    {
        $lineas = new LineasModelo();
       $lineas->factura_id=$_GET['factura_id'];
        $lineas->Seleccionar();
        $factura = new FacturasModelo();
       $factura->id=$_GET['factura_id'];
        $factura->Seleccionar();

        require_once("view/lineas_factura.php");
    }
    static function Nuevo()
    {
        $articulos = new ArticulosModelo();

        $articulos->Seleccionar();

        $facturas = new FacturasModelo();

        $facturas->Seleccionar();
        
        $opcion = 'NUEVO'; // Opción de insertar una factura.
        require_once("view/lineasfacturasmantenimiento.php");
    }
    static function Insertar()
    {
        $linea = new LineasModelo();
        $linea->factura_id = $_POST['factura_id'];
        $linea->referencia = $_POST['referencia'];
        $linea->descripcion = $_POST['descripcion'];
        $linea->cantidad = $_POST['cantidad'];
        $linea->precio = $_POST['precio'];
        $linea->iva = $_POST['iva'];

        if ($linea->Insertar() == 1)
            header("location:" . URLSITE . '?c=lineas_factura');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Editar()
    {
        $linea = new LineasModelo();
        $linea->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar una factura.
        if ($linea->seleccionar())
            require_once("view/facturasmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Modificar()
    {
        $linea = new LineasModelo();
        $linea->id = $_GET['id'];
        $linea->factura_id = $_POST['factura_id'];
        $linea->referencia = $_POST['referencia'];
        $linea->descripcion = $_POST['descripcion'];
        $linea->cantidad = $_POST['cantidad'];
        $linea->precio = $_POST['precio'];
        $linea->iva = $_POST['iva'];
        
        
        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($linea->Modificar() == 1) || ($linea->GetError() == ''))
            header("location:" . URLSITE . '?c=lineas_factura');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Borrar()
    {
        $linea = new LineasModelo();
        $linea->id = $_GET['id'];
        if ($linea->Borrar() == 1)
            header("location:" . URLSITE . '?c=lineas_factura');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}