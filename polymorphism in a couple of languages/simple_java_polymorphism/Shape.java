package simple_java_polymorphism;


public abstract class Shape {
    
    private ShapeColor color;
    private double area;
    
    
    public Shape(ShapeColor color){
        this.color = color;
    }
    
    public ShapeColor getColor(){
        return color;
    }
    public void setColor(ShapeColor color){
        this.color = color;
    }
    
    public abstract double getArea();
    public abstract void PrettyPrint(); // enforce subclasses create p.p. method with no args
    
    // Shape's implementation of P.P. method. Takes in the calling classes name.
    void PrettyPrint(String className) {
        System.out.format("I am a: %s\r\n", className);
        System.out.format("My color is: %s\r\n", color.toString());
    }
}
