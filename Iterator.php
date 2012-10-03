<?php
/**
 * Iterator design pattern (Fibonacci numbers)
 * 
 * @author Enrico Zimuel (enrico@zimuel.it) 
 * @see    http://www.php.net/manual/en/class.iterator.php
 * @see    http://en.wikipedia.org/wiki/Fibonacci_number
 */

class Fibonacci implements Iterator {
    protected $value = 0;
    protected $sum = 0;
    protected $key = 0;
    public function rewind() {
        $this->value = 0;
        $this->key   = 0;
    }
    public function current() {
        return $this->value;
    }
    public function key() {
        return $this->key;
    }
    public function next() {
        if ($this->value === 0) {
            $this->value = 1;
        } else {
            $old = $this->value;
            $this->value += $this->sum;
            $this->sum = $old;
        }
        $this->key++;
    }
    public function valid() {
        return ($this->value < PHP_INT_MAX);
    }
}

// print the Fibonacci numbers until PHP_INT_MAX
foreach ($test = new Fibonacci() as $key => $value) {
    printf("%d) %d\n", $key, $value);
}

// print the first 10 Fibonacci's numbers
$num = new Fibonacci();
for ($i = 0; $i < 10; $i++) {
    printf("%d) %d\n", $i, $num->current());
    $num->next();
}
