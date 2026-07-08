<?php

namespace Models;

class Perifericos extends ActiveRecord
{
    protected static $columnasDB = ["id", "tipo", "marca", "modelo", "color", "serial", "user_id", "state", "asign_date", "mod_date"];

    protected static $tabla = "perifericos";

    public $user_id    = null;
    public $asign_date = null;
    public $mod_date;
    public $name       = "";


    public function __construct($args = [])
    {
        parent::__construct($args);

        $this->mod_date   = date("Y-m-d H:i:s");
        $this->user_id    = $args["user_id"] ?? null;

        // FIX — was re-accessing $args['user_id'] directly (no null-safe operator),
        //        causing "Undefined array key user_id" when the key is absent.
        //        Use $this->user_id which is already safely resolved above.
        $this->asign_date = !is_null($this->user_id) ? date("Y-m-d H:i:s") : null;
    }


    // -------------------------------------------------------------------------

    public static function findGroup($id)
    {
        // FIX — escape $id to prevent SQL injection.
        $safeId = self::$db->escape_string($id);
        $query  = "SELECT * FROM " . static::$tabla . " WHERE user_id = '$safeId'";

        return self::consultarSQL($query);
    }

    public static function all($limit = null, $offset = null, $state = null)
    {
        $query  = "SELECT p.*, COALESCE(CONCAT(personal.first_name, ' ', personal.last_name), 'sin asignar') AS name ";
        $query .= "FROM perifericos p LEFT JOIN personal ON p.user_id = personal.id";

        if ($state !== null) {
            $query .= " WHERE p.state = " . (int) $state;
        }

        $query .= " ORDER BY p.id DESC";

        if ($limit !== null) {
            $query .= " LIMIT " . (int) $limit;
        }
        if ($offset !== null) {
            $query .= " OFFSET " . (int) $offset;
        }

        return self::consultarSQL($query);
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {

            if ($key === "mod_date") continue;

            if (is_null($value) || $value === "") {
                $valores[] = "$key = NULL";
            } else {
                // FIX — escape each value to prevent SQL injection in UPDATE.
                $valores[] = "$key = '" . self::$db->escape_string($value) . "'";
            }
        }

        $query  = "UPDATE " . static::$tabla . " SET ";
        $query .= implode(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";

        return self::$db->query($query);
    }

    public function getAsignedName(): string
    {
        if ($this->user_id) {
            $user = Personal::find($this->user_id);
            return $user->first_name . " " . $user->last_name;
        }

        return "Sin Asignar";
    }

    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        self::$db->query($query);
    }

    public function toArray(): array
    {
        $array = [];

        foreach (static::$columnasDB as $col) {
            if (isset($this->$col)) {
                $array[$col] = $this->$col;
            }
        }

        // Assigned outside the loop — was being re-set on every iteration before.
        $array["name"] = $this->getAsignedName();

        return $array;
    }
}