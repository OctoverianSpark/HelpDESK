<?php


namespace Models;


class PQRS extends ActiveRecord
{

  protected static $tabla = "pqrs";

  protected static $columnasDB = [
    'id',
    'type',
    'name',
    'subject',
    'area_notification',
    'origin',
    'state',
    'tech_id'
  ];

  public $id;
  public $type;
  public $name;
  public $subject;
  public $area_notification;
  public $origin;
  public $state;
  public $tech_id;

  public function __construct($args = [])
  {
    parent::__construct($args);
  }
}
