<?php
$app = require_once __DIR__ . '/vendor/autoload.php';
$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Herrera\Pdo\PdoServiceProvider(),
    array(
        'pdo.dsn' => 'pgsql:dbname=' . ltrim($dbopts["path"], '/') . ';host=' . $dbopts["host"] . ';port=' . $dbopts["port"],
        'pdo.username' => $dbopts["user"],
        'pdo.password' => $dbopts["pass"],
    )
);

print '<pre>';
print_r($dbopts);
print '</pre>';
print 'pgsql:dbname=' . ltrim($dbopts["path"], '/') . ';host=' . $dbopts["host"] . ';port=' . $dbopts["port"];
exit;
