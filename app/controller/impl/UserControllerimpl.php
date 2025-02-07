<?php
require_once '../../entities/User.php';
require_once '../../entities/Melophile.php';
require_once '../../entities/Artist.php';
require_once '../../enums/Role.php';
require_once '../../model/UserModel.php';
require_once '../../model/impl/UserModelimpl.php';

class UserControllerimpl
{

    private UserModelimpl $userModel;
    public function __construct()
    {
        $this->userModel = new UserModelimpl();
    }

    
    public function save(Artist|Teacher $person): bool
    {
        try{
            if ($person->getRole()=='artist'){
                $person= new Artist($_POST["email"], $_POST["password"], $_POST["name"], Role::from($_POST["role"])) ;
    
            }
            else if ($person->getRole()=='user'){
                $person= new Melophile($_POST["email"], $_POST["password"], $_POST["name"], Role::from($_POST["role"])) ;
            }
            
               return  $this->userModel->save($person);
        }
        catch(Exception $e){   
            return false;

    }
    }
    public function verifyUser(User $person): array|bool
    {
        try{
            $person= new User($_POST["email"], $_POST["password"],'',Role::STUDENT) ;
               return  $this->userModel->verifyUser($person);
        }
        catch(Exception $e){   
            return false;

    }
       
    }
         
}


?>