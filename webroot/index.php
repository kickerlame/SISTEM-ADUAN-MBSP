<?php
/**
 * Entry Point Utama
 */

use Cake\Http\Server;
use App\Application;

// 1. Load Composer Autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

// 3. Load Bootstrap
require dirname(__DIR__) . '/config/bootstrap.php';

// 4. Jalankan Application - Pastikan guna -> bukan .
$server = new Server(new Application(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config'));
$server->emit($server->run());