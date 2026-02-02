<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("model/articulos.php");

class ArticulosControlador
{
    static function index()
    {
        $articulos = new ArticulosModelo();
        $articulos->Seleccionar();

        require_once("view/articulos.php");
    }
    static function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un cliente.
        require_once("view/articulosmantenimiento.php");
    }
    static function Insertar()
    {
        $articulo = new ArticulosModelo();
        $articulo->referencia = $_POST['referencia'];
        $articulo->descripcion = $_POST['descripcion'];
        $articulo->precio = $_POST['precio'];
        $articulo->iva = $_POST['iva'];

        if ($articulo->Insertar() == 1)
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Editar()
    {
        $articulo = new ArticulosModelo();
        $articulo->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente.
        if ($articulo->seleccionar())
            require_once("view/articulosmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Modificar()
    {
        $articulo = new ArticulosModelo();
        $articulo->id = $_GET['id'];
        $articulo->referencia = $_POST['referencia'];
        $articulo->descripcion = $_POST['descripcion'];
        $articulo->precio = $_POST['precio'];
        $articulo->iva = $_POST['iva'];
 
        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($articulo->Modificar() == 1) || ($articulo->GetError() == ''))
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

/*
static function Exportar(){
    //nos creamos el objeto clientes para acceder
    //a la tabla clientes BBDD
    $clientes = new ClientesModelo();

    //selecciono todos los clientes
    $clientes->Seleccionar();

    try{
        //abrimos el fichero clientes .csv en modo escritura
        $fichero = fopen("clientes.csv", "w");

        //para cada fila de la tabla...
        foreach($clientes->filas as $fila)
            {
            
        //creamos la linea a exportar y..
        $cadena = "$fila->id#$fila->nombre#$fila->apellidos\n";

        //la guardamos la linea al fichero
        fputs($fichero, $cadena);

        }
    }
    finally{
        //cerramos el fichero
        fclose($fichero);
    }

    //finalmente exportamos el fichero
    $rutaFichero = 'clientes.csv';
    $fichero = basename($rutaFichero);

    header("Content-Type: application/octet-stream");
    header("Content-Length: " . filesize($rutaFichero));
    header("Content-Disposition: attachment; filename=$fichero");

    readfile($rutaFichero);
}

    // http://localhost/mvc/?c=clientes&m=imprimir
    static function Imprimir()
    {
        // Creamos el modelo de clientes.
        $clientes = new ClientesModelo();
 
        // Seleccionamos todos los clientes.
        $clientes->Seleccionar();
 
        // Creamos el PDF de clientes.
        $pdf = new ClientesPDF();
 
        // Añadimos un página.
        $pdf->AddPage();
 
        // Indicamos el tamaño de letra.
        $pdf->SetFont('Arial','',10);
 
        // Establecemos el tamaño de cada celda.
        $pdf->SetWidths(array(20,20,21,44,40,15,15,15));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
 
        // Pasamos la filas obtenidas.
        $pdf->filas = $clientes->filas;
       
        // Imprimirmos
        $pdf->Imprimir();
       
        // Mostramos
        $pdf->Output();
    }
*/ 

    static function Borrar()
    {
        $articulo = new ArticulosModelo();
        $articulo->id = $_GET['id'];
        if ($articulo->Borrar() == 1)
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
