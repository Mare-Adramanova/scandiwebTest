<?php

namespace App\Controllers;

use App\ModelRequests\BookRequest;
use App\ModelRequests\DvdRequest;
use App\ModelRequests\FurnitureRequest;
use App\Models\Book;
use App\Models\Dvd;
use App\Models\Furniture;
use App\Request;
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

    public function __construct(
        Request          $request,
        Book             $book,
        Dvd              $dvd,
        Furniture        $furniture,
        BookRequest      $bookRequest,
        FurnitureRequest $furnitureRequest,
        DvdRequest       $dvdRequest)
    {
        $this->bookRequest = $bookRequest;
        $this->furnitureRequest = $furnitureRequest;
        $this->dvdRequest = $dvdRequest;
        $this->book = $book;
        $this->dvd = $dvd;
        $this->furniture = $furniture;
        $this->request = $request;
    }

    /**
     * @throws \App\Exceptions\ViewNotFoundException
     */
    public function index()
    {
        $products = [
            'books' => $this->book->get(),
            'dvds' => $this->dvd->get(),
            'furnitures' => $this->furniture->get(),
        ];
        return View::make('index', ['products' => $products])->render();
    }

    /**
     * @throws \App\Exceptions\ViewNotFoundException
     */
    public function create()
    {
        return View::make('create')->render();
    }

    private function validate($type)
    {
        return [
            'book' => $this->{$type.'Request'}->rules($this->request->post()),
            'dvd' => $this->{$type. 'Request'}->rules($this->request->post()),
            'furniture' => $this->{$type.'Request'}->rules($this->request->post()),
        ];

    }

    private function storeModels($data)
    {
        $models = [
            'dvd' => $this->dvd->save($this->request->post()),
            'furniture' => $this->furniture->save($this->request->post()),
            'book' => $this->book->save($this->request->post()),
        ];

        return $models[$data];
    }

    public function store()
    { 
       $this->validate($this->request->post('productType')); 
       
       try {
            $this->storeModels($this->request->post('productType'));
        } catch (\PDOException $exception) {
            throw $exception;
        }

        return $this->redirect('/phpTest');
    }

    public function cancel()
    {
        header('Location: ' . "/phpTest/");
    }

    public function delete()
    {
        $products = [
            $this->dvd->destroy($this->request->post()),
            $this->furniture->destroy($this->request->post()),
            $this->book->destroy($this->request->post()),
        ];
        header('Location: ' . "/phpTest/");
    }
}
