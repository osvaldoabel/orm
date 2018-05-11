<?php 

namespace OAB\ORM;

use OAB\ORM\Drivers\DriverStrategy;

 abstract class Model
 {
     protected $driver;

     public function setDriver(DriverStrategy $driver)
     {
        $this->driver = $driver;
        $this->driver->setTable($this->table);
        return $this;
     }

     protected function getDriver()
     {
         return $this->driver;
     }

     public function save()
     {
         $this->getDriver()
              ->save($this)
              ->exec();
     }

     public function findAll(array $condictions = []) 
     {
        return $this->getDriver()
             ->select($condictions)
             ->exec()
             ->all();
     }

     public function findFirst($id) 
     {
        $condictions = ['id' => $id];

        return $this->getDriver()
             ->select($condictions)
             ->exec()
             ->first();
     }

     public function delete() 
     {
        $condictions = ['id' => $this->id];

        return $this->getDriver()
             ->delete($condictions)
             ->exec();
     }

     private function discoverTableName()
     {
        if (!$this->table) {
            $classWithNamespace = get_class($this);
            $table       = array_pop(explode('\\', $classWithNamespace));
            $this->table = strtolower($table);
        }

        return $this->table;
     }

     public function __get($variable)
     {
        if ($variable === 'table') {

            $classWithNamespace = get_class($this);

            $table = array_pop(explode('\\', $classWithNamespace));

            return strtolower($table);
        }

        return null;
     }
 }