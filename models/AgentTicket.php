<?php





namespace Models;



class AgentTicket extends ActiveRecord
{

  protected static $columnasDB = ["id", "fecha", "agent_id", "subcategoria", "descripcion", "estado", "tecnico_id", "prioridad", "fecha_asignada", "fecha_pendiente", "fecha_completacion", "solucion"];



  protected static $tabla = "agent_tickets";

  public ?int $id;
  public string $fecha;
  public string $agent_id;
  public string $categoria;
  public string $subcategoria;
  public string $descripcion;
  public string $imagen;
  public string $estado;
  public int $tecnico_id;
  public string $tecnico;
  public string $prioridad;
  public ?string $fecha_asignada;
  public ?string $fecha_pendiente;
  public ?string $fecha_completacion;
  public string $solucion;

  public string $sa_ep; //Suma de sin asignar a pendiente
  public string $ep_c; //Suma de en proceso a completado
  public string $p_c; //Suma de pendiente a completado
  public string $ep_p; //Suma de en proceso a pendiente
  public $name;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->fecha = $args['fecha'] ?? date('Y-m-d H:i:s');
    $this->name = $args['name'];
    $this->agent_id = $args['agent_id'] ?? '';
    $this->subcategoria = $args['subcategoria'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->imagen = $args['imagen'] ?? '';
    $this->estado = $args['estado'] ?? 'Pendiente';
    $this->tecnico_id = $args['tecnico_id'] ?? 0;
    $this->tecnico = $args['tecnico'] ?? 'sin asignar';
    $this->prioridad = $args['prioridad'] ?? 'Baja';
    $this->fecha_asignada = $args['fecha_asignada'] ?? null;
    $this->fecha_pendiente = $args['fecha_pendiente'] ?? null;
    $this->fecha_completacion = $args['fecha_completacion'] ?? null;
    $this->tecnico = $args['tecnico'] ?? '';
    $this->solucion = $args['solucion'] ?? '';
    $this->sa_ep = $args['sa_ep'] ?? 0;
    $this->ep_c = $args['ep_c'] ?? 0;
    $this->p_c = $args['p_c'] ?? 0;
    $this->ep_p = $args['ep_p'] ?? 0;
  }






  public static function all($limit = null, $offset = null)
  {
    $query = "SELECT at.*,a.name,CONCAT(t.first_name,' ', t.last_name) as tecnico, ABS(TIMESTAMPDIFF(MINUTE, fecha_asignada, fecha)) AS sa_ep,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_completacion, fecha_asignada)) AS ep_c,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_completacion, fecha_pendiente)) AS p_c,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_pendiente, fecha_asignada)) AS ep_p FROM " . static::$tabla . " at INNER JOIN agents a ON at.agent_id = a.id LEFT JOIN users t ON at.tecnico_id = t.id ORDER BY id DESC;";

    if ($limit !== null) {
      $query .= " LIMIT " . (int)$limit;
    }

    if ($offset !== null) {
      $query .= " OFFSET " . (int)$offset;
    }



    return self::consultarSQL($query);
  }



  public function crear()
  {

    //Sanitizar
    $atributos = $this->sanitizarAtributos();
    $finalAttrib = [];

    foreach ($atributos as $key => $value):
      if ($atributos[$key] === null || $atributos[$key] === "") continue;
      if ($key === "tecnico") continue;
      $finalAttrib[$key] = $value;


    endforeach;

    //Insercion
    $query = "INSERT INTO " . static::$tabla . " (";
    $query .= join(", ", array_keys($finalAttrib));
    $query .= ")VALUES ('";
    $query .= join("' , '", array_values($finalAttrib));
    $query .= "')";


    $resultado = self::$db->query($query);

    return $resultado;
  }
}
