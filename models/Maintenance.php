<?php


namespace Models;


class Maintenance extends ActiveRecord
{


  protected static $columnasDB = ['id', 'latest', 'next', 'tech', 'computer'];

  protected static $tabla = 'maintenance';
}
