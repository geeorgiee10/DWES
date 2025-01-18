<?php

namespace Controllers;

use Lib\Pages;
use Models\Category;
use Lib\Utils;
use Services\CategoryService;
use Services\ProductService;

/**
 * Clase para controlar las categorias de la tienda
 */
class CategoryController {

    /**
     * Variable de utilizadas en el controlador de la tienda
     */
    private Pages $pages;
    private Utils $utils;
    private Category $category;
    private CategoryService $categoryService;
    private ProductService $productService;
    

    /**
     * Contructor para inicializar estar variable
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->utils = new Utils();
        $this->category = new Category();
        $this->categoryService = new CategoryService();
        $this->productService = new ProductService();
    }

    /**
     * Metodo que devuelve las categorias que hay en la base de datos y 
     * renderiza la vista
     * @return void
     */
    public function categorias() {
        

        if ($this->utils->isAdmin()){
            $admin = true;
        }
        else{
            $admin = false;
        }


        $categorias = $this->categoryService->listarCategorias();

        $this->pages->render('Category/index', 
        [
            'admin' => $admin,
            'categorias' => $categorias    
        ]);

    }
    /**
     * Metodo para guardar una nueva categoria en la base de datos
     * y tras eso te devuelve a la vista con errores en el caso
     * de que haya
     * @return void
     */
    public function almacenarCategoria() {
        //Obtener datos formularios, sanetizarlos y validarlos
        

        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $this->pages->render('Category/formCategory');
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $data = $_POST['category'];

                $categoria = $this->category = Category::fromArray($data);
                // Sanitizar datos
                $categoria->sanitizarDatos();

                // Validar datos
                $errores = $categoria->validarDatos();

            
                if (empty($errores)) {
                   

                    $categoryData = [
                        'nombre' => $categoria->getNombre(),
                    ];

                    $resultado = $this->categoryService->guardarCategoria($categoryData);

                    if ($resultado === true) {
                        $this->categorias();
                        exit;
                    } 
                    else {
                        $errores['db'] = "Error al guardar la categoria: " . $resultado;
                        $this->pages->render('Category/formCategory', ["errores" => $errores]);
                    }
                } 
                else {
                    $this->pages->render('Category/formCategory', ["errores" => $errores]);
                }
            
        }
    }

    /**
     * Metodo para mostrar los productos de una determinada categoria
     * @var id id de la categoria a mostrar los productos
     * @return void
     */
    public function ProductXCategory(int $id){
        $productos = $this->productService->mostrarProductosXCategoria($id);


        $this->pages->render('Product/gestion', 
        [
            'admin' => $this->utils->isAdmin(),
            'productos' => $productos    
        ]); 
    }
    
    /**
     * Metodo para actualizar los datos de una categoria y te devuelve
     * a la vista si no hay errores
     * @return void
     */
    public function ActualizarCategoria(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            unset($_SESSION['falloDatos']);
            unset($_SESSION['actualizado']);

            $categorias = $this->categoryService->listarCategorias();

            $this->pages->render('Category/updateCategory', ['categorias' => $categorias]);
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($_POST['category']){

                $data = $_POST['category'];

                $categoria = $this->category = Category::fromArray($data);

                $idCategoriaCambiar = $_POST['categoriaSelect'];

                // Sanitizar datos
                $categoria->sanitizarDatos();

                // Validar datos
                $errores = $categoria->validarDatos();

            
                if (empty($errores)) {
    
                    $categoryData = [
                        'nombre' => $categoria->getNombre(),
                    ];

                    $resultado = $this->categoryService->actualizarCategoria($categoryData, $idCategoriaCambiar);

                    if ($resultado === true) {
                        $_SESSION['actualizado'] = true;
                        $this->pages->render('Category/updateCategory');
                        exit;
                    } 
                    else {
                        $errores['db'] = "Error al actualizar la categoria: " . $resultado;
                        $this->pages->render('Category/updateCategory', ["errores" => $errores]);
                    }
                } 
                else {
                    $this->pages->render('Category/updateCategory', ["errores" => $errores]);
                }
            }
            else{
                $_SESSION['falloDatos'] = 'fallo';
                $this->pages->render('Category/updateCategory');
            }
        }
    }
    
    /**
     * Metodo para borrar una categoria determinada y te devuelve a la vista si no hay errores
     * @return void
     */
    public function BorrarCategoria(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            unset($_SESSION['falloDatos']);
            unset($_SESSION['borrado']);

            $categorias = $this->categoryService->listarCategorias();

            $this->pages->render('Category/deleteCategory', ['categorias' => $categorias]);
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($_POST['categoriaSelect']){

                $idCategoriaCambiar = $_POST['categoriaSelect'];

                // Sanitizar datos
                $this->category->sanitizarBorrado($idCategoriaCambiar);

                // Validar datos
                $errores = $this->category->validarBorrado($idCategoriaCambiar);

            
                if (empty($errores)) {

                    if($this->productService->contarProductosXCategoria($idCategoriaCambiar) <= 0){
                            $resultado = $this->categoryService->borrarCategoria($idCategoriaCambiar);

                        if ($resultado === true) {
                            $_SESSION['borrado'] = true;
                            $this->pages->render('Category/deleteCategory');
                            exit;
                        } 
                        else {
                            $errores['db'] = "Error al borrar la categoria: " . $resultado;
                            $this->pages->render('Category/deleteCategory', ["errores" => $errores]);
                        }
                        
                    }
                    else{
                        $cambiarCategoria = $this->productService->actualizarProductosXCategoria($idCategoriaCambiar);
                        if ($cambiarCategoria === true) {
                            $resultado = $this->categoryService->borrarCategoria($idCategoriaCambiar);
                            if ($resultado === true) {
                                $_SESSION['borrado'] = true;
                                $this->pages->render('Category/deleteCategory');
                                exit;
                            } 
                            else {
                                $errores['db'] = "Error al borrar la categoria: " . $resultado;
                                $this->pages->render('Category/deleteCategory', ["errores" => $errores]);
                            }
                        } 
                        else {
                            $errores['db'] = "Error al cambiar la categoria de los productos: " . $cambiarCategoria;
                            $this->pages->render('Category/deleteCategory', ["errores" => $errores]);
                        }
                    }
    
                    
                } 
                else {
                    $this->pages->render('Category/deleteCategory', ["errores" => $errores]);
                }
            }
            else{
                $_SESSION['falloDatos'] = 'fallo';
                $this->pages->render('Category/deleteCategory');
            }
        }
    }
}
