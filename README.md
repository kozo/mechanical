# mechanical

## requirements

- CakePHP3.8 or higher

## Installation

```
composer require mechanical:"~3.0"
```

## create quartz file.
```
php bin/cakephp mechanical create
```

## edit mechanical file.

app/Quartz/MechanicalCron.php
```
// sample
<?php

namespace App\Mechanical;

use Watchmaker\Watchmaker;

class MechanicalCron {

    public function handle(Watchmaker $watchmaker): Watchmaker
    {
        $i = $watchmaker->task('php hoge/fuga.php');
        $i = $i
            ->month(1)
            ->day(5);
        $watchmaker->add($i);

        $j = $watchmaker->task('php hoge/hoge.php');
        $j = $j
            ->month(2)
            ->day(6);
        $watchmaker->add($j);

        return $watchmaker;
    }
}
```

## run command

### show
show the difference between "crontab" and "Quartz".

```
php bin/cakephp mechanical show
```

### install
Install the difference between "crontab" and "Quartz".

```
php bin/cakephp mechanical install
```
