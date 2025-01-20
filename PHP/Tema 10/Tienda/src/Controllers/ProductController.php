<?php

namespace Controllers;

use Lib\Pages;
use Models\Product;
use Lib\Utils;
use Services\ProductService;
use Services\CategoryService;
use Services\OrderLineService;


/**
 * Clase para controlar los productos
 */
class ProductController {

    /**
     * Variables de los productos
     */
    private Pages $pages;
    private Utils $utils;
    private ProductService $productService;
    private OrderLineService $orderLineService;
    private CategoryService $categoryService;
    

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->utils = new Utils();
        $this->productService = new ProductService();
        $this->orderLineService = new OrderLineService();
        $this->categoryService = new CategoryService();
    }

    /**
     * Metodo que saca los productos y los renderiza a la vista
     * @return void
     */
    public function gestion(){

        if ($this->utils->isAdmin()){
            $admin = true;
        }
        else{
            $admin = false;
        }


        $productos = $this->productService->mostrarProductos();

        $this->pages->render('Product/gestion', 
        [
            'admin' => $admin,
            'productos' => $productos    
        ]);    
    }

    /**
     * Metodo que guardar los productos en caso de no haber errores
     * y renderiza la vista
     * @return void
     */
    public function guardarProductos() {
        

        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            if(!$this->utils->isAdmin()){
                header("Location: " . BASE_URL ."");
            }
            else{
                unset($_SESSION['guardado']);

                $categorias = $this->categoryService->listarCategorias();


                $this->pages->render('Product/formProducto',
                [
                    'categorias' => $categorias
                ]);
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagenNombre = '';
            $rutaCarpeta = '../../public/img';
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];


            if (!is_dir($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true); 
            }

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $tipoArchivo = mime_content_type($_FILES['imagen']['tmp_name']); 
                if (!in_array($tipoArchivo, $tiposPermitidos)) {
                    $errores['imagen'] = "El archivo debe ser una formato válido (JPEG, PNG o GIF).";
                } else {
                    $imagenNombre = basename($_FILES['imagen']['name']);
                    $rutaArchivo = rtrim($rutaCarpeta, '/') . '/' . $imagenNombre;
    
                    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                        $errores['imagen'] = "No se pudo guardar el archivo de la imagen.";
                    }
                }
            } else if (isset($_FILES['imagen']['error']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
                $errores['imagen'] = "Error al cargar la imagen: " . $_FILES['imagen']['error'];
            }


                $producto = new Product(
                    null,
                    $_POST['categoria'],
                    $_POST['nombre'],
                    $_POST['descripcion'],
                    $_POST['precio'],
                    $_POST['stock'],
                    $_POST['oferta'],
                    $_POST['fecha'],
                    $imagenNombre
                );

                // Sanitizar datos
                $producto->sanitizarDatos();

                // Validar datos
                $errores = $producto->validarDatosProductos();

                if (empty($errores)) {
                    
                    $productData = [
                        'categoria_id' => $producto->getCategoriaId(),
                        'nombre' => $producto->getNombre(),
                        'descripcion' => $producto->getDescripcion(),
                        'precio' => $producto->getPrecio(),
                        'stock' => $producto->getStock(),
                        'oferta' => $producto->getOferta(),
                        'fecha' => $producto->getFecha(),
                        'imagen' => $producto->getImagen(),
                    ];

                    $resultado = $this->productService->guardarProductos($productData);

                    if ($resultado === true) {
                        $_SESSION['guardado'] = true;
                        $this->pages->render('Product/formProducto');
                        exit;
                    } 
                    else {
                        $errores['db'] = "Error al guardar el producto: " . $resultado;
                        $this->pages->render('Product/formProducto', ["errores" => $errores]);
                    }
                } 
                else {
                    $this->pages->render('Product/formProducto', ["errores" => $errores]);
                }
            
        }
    }

    /**
     * Metodo que obtiene los detalles de un producto
     * @var id id del producto al que obtener los detalles
     * @return void
     */
    public function detailProduct(int $id){
        $details = $this->productService->detailProduct($id);

        //die(var_dump(($details)));

        $this->pages->render('Product/detail', 
        [
            'admin' => $this->utils->isAdmin(),
            'details' => $details    
        ]); 
    }

    /**
     * Metodo que borrar  un producto
     * @var id id del producto a borrar
     * @return void
     */
    public function deleteProduct (int $id){
        if(!$this->utils->isAdmin()){
            header("Location: " . BASE_URL ."");
        }
        else{
            $lines = $this->orderLineService->seeProductOrdersLine($id);
            if($lines > 0){
                $update = $this->productService->updateCategoryProduct($id);
                if ($update === true) {
                    header("Location: " . BASE_URL ."");
                } 
                else {
                    $_SESSION['falloDatos'] = 'fallo';
                    $this->pages->render('Product/detail/$id');
                }
            }
            else{
                $resultado = $this->productService->deleteProduct($id);

                if ($resultado === true) {
                    header("Location: " . BASE_URL ."");
                    exit;
                } 
                else {
                    $_SESSION['falloDatos'] = 'fallo';
                    $this->pages->render('Product/detail/$id');
                }
            }

            
        }
                    
    }

    /**
     * Metodo que actualiza los datos de un producto
     * @var id id del producto aactualizar
     * @return void
     */
    public function updateProduct(int $id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            if(!$this->utils->isAdmin()){
                header("Location: " . BASE_URL ."");
            }
            else{

                unset($_SESSION['actualizado']);

                $categorias = $this->categoryService->listarCategorias();
                $product = $this->productService->detailProduct($id);


                $this->pages->render('Product/formUpdate',
                [
                    'categorias' => $categorias,
                    'product' => $product
                ]);
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            

            $imagenNombre = '';
            $rutaCarpeta = '../../public/img';
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];


            if (!is_dir($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true); 
            }

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $tipoArchivo = mime_content_type($_FILES['imagen']['tmp_name']); 
                if (!in_array($tipoArchivo, $tiposPermitidos)) {
                    $errores['imagen'] = "El archivo debe ser una formato válido (JPEG, PNG o GIF).";
                } else {
                    $imagenNombre = basename($_FILES['imagen']['name']);
                    $rutaArchivo = rtrim($rutaCarpeta, '/') . '/' . $imagenNombre;
    
                    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                        $errores['imagen'] = "No se pudo guardar el archivo de la imagen.";
                    }
                }
            } else if (isset($_FILES['imagen']['error']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
                $errores['imagen'] = "Error al cargar la imagen: " . $_FILES['imagen']['error'];
            }

            $product = $this->productService->detailProduct($id);

            if($imagenNombre === ''){
                $imagenNombre = $product[0]['imagen'];
            }


                $producto = new Product(
                    null,
                    $_POST['categoria'],
                    $_POST['nombre'],
                    $_POST['descripcion'],
                    $_POST['precio'],
                    $_POST['stock'],
                    $_POST['oferta'],
                    "",
                    $imagenNombre
                );

                // Sanitizar datos
                $producto->sanitizarDatos();
                
                // Validar datos
                $errores = $producto->validateUpdate();

                if (empty($errores)) {
                    
                    $productData = [
                        'categoria_id' => $producto->getCategoriaId(),
                        'nombre' => $producto->getNombre(),
                        'descripcion' => $producto->getDescripcion(),
                        'precio' => $producto->getPrecio(),
                        'stock' => $producto->getStock(),
                        'oferta' => $producto->getOferta(),
                        'fecha' => $producto->getFecha(),
                        'imagen' => $producto->getImagen(),
                    ];

                    $resultado = $this->productService->updateProduct($productData, $id);

                    if ($resultado === true) {
                        $_SESSION['actualizado'] = true;
                        $this->pages->render('Product/formUpdate');
                        exit;
                    } 
                    else {
                        $errores['db'] = "Error al actualizar el producto: " . $resultado;
                        $this->pages->render('Product/formUpdate', ["errores" => $errores]);
                    }
                } 
                else {
                    $this->pages->render('Product/formUpdate', ["errores" => $errores]);
                }
            
        }
    }

}

