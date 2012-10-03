<?php
/**
 * Bridge design pattern (example of implementation)
 * 
 * @author Enrico Zimuel (enrico@zimuel.it) 
 * @see    http://en.wikipedia.org/wiki/Bridge_pattern
 */

interface DrawingAPI {
    public function drawCircle($x, $y, $radius);
}

class DrawingAPI1 implements DrawingAPI {
    public function drawCircle($x, $y, $radius) {
        printf ("API1 draw (%d, %d, %d)\n", $x, $y, $radius);
    }
}

class DrawingAPI2 implements DrawingAPI {
    public function drawCircle($x, $y, $radius) {
            printf ("API2 draw (%d, %d, %d)\n", $x, $y, $radius);
    }
}

abstract class Shape {
    protected $api;
    protected $x;
    protected $y;
    public function __construct(DrawingAPI $api) {
        $this->api = $api;
    }
}

class CircleShape extends Shape {
    protected $radius;
    public function __construct($x, $y, $radius, DrawingAPI $api) {
        parent::__construct($api);
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }
    public function draw() {
        $this->api->drawCircle($this->x, $this->y, $this->radius);
    }
}

// Usage example

$shapes = array(
    new CircleShape(1, 3, 7,  new DrawingAPI1()),
    new CircleShape(5, 7, 11, new DrawingAPI2()),
);

foreach ($shapes as $sh) {
    $sh->draw();
}