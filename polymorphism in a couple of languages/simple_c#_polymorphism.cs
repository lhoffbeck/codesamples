using System;
using System.Collections.Generic;

public static class Program {
  
  public static void Main () {
    
    // Set up square object
    double sWidth = 2.0;
    Shape square = new Square(ShapeColor.Red, sWidth);
    // --------------------
    
    // Set up rectangle object
    double rWidth = 2.5;
    double rHeight = 3.0;
    Shape rect = new Rectangle(ShapeColor.Green, rWidth, rHeight);
    // -----------------------
    
    List<Shape> shapes = new List<Shape>();
    shapes.Add(square);
    shapes.Add(rect);
    
    // call polymorphic methods on shapes
    foreach (var shape in shapes)
    {
        shape.PrettyPrint();
        Console.WriteLine("My area is: {0:0.00}\r\n------------------\r\n", shape.GetArea());
    }
  }
}

  public enum ShapeColor
  {
    Red,
    Green,
    Blue,
    Yellow
  };

public abstract class Shape
{
  public ShapeColor color {get; set;}

    public Shape(ShapeColor color)
    {
        this.color = color;
    }
  
    public abstract double GetArea();
    public abstract void PrettyPrint(); // enforce no arg P.P. method in child classes
    
    public void PrettyPrint(string className)
    {
        Console.WriteLine("I am a {0}\r\nMy color is: {1}", className, color.ToString());
    }

}

public class Square : Shape
{
    public double Width{get; set;}
    
    public Square(ShapeColor color, double width)
      : base(color)
    {
      Width = width;
    }
  
    public override double GetArea()
    {
      return Width*Width;
    }
    
    public override void PrettyPrint()
    {
        base.PrettyPrint(this.GetType().Name);
    }
    
}

public class Rectangle : Shape
{
    public double Width{get; set;}
    public double Height{get; set;}
    
  public Rectangle(ShapeColor color, double width, double height)
      : base(color)
    {
      Width = width;
      Height = height;
    }
  
    public override double GetArea()
    {
      return Width*Height;
    }
    
    public override void PrettyPrint()
    {
        base.PrettyPrint(this.GetType().Name);
    }
}


