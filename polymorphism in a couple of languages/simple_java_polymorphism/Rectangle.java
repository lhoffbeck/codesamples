package simple_java_polymorphism;

public class Rectangle extends Shape{
   
    private double width;    
    private double height;

    
    public Rectangle(ShapeColor color, double width, double height){
        super(color);
        this.height = height;
        this.width = width;
    }
     
    public double getArea(){
        return height*width;
    }
    
    public void PrettyPrint(){
        super.PrettyPrint(this.getClass().getSimpleName());
    }
}
