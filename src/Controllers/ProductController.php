<?php
namespace App\Controllers;

use App\Application;
use App\ModelRequests\BookRequest;
use App\ModelRequests\DvdRequest;
use App\ModelRequests\FurnitureRequest;
use App\ModelRequests\Request;
use App\Models\Book;
use App\Models\Dvd;
use App\Models\Furniture;
use App\View;

class ProductController extends Controller
{   
    private BookRequest $bookRequest;
    private FurnitureRequest $furnitureRequest;
    private DvdRequest $dvdRequest;
    private Request $request;
    private Book $book;
    private Dvd $dvd;
    private Furniture $furniture;

    public function __construct(Request $request, Book $book, Dvd $dvd, Furniture $furniture, BookRequest $bookRequest, FurnitureRequest $furnitureRequest, DvdRequest $dvdRequest)
    {
        $this->bookRequest = $bookRequest;
        $this->furnitureRequest = $furnitureRequest;
        $this->dvdRequest = $dvdRequest;
        $this->book = $book;
        $this->dvd = $dvd;
        $this->furniture = $furniture;
        $this->request = $request;
    }

    public function index()
    {
        $products = [
            'books' => $this->book->getAllBooks(),
            'dvds' => $this->dvd->getAllDvds(),
            'furnitures' => $this->furniture->getAllFurniture(),
        ];
        return View::make('index', ['products' => $products])->render();
    }

    public function create()
    {
        return View::make('create')->render();
    }

    public function store(){

        $this->request->post('productType') == 'book' ? $this->bookRequest->rules([
            'sku' => $this->request->post('sku'),
            'name' => $this->request->post('name'),
            'weight' => $this->request->post('weight'),
            'price' => $this->request->post('price')
       ]) : null;

       $this->request->post('productType') == 'dvd' ? $this->dvdRequest->rules([
            'sku' => $this->request->post('sku'),
            'name' => $this->request->post('name'),
            'size' => $this->request->post('size'),
            'price' => $this->request->post('price')
        ]) : null;
        
        $this->request->post('productType') == 'furniture' ? $this->furnitureRequest->rules([
            'sku' => $this->request->post('sku'),
            'name' => $this->request->post('name'),
            'height'=> $this->request->post('height'),
            'width' => $this->request->post('width'),
            'length' => $this->request->post('length'),
            'price' => $this->request->post('price')
        ]) : null;

        if($this->request->post('productType') == 'book'){
            $book = $this->book;
            $book->setSku($this->request->post('sku'));
            $book->setName($this->request->post('name'));
            $book->setPrice($this->request->post('price'));
            $book->setproductType($this->request->post('productType'));
            $book->setWeight($this->request->post('weight'));
            $book->insert();
        }
        
        if($this->request->post('productType') == 'dvd'){
            $dvd = $this->dvd;
            $dvd->setSku($this->request->post('sku'));
            $dvd->setName($this->request->post('name'));
            $dvd->setPrice($this->request->post('price'));
            $dvd->setproductType($this->request->post('productType'));
            $dvd->setSize($this->request->post('size'));
            $dvd->insert();
        }   

        if($this->request->post('productType') == 'furniture'){
            $furniture = $this->furniture;
            $furniture->setSku($this->request->post('sku'));
            $furniture->setName($this->request->post('name'));
            $furniture->setPrice($this->request->post('price'));
            $furniture->setproductType($this->request->post('productType'));
            $furniture->setWidth($this->request->post('width'));
            $furniture->setHeight($this->request->post('height'));
            $furniture->setLength($this->request->post('length'));
            $furniture->insert();
        }
        
        return $this->redirect('/phpTest');  
    }

    public function cancel()
    {
        header('Location: ' . "/phpTest/");  
    }

    public function delete(){
        $products = [
            $this->dvd->delete(),
            $this->furniture->delete(),
            $this->book->delete(),
        ];
        header('Location: ' . "/phpTest/");  
    }
}
