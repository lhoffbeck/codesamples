package simple_java_polymorphism;

public class Square extends Shape {
    
    private double width;
    
    public Square(ShapeColor color, double width){
        super(color);
        this.width = width;
    }
    
    public double getArea(){
        return width*width;
    }
    
    public void PrettyPrint(){
        super.PrettyPrint(this.getClass().getSimpleName());
    }
}
