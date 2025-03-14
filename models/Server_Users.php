<?php


namespace Models;



class Server_Users extends Server
{



   protected static $tabla = 'v_servers_users';
   protected static $columnasDB = ["id", "username",  "password", "asigned_to", "server_id","created_at","updated_at"];


}
