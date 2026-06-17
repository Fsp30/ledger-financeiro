<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\ValueObjects\UUID;

$goodUuid = UUID::generate();

var_dump($goodUuid);
var_dump(UUID::isValid($goodUuid));

var_dump(UUID::isValid("not-a-uuid"));
var_dump(UUID::isValid("7544eee6-4ac1-4883-a1a6-0759de6e687z"));

?>