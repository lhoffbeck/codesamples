package simple_java_polymorphism;

import java.util.ArrayList;
import java.util.List;


public class Main {

    public static void main(String[] args) {
        
        // instantiate square fields
        double width = 2.0;
        ShapeColor sqShapeColor = ShapeColor.Blue;
        
        Shape square = new Square(sqShapeColor, width);

        // set up rectangle fields
        double reWidth = 2.0;
        double reHeight = 3.0;
        ShapeColor reShapeColor = ShapeColor.Red;
        Shape rect = new Rectangle(reShapeColor, reWidth, reHeight);
        
                
        List<Shape> shapes = new ArrayList<Shape>();
        shapes.add(square);
        shapes.add(rect);
        
        for(Shape shape: shapes){
            
            shape.PrettyPrint();
            
            // separated area value out from PrettyPrint to demonstrate
            // that the correct method is still called by calling the
            // method on the base class.
            System.out.format("My area is %.2f",shape.getArea());
            
            System.out.println("\r\n--------------------");
        }
    }
}

enum ShapeColor{
    Red,
    Blue,
    Green,
    Yellow
}
