<?php

class Rectangle {
    
    // two double data fields
    public float $width;
    public float $height;

    // constructor
    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height; 
    } 

    // method getArea()
    public function getArea(): float {
        return $this->width * $this->height;
    }

    // method getPerimeter()
    public function getPerimeter(): float {
        return 2 * ($this->width + $this->height);
    }
}

$showCalculatedValue = new Rectangle(1.0, 1.0);
echo "The Area of the Rectangle is: " . $showCalculatedValue->getArea() . "<br>";
echo "The Perimeter of the Rectangle is: " . $showCalculatedValue->getPerimeter() . "<br>";

?>



<!-- 

Design a class named Rectangle to represent a rectangle. The class contains: Two double data fields named width and height that specify the width and height of the rectangle. The default values are 1 for both width and height. A constructor that creates a rectangle with the specified width and height. Write a method named getArea() that returns the area of this rectangle and a method named getPerimeter() that returns the perimeter.

-->