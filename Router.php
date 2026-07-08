<?php


namespace MVC;

use Models\ActiveDirectory;
use Models\Users;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION["login"] ?? null;
        $admin = $_SESSION["role"] === "ADMIN" ?? null;
    
        $rutas_protegidas = ["/", "/tickets/crear", "/ticket", "tickets/ver", "/equipos"];
        $rutas_admin = ["/admin", "/admin/inventario", "/admin/inventario/crear", "/admin/inventario/actualizar", "/admin/inventario/eliminar", "/admin/tickets", "/admin/tickets/ver", "/admin/encuestas", "/admin/encuestas/ver", "/admin/entradas", "/admin/entradas/ver", "/admin/entradas/crear"];
        $rutas_api = ["/api/tickets", "/api/tickets/create"]; // ← slash corregido
    
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];
    
        $esRutaApi = in_array($urlActual, $rutas_api);
    
        // ← primero verifica si es API, si lo es no redirige nunca
        if (!$esRutaApi) {
            if (!$auth && !str_contains($urlActual, "/login") && !str_contains($urlActual, "/redirect")) {
                header("Location: /login");
                exit; // ← importante para que no siga ejecutando
            }
    
            if (in_array($urlActual, $rutas_protegidas) && !$auth) {
                header("Location: /login");
                exit;
            }
    
            if (in_array($urlActual, $rutas_admin) && !$admin) {
                header("Location: /login");
                exit;
            }
        }
    
        if ($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
    
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Pagina no Encontrada";
        }
    }




    public function render($view, $datos = [])
    {



        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }

    public function validateApi()
    {

        $type = $_GET['auth_type'] ?? $_POST['auth_type'];
        $user = $_GET['user'] ?? $_POST['user'];

        $data = Users::filter($type, '=', $user);


        return array_shift($data);
    }
}
