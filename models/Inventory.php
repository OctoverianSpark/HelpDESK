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
        "state",
        "area",
        "user_id"
    ];



    public ?int $id;
    public $user_id;
    public ?string $nombre;
    public ?string $tipo_documento;
    public ?string $documento;
    public ?string $telefono;
    public ?string $correo;
    public ?string $tipo;
    public ?string $marca;
    public ?string $modelo;
    public ?string $color;
    public ?string $nombre_equipo;
    public ?string $serial;
    public ?string $area;
    public ?string $correo_dominio;
    public ?string $usuarioPC;
    public ?string $propietario;
    public ?string $state;



    public function __construct($args = [])
    {
        parent::__construct($args);

        $this->user_id = $args['user_id'] ?? null;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id === '' ? null : (int)$this->user_id;
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


        $query = "UPDATE " . static::$tabla . " SET state = 0, user_id = NULL WHERE id=$this->id";

        static::$db->query($query);
    }


    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $col) {

            if ($this->$col == null || in_array($col, ["nombre", "apellido", "area", "tipo_documento", "documento", "telefono", "correo"])) continue;

            $atributos[$col] = $this->$col;
        }
        return $atributos;
    }

    public static function all($limit = null, $offset = null, $state = null)
    {
        $query = "SELECT i.*, CONCAT(p.first_name, ' ' , p.last_name) as nombre, p.id_type as tipo_documento, p.nat_id as documento, p.phone_number as telefono, p.email as correo,p.area as area
        FROM inv i
        LEFT JOIN personal p ON i.user_id = p.id";
        if (!is_null($state)) {
            $query .= " WHERE i.state = $state";
        }

        $query .= " ORDER BY i.id DESC";

        if ($limit) {
            $query .= " LIMIT $limit";
        }

        if ($offset) {
            $query .= " OFFSET $offset";
        }



        $result = self::consultarSQL($query);


        return $result;
    }

    public static function count($state = 1)
    {

        $query = "SELECT count(*) as total FROM ti.inv WHERE state = $state";

        $resultado = self::$db->query($query);
        $row = $resultado->fetch_assoc();
        return (int)$row['total'];
    }


    public static function find($id)
    {

        $query = "SELECT i.*, CONCAT(p.first_name, ' ' , p.last_name) as nombre, p.id_type as tipo_documento, p.nat_id as documento, p.phone_number as telefono, p.email as correo
        FROM inv i
        LEFT JOIN personal p ON i.user_id = p.id
        WHERE i.id = $id";


        $resultado = self::consultarSQL($query);

        $resultado = array_shift($resultado);

        return $resultado;
    }
    public static function filter($columna, $operador, $valor, $state = 1,$limit = null,$offset = null)
    {
        // Mapeo de alias válidos a expresiones SQL reales
        $map = [
            'nombre' => "CONCAT(p.first_name, ' ', p.last_name)",
            'tipo_documento' => 'p.id_type',
            'documento' => 'p.nat_id',
            'telefono' => 'p.phone_number',
            'correo' => 'p.email',
            'id' => 'i.id',
            'state' => 'i.state',
            // puedes añadir más columnas reales aquí
        ];

        // Si la columna no está en el mapa, usamos la que venga (validar que exista en DB si quieres más seguridad)
        $col = $map[$columna] ?? $columna;

        // Asegurar el operador permitido
        $allowedOps = ['=', '!=', 'LIKE', '>', '<', '>=', '<='];
        if (!in_array(strtoupper($operador), $allowedOps)) {
            $operador = 'LIKE';
        }

        // Escapar valor (si es LIKE, envolver en %)
        $valor = addslashes($valor);
        if (strtoupper($operador) === 'LIKE' && strpos($valor, '%') === false) {
            $valor = "%$valor%";
        }
        $valor = "'$valor'";

        $query = "
        SELECT 
            i.*, 
            CONCAT(p.first_name , ' ' , p.last_name) AS nombre, 
            p.id_type AS tipo_documento, 
            p.nat_id AS documento, 
            p.phone_number AS telefono, 
            p.email AS correo
        FROM ti.inv i
        LEFT JOIN personal p ON i.user_id = p.id
        WHERE $col $operador $valor 
          AND i.state = $state
        ORDER BY i.id DESC
    ";

    if($limit){
        $query .=  " LIMIT $limit";
    }

    if($offset){
        $query .= " OFFSET $offset";
    }


        return self::consultarSQL($query);
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
                $info = Personal::find($data->user_id);

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


    public function actualizar()
    {

        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "$key='$value'";
        }


        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(",", $valores);
        $query .= " WHERE id = " . $this->id . "";
        $query .= " LIMIT 1";

        $query = strtolower($query);
        $resultado = self::$db->query($query);
        return $resultado;
    }
}
