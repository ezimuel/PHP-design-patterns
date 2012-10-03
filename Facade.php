<?php
/**
 * Facade design pattern (example of implementation)
 * 
 * @author Enrico Zimuel (enrico@zimuel.it) 
 * @see    http://en.wikipedia.org/wiki/Facade_pattern
 */

class CPU {
    public function freeze() {
        echo "Freeze the CPU\n";
    }
    public function jump($address) {
        echo "Jump to $address\n";
    }
    public function execute() {
        echo "Execute\n";
    }
}

class Memory {
    public function load($address, $data) {
        echo "Loading address $address with data: $data\n";
    }
}

class Disk {
    public function read($sector, $size) {
        return "data from sector $sector ($size)";
    }
}

// Facade
class Computer {
    const BOOT_ADDRESS = 0;
    const BOOT_SECTOR = 1;
    const SECTOR_SIZE = 16;
    protected $cpu;
    protected $mem;
    protected $hd;
 
    public function __construct(CPU $cpu, Memory $mem, Disk $hd) {
        $this->cpu = $cpu;
        $this->mem = $mem;
        $this->hd  = $hd;
    }
 
    public function startComputer() {
        $this->cpu->freeze();
        $this->mem->load(self::BOOT_ADDRESS,
                         $this->hd->read(self::BOOT_SECTOR, self::SECTOR_SIZE));
        $this->cpu->jump(self::BOOT_ADDRESS);
        $this->cpu->execute();
    }
}

// Usage example

$pc = new Computer(new CPU, new Memory, new Disk);
$pc->startComputer();