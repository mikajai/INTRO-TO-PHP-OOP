<?php

class QuadraticEquation {

    // private data fields to represent three coefficients
    private $a;
    private $b;
    private $c;

    
    // constructor
    public function __construct($a, $b, $c) {
        if ($a == 0) {
            echo "Coefficient 'a' must not be zero. Otherwise, the equation becomes linear instead of quadratic.";
            exit();
        }
        $this->a = $a;
        $this->b = $b;
        $this->c = $c; 
    } 

    // method for getting a value
    public function getA() {
        return $this->a;
    }

    // method for getting b value
    public function getB() {
        return $this->b;
    }

    // method for getting c value
    public function getC() {
        return $this->c;
    }

    // method for getting the discriminant value
    public function getDiscriminant() {
        return ($this->b **2) - (4 * $this->a * $this->c);
    }

    // method for getting the root 1
    public function getRoot1() {
        $d = $this->getDiscriminant();
        if ($d < 0) {
            return null;
        }
        return (-$this->b + sqrt($d)) / (2 * $this->a);
    }

     // method for getting the root 2
    public function getRoot2() {
        $d = $this->getDiscriminant();
        if ($d < 0) {
            return null;
        }
        return (-$this->b - sqrt($d)) / (2 * $this->a);
    }

    // method to describe the nature of the root based on the discriminant values
    public function description() {
        $d = $this->getDiscriminant();
        if ($d > 0) {
            return "Two distinct real roots: " . $this->getRoot1() . " and " . $this->getRoot2() . ".";
        } else if ($d == 0) {
            return "One real root: " . $this->getRoot1() . ".";
        } else {
        return "No real roots.";
    }
}


}

$equation = new QuadraticEquation(1, 2, 1);
echo "Quadratic Equation : ax^2 + bx + c = 0" . "<br><br>";
echo "This is the value of a = " . $equation->getA() . "<br>" . "This is the value of b = " . $equation->getB() . "<br>" . "This is the value of c = " . $equation->getC() . "<br><br>";

echo "Discriminant: " . $equation->getDiscriminant() . "<br>";
echo "Root 1: " . $equation->getRoot1() . "<br>";
echo "Root 2: " . $equation->getRoot2() . "<br>";
echo "Root Type: " . $equation->description() . "<br>";

?>