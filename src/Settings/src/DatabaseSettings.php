<?php

namespace Settings;

use Laminas\Db\Adapter\Adapter;

$adapter = new Adapter();

$adapter-> query(
  'SELECT * FROM `testing.test`'
);
