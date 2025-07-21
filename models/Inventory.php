<?php

namespace Models;

class Inventory extends ActiveRecord
{

    protected static $schema = "ti";

    protected static $tabla = "inv";

    protected static $columnasDB =
    [
        "id",
        "user_id",
        "nombre",
        "apellido",
        "tipo_documento",
        "documento",
        "telefono",
        "correo",
        "tipo",
        "marca",
        "modelo",
        "color",
        "nombre_equipo",
        "serial",
        "correo_dominio",
        "usuarioPC",
        "propietario",
        "state"
    ];



    protected ?int $id;
    protected ?int $user_id;
    protected ?string $nombre;
    protected ?string $apellido;
    protected ?string $tipo_documento;
    protected ?string $documento;
    protected ?string $telefono;
    protected ?string $correo;
    protected ?string $tipo;
    protected ?string $marca;
    protected ?string $modelo;
    protected ?string $color;
    protected ?string $nombre_equipo;
    protected ?string $serial;
    protected ?string $correo_dominio;
    protected ?string $usuarioPC;
    protected ?string $propietario;
    protected ?int $state;



    public function __construct($args = [])
    {
        parent::__construct($args);

        $this->user_id = $args['user_id'] ?? 0;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    public function getTipoDocumento(): string
    {
        return $this->tipo_documento;
    }

    public function setTipoDocumento(string $tipo_documento): void
    {
        $this->tipo_documento = $tipo_documento;
    }

    public function getDocumento(): string
    {
        return $this->documento;
    }

    public function setDocumento(string $documento): void
    {
        $this->documento = $documento;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): void
    {
        $this->modelo = $modelo;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getNombreEquipo(): string
    {
        return $this->nombre_equipo;
    }

    public function setNombreEquipo(string $nombre_equipo): void
    {
        $this->nombre_equipo = $nombre_equipo;
    }

    public function getSerial(): string
    {
        return $this->serial;
    }

    public function setSerial(string $serial): void
    {
        $this->serial = $serial;
    }

    public function getCorreoDominio(): string
    {
        return $this->correo_dominio;
    }

    public function setCorreoDominio(string $correo_dominio): void
    {
        $this->correo_dominio = $correo_dominio;
    }

    public function getUsuarioPC(): string
    {
        return $this->usuarioPC;
    }

    public function setUsuarioPC(string $usuarioPC): void
    {
        $this->usuarioPC = $usuarioPC;
    }

    public function getPropietario(): string
    {
        return $this->propietario;
    }

    public function setPropietario(string $propietario): void
    {
        $this->propietario = $propietario;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function setState(int $state): void
    {
        $this->state = $state;
    }

    public function setStock()
    {


        $query = "UPDATE " . static::$tabla . " SET state = 0 WHERE id=$this->id";

        static::$db->query($query);
    }


    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $col) {

            if ($this->$col == null || in_array($col, ["nombre", "apellido", "tipo_documento", "documento", "telefono", "correo",])) continue;

            $atributos[$col] = $this->$col;
        }
        return $atributos;
    }

    public static function all()
    {
        $query = "SELECT i.*, p.first_name as nombre, p.last_name as apellido, p.id_type as tipo_documento, p.nat_id as documento, p.phone_number as telefono, p.email as correo
        FROM inv i
        LEFT JOIN rh.personal p ON i.user_id = p.id
        ORDER BY i.id DESC";
        $result = self::consultarSQL($query);


        return $result;
    }


    public static function find($id)
    {

        $query = "SELECT i.*, p.first_name as nombre, p.last_name as apellido, p.id_type as tipo_documento, p.nat_id as documento, p.phone_number as telefono, p.email as correo
        FROM inv i
        LEFT JOIN rh.personal p ON i.user_id = p.id
        WHERE i.id = $id";


        $resultado = self::consultarSQL($query);

        $resultado = array_shift($resultado);

        return $resultado;
    }

    public static function filter($columna, $operador, $valor)
    {

        $query = "SELECT i.*, p.first_name as nombre, p.last_name as apellido, p.id_type as tipo_documento, p.nat_id as documento, p.phone_number as telefono, p.email as correo
        FROM inv i
        LEFT JOIN rh.personal p ON i.user_id = p.id
        WHERE i.$columna $operador $valor
        ORDER BY i.id DESC";
        $result = self::consultarSQL($query);


        return $result;
    }

    public static function filter_by_location($columna, $operador, $valor, $location)
    {
        $query = "SELECT * FROM ti.inv as i WHERE $columna $operador '$valor' and sede = '$location' order by id DESC";

        $result = self::consultarSQL($query);

        $result = self::findUser($result);

        return $result;
    }



    protected static function findUser($object = [])
    {

        foreach ($object as $data) {

            if ($data->user_id === "0") {
                $data->nombre = strtoupper("STOCK");
                $data->correo = strtoupper("Sin asignar");
                $data->telefono = strtoupper("Sin asignar");
                $data->tipo_documento = strtoupper("Sin asignar");
                $data->documento = strtoupper("Sin asignar");
            } else {
                debuguear($data);
                $info = Personal::PIVOTFINDER($data->user_id);

                $data->nombre = $info->nombre;
                $data->apellido = $info->apellido;
                $data->correo = $info->correo;
                $data->telefono = $info->telefono;
                $data->tipo_documento = $info->tipo_documento;
                $data->documento = $info->documento;
            }
        }
        return $object;
    }


    public function toArray()
    {
        $array = [];
        foreach (static::$columnasDB as $col) {
            if ($this->$col !== null) {
                $array[$col] = $this->$col;
            }
        }
        return $array;
    }
}
