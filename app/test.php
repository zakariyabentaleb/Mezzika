
<?php 


    abstract class Vehivule {
        
        protected $nom ;
        protected $speed ;
        protected $color ;


        abstract   public function  move(){
          return 1;
        };

        


    }

    class car extends Vehivule {
       
          
      abstract  public function  move() {

           echo 'is moving'

         }


    }


    class bus extends Vehivule {
       
      abstract  public function  move() {

          echo 'is stop';

        }
    }

 $car = new  car ();
 $car->move();

 $bus = new  bus ();
 $bus->move();


   }





































?>

  