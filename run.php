<?php 

require __DIR__. '/vendor/autoload.php';

use App\Model\User;
use OAB\ORM\Drivers\MysqlPdo;

$pdo = new PDO('mysql:host=localhost;dbname=orm', 'root', '1234');

$driver = new MysqlPdo($pdo);
$driver->setTable('users');

// $driver->exec('TRUNCATE users;');

$model = new User;
$model->setDriver($driver);

$model->name  = 'Abel';
$model->age   = 26;
$model->email = 'osvale@gmail.com';
$model->save();

$model->id = 2;
$model->name = 'osvaldo osvaldo mesmo';
$model->email = 'novoemail@gmail.com ';
$model->save();

// $model->delete(2);

var_dump($model->findall());
echo "\n";
// var_dump($model->findFirst(1));
exit;