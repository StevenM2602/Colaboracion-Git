<?php
require_once("bd.php");
class LineasModelo extends BD
{
    // Campos de la tabla.
    public $id;
    public $factura_id;
    public $referencia;
    public $descripcion;
    public $cantidad;
    public $precio;
    public $iva;
    public $importe;



    public $filas = null;

    public function Insertar()
    {
        $sql = "INSERT INTO lineas_factura VALUES" .
            " (default, '$this->factura_id', '$this->referencia', '$this->descripcion',
            '$this->cantidad', '$this->precio', '$this->iva', '$this->importe')";
        return $this->_ejecutar($sql);
    }
    public function Modificar()
    {
        $sql = "UPDATE lineas_factura SET" .
            " factura_id='$this->factura_id', referencia='$this->referencia'" .
            " descripcion='$this->descripcion', cantidad='$this->cantidad'" .
            " precio='$this->precio', iva='$this->iva', importe='$this->importe'" .
            " WHERE id=$this->id";
        return $this->_ejecutar($sql);
    }
    public function Borrar()
    {
        $sql = "DELETE FROM lineas_factura WHERE id=$this->id";
        return $this->_ejecutar($sql);
    }
    public function Seleccionar()
    {
        // select para un solo cliente
       $sql = "SELECT * FROM lineas_factura";


        // Si se ha pasado un id de línea de factura, filtramos por él
        if ($this->id != 0) 
            $sql .= " WHERE id = $this->id";
        elseif (!empty($this->factura_id))
            $sql .= " WHERE factura_id=$this->factura_id";
        

        $this->filas = $this->_consultar($sql);
        if ($this->filas == null)
            return false;

        if ($this->id != 0) {
            // Guardamos los campos en las propiedades.
            $this->factura_id = $this->filas[0]->factura_id;
            $this->referencia = $this->filas[0]->referencia;
            $this->descripcion = $this->filas[0]->descripcion;
            $this->cantidad = $this->filas[0]->cantidad;
            $this->precio = $this->filas[0]->precio;
            $this->iva = $this->filas[0]->iva;
        }

        return true;
    }
}
