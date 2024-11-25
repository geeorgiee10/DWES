
<?php 
    require_once 'autoloader.php'; 
    require_once 'config/config.php';
    require_once "Views/layout/header.php";
    use Controllers\FrontController;
    FrontController::main();
    require_once "Views/layout/footer.php";

?>
