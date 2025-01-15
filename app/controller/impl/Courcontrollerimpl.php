<?php
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\entities\Cours.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CourModelimpl.php';
 class Courcontrollerimpl {
    private CourModelimpl $courModel;
    public function __construct()
    {
        $this->courModel = new CourModelimpl();
    }

    public function fetchCours(): array|bool {
        try {
            $result=$this->courModel->getAllCours();
            return $result;
            
     
        }
        catch (Exception $e) {
            return false ;

    }


    }




 }





?>