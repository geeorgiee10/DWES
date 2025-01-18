<?php

namespace Controllers;

use Lib\Pages;
use Models\Product;
use Lib\Utils;
use Services\ProductService;
use Services\CategoryService;


/**
 * Clase para controlar el carrito
 */
class CartController {

    /**
     * Variables privadas del controlador
     */
    private Pages $pages;
    private Utils $utils;
    private ProductService $productService;
    private CategoryService $categoryService;
    
    /**
     * Constructor para inicializar las variables
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->utils = new Utils();
        $this->productService = new ProductService();
        $this->categoryService = new CategoryService();
    }

    /**
     * Método que renderiza la vista del carrito
     * @return void
     */
    public function loadCart(){
        $total = $this->priceTotal();

        $_SESSION['totalCost'] = $total;

        $this->pages->render('Cart/cart'); 

    }

    /**
     * Metodo que calcula el precio total del carrito
     * @return int $total -> Varaible con el precio total del carrito
     */
    public function priceTotal (){
        $total = 0;


        if(isset($_SESSION['carrito']) || !empty($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $item){
                $total += $item['precio'] * $item['cantidad'];
            }
        }

        return $total;
    }


    /**
     * Metodo que añade un produco al carrito si no esta creado y si lo esta
     * aumenta su cantidad y despues renderiza la vista
     * @var id id del producto a añadir al carrito
     * @return void
     */
    public function addProduct(int $id){

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array(); 
        }


        $productCart = $this->productService->detailProduct($id);

        //die(var_dump($productCart));
        //unset($_SESSION['carrito']);

        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] += 1;  
        } 
        else {
            $_SESSION['carrito'][$id] = array(
                'id' => $productCart[0]['id'],
                'imagen' => $productCart[0]['imagen'],
                'nombre' => $productCart[0]['nombre'],
                'precio' => $productCart[0]['precio'],
                'stock' => $productCart[0]['stock'],
                'cantidad' => 1  
            );
        }

        //die(var_dump($_SESSION['carrito']));
        $this->loadCart();

    }

    /**
     * Metodo que vacia el carrito y redirije a la vista
     * @return void
     */
    public function clearCart(){
        unset($_SESSION['carrito']);

        //$this->loadCart();
        header("Location: " . BASE_URL . "Cart/loadCart");
    }

    /**
     * Metodo que elimina un producto del carrito y tras eso renderiza la vista
     * @var id id del producto a quitar del carrito´
     * @return void
     */
    public function removeItem (int $id){
        if(isset($_SESSION['carrito'][$id])){
            unset($_SESSION['carrito'][$id]);

            //$this->loadCart();
            header("Location: " . BASE_URL . "Cart/loadCart");
        }
        else{
            $errorRemove = 'Error al borrar el producto';
            $total = $this->priceTotal();

            $this->pages->render('Cart/cart',['errorRemove' => $errorRemove, 'total' => $total]); 
        }
    }

    /**
     * Metod que decrementa la cantidad de un producto y renderiza la vista
     * @var id id del produto a decrementar su cantidad
     * @return void
     */
    public function downAmount(int $id){
        if(isset($_SESSION['carrito'][$id])){
            $_SESSION['carrito'][$id]['cantidad'] -= 1;

            if($_SESSION['carrito'][$id]['cantidad'] === 0){
                unset($_SESSION['carrito'][$id]);
            }

            //$this->loadCart(); 
            header("Location: " . BASE_URL . "Cart/loadCart");
        }
        else{
            $error = 'Error al quitar unidades';
            $total = $this->priceTotal();

            $this->pages->render('Cart/cart',['error' => $error, 'total' => $total]); 
        }
    }

    /**
     * Metod que aumenta la cantidad de un producto y renderiza la vista
     * @var id id del produto a aumentar su cantidad
     * @return void
     */
    public function upAmount(int $id){
        if(isset($_SESSION['carrito'][$id])){
            if($_SESSION['carrito'][$id]['cantidad'] === $_SESSION['carrito'][$id]['stock']){
                //$this->loadCart(); 
                header("Location: " . BASE_URL . "Cart/loadCart");
            }
            else{
                $_SESSION['carrito'][$id]['cantidad'] += 1;
                //$this->loadCart();
                header("Location: " . BASE_URL . "Cart/loadCart");
            }
        }
        else{
            $error = 'Error al añadir unidades';
            $total = $this->priceTotal();

            $this->pages->render('Cart/cart',['error' => $error, 'total' => $total]); 
        }
    }


   


    
}
