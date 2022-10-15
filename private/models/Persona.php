<?php
/**
 * User Persona
 */
class Persona  extends Model
{
    public $verId = "IdPersona";
	protected $allowedColumns = [
        
        'DocTipo',
        'DocNumero',
        'Nombres',
        'Apellidos',
        'Genero',
        'Telefono',
        'FechaNacimiento',
        'IdCiudad',
        'Direccion',
        'CodigoPostal',
        'Activo'
    ];

    protected $beforeInsert = [
        
    ];

    protected $beforeUpdate = [
        
    ];

    public function validate($DATA,$id='')
    {
        $this->errors = array();

        //verifica documento
        $tipo_documento = ['DNI','CE', 'OTRO'];
        if(empty($DATA['DocTipo']) || !in_array($DATA['DocTipo'], $tipo_documento))
        {
            array_push($this->errors,"El tipo de documento no es válido");
        }

        //verifica nombre
        if(empty($DATA['Nombres']) || !preg_match('/^[a-zA-Z0-9 _]+$/', $DATA['Nombres']))
        {
            array_push($this->errors, "El nombre debe ser solo letras");
        }

        //verifica apellido
        if(empty($DATA['Apellidos']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $DATA['Apellidos']))
        {
            array_push($this->errors, "El apellido permite solo letras");
        }

        $generos = ['MASCULINO','FEMENINO'];
        if(empty($DATA['Genero']) || !in_array($DATA['Genero'], $generos))
        {
            array_push($this->errors, "El genero no es válido");
        }
        
        if(count($this->errors) == 0)
        {
            return true;
        }
        return false;
    }
}