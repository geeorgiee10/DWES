<?php 

namespace Routes;
use Lib\Router;
use Controllers\ErrorController;
use Controllers\UserController;
use Controllers\ProductController;
use Controllers\CategoryController;
use Controllers\CartController;
use Controllers\OrderController;

/**
 * Clase para controlar las rutas de la aplicacion
 */
class Routes{
    /**
     * Metodo que redirije a los distintos
     * controladores dependiendo de la url que se le pase
     */
    public static function index(){
        Router::add('GET','/',function(){
            (new ProductController())->gestion();
        });

        /*Router::add('GET','/public/',function(){
            (new ProductController())->gestion();
        });*/

        /*Router::add('POST','/public/',function(){
            (new UserController())->registrar();
        });*/



        Router::add('GET','/User/registrar',function(){
            (new UserController())->registrar();
        });

        Router::add('POST','/User/registrar',function(){
            (new UserController())->registrar();
        });

        Router::add('GET','/User/iniciarSesion',function(){
            (new UserController())->iniciarSesion();
        });

        Router::add('POST','/User/iniciarSesion',function(){
            (new UserController())->iniciarSesion();
        });

        Router::add('GET','/User/logout',function(){
            (new UserController())->logout();
        });

        Router::add('GET','/User/verTusDatos',function(){
            (new UserController())->verTusDatos();
        });

        Router::add('GET', 'User/token', function() {
            (new UserController())->checkUser();
        });



        Router::add('GET','/Category/categorias',function(){
            (new CategoryController())->categorias();
        });

        Router::add('GET','/Category/almacenarCategoria',function(){
            (new CategoryController())->almacenarCategoria();
        });

        Router::add('POST','/Category/almacenarCategoria',function(){
            (new CategoryController())->almacenarCategoria();
        });

        Router::add('GET','/Category/ProductXCategory/:id',function(int $id){
            (new CategoryController())->ProductXCategory($id);
        });

        Router::add('GET','/Category/ActualizarCategoria/',function(){
            (new CategoryController())->ActualizarCategoria();
        });

        Router::add('POST','/Category/ActualizarCategoria/',function(){
            (new CategoryController())->ActualizarCategoria();
        });

        Router::add('GET','/Category/BorrarCategoria/',function(){
            (new CategoryController())->BorrarCategoria();
        });

        Router::add('POST','/Category/BorrarCategoria/',function(){
            (new CategoryController())->BorrarCategoria();
        });



        Router::add('GET','/Product/gestion',function(){
            (new ProductController())->gestion();
        });

        Router::add('GET','/Product/guardarProductos',function(){
            (new ProductController())->guardarProductos();
        });

        Router::add('POST','/Product/guardarProductos',function(){
            (new ProductController())->guardarProductos();
        });

        Router::add('GET','/Product/detailProduct/:id',function(int $id){
            (new ProductController())->detailProduct($id);
        });

        Router::add('GET','/Product/deleteProduct/:id',function(int $id){
            (new ProductController())->deleteProduct($id);
        });

        Router::add('GET','/Product/updateProduct/:id',function(int $id){
            (new ProductController())->updateProduct($id);
        });

        Router::add('POST','/Product/updateProduct/:id',function(int $id){
            (new ProductController())->updateProduct($id);
        });



        Router::add('GET','/Cart/loadCart',function(){
            (new CartController())->loadCart();
        });

        Router::add('GET','/Cart/addProduct/:id',function(int $id){
            (new CartController())->addProduct($id);
        });

        Router::add('GET','/Cart/clearCart',function(){
            (new CartController())->clearCart();
        });

        Router::add('GET','/Cart/removeItem/:id',function(int $id){
            (new CartController())->removeItem($id);
        });

        Router::add('GET','/Cart/downAmount/:id',function(int $id){
            (new CartController())->downAmount($id);
        });

        Router::add('GET','/Cart/upAmount/:id',function(int $id){
            (new CartController())->upAmount($id);
        });


        Router::add('GET','/not-found',function(){
            ErrorController::error404();
        });



        Router::add('GET','/Order/authOrder',function(){
            (new OrderController())->authOrder();
        });

        Router::add('GET','/Order/saveOrder',function(){
            (new OrderController())->saveOrder();
        });

        Router::add('POST','/Order/saveOrder',function(){
            (new OrderController())->saveOrder();
        });

        Router::add('GET','/Order/seeOrders',function(){
            (new OrderController())->seeOrders();
        });


        Router::dispatch();
        
    }
}