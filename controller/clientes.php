<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("model/clientes.php");
require_once("controller/crypt.php");
require_once("pdfs/clientes.php");
class ClientesControlador
{
    static function index()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();

        require_once("view/clientes.php");
    }
    static function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un cliente.
        require_once("view/clientesmantenimiento.php");
    }
    static function Insertar()
    {
        $cliente = new ClientesModelo();
        $cliente->nombre = $_POST['nombre'];
        $cliente->apellidos = $_POST['apellidos'];
        $cliente->fechanacimiento = $_POST['fechanacimiento'];
        $cliente->email = $_POST['email'];
        $cliente->contrasenya = Crypt::Encriptar($_POST['contrasenya']);
        $cliente->direccion = $_POST['direccion'];
        $cliente->cp = $_POST['cp'];
        $cliente->poblacion = $_POST['poblacion'];
        $cliente->provincia = $_POST['provincia'];
        if ($cliente->Insertar() == 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Editar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente.
        if ($cliente->seleccionar())
            require_once("view/clientesmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Modificar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        $cliente->nombre = $_POST['nombre'];
        $cliente->apellidos = $_POST['apellidos'];
        $cliente->fechanacimiento = $_POST['fechanacimiento'];
        $cliente->email = $_POST['email'];
        $cliente->contrasenya = $_POST['contrasenya'];
        $cliente->direccion = $_POST['direccion'];
        $cliente->cp = $_POST['cp'];
        $cliente->poblacion = $_POST['poblacion'];
        $cliente->provincia = $_POST['provincia'];

 
        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($cliente->Modificar() == 1) || ($cliente->GetError() == ''))
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

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

   
    static function Borrar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        if ($cliente->Borrar() == 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
