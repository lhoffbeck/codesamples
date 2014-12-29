public class Runner{
    
    public static void main(String[] args) {
    
        // set up square vars
        def sqHeight = 2.0
        def sqColor = ShapeColor.Red
        // -------------------
        Shape s = new Square(sqColor, sqHeight)
        
        // set up rectangle vars
        def rectHeight = 2.0
        def rectWidth = 3.0
        def rectColor = ShapeColor.Green
        // ---------------------
        Shape r = new Rectangle( rectColor, rectWidth, rectHeight)
        
        def shapes = [s, r]
        
        // polymorphically call getArea on all the things
        shapes.each{ shape ->
            println """class is: ${shape.getClass().toString().split(' ')[1]}
area is: ${shape.getArea()}
color is: ${shape.getColor()}
"""
        }

    }
}

public abstract class Shape{

    private def color

    public Shape(color){
        this.color = color
    }
    
    public def getColor(){
        return color
    }
    
    public abstract def getArea()
}

public class Square extends Shape {

    private def height

    public Square(color, height){
        super(color)
        this.height = height
    }
    
    def getArea() {
        return height*height
    }

}

public class Rectangle extends Shape{

    def width, height
    
    public Rectangle(color, width, height){
        super(color)
        this.width = width
        this.height = height
    }
    
    def getArea(){
        return width*height;
    }
}

public enum ShapeColor{
    Red,
    Blue,
    Green,
    Yellow
}
