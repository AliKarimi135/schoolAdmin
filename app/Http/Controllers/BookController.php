<?php

namespace App\Http\Controllers;

use App\Book;

use App\Http\Utilitis\BookFuctions;
use App\Http\Utilitis\ClassRoomFunctions;
use Validator;
use Illuminate\Http\Request;

class BookController extends Controller
{


    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|string|max:50 ',
            'expertise' => 'required|string|max:50'
        ];
        $message = [
            'required' => 'پر نمودن این فیلد اجباری است',
            'max' => 'طول عبارت شما خیلی بزرگ است',
        ];
        return Validator::make($data, $rules, $message);
        
    }

    /**
     * Display a list of resource
     * @return Response
     */
    public function index()
    {
        $expertises = ClassRoomFunctions::getExpertises();
        $books =BookFuctions::allBooks();

        return view('book.show_book',compact('books'),compact('expertises'));
    }
    //$base,$type,$expertise
    public function search(Request $request,$id)
    {
        //return view('book.show_book',compact('books'),compact('expertises'));
        return redirect()->route('book.result.search',[$request->type,$request->base,$request->expertise]);
    }

    public function resultSearch($type,$base,$expertise)
    {
        $expertises = ClassRoomFunctions::getExpertises();
        $books=BookFuctions::searchBooks((int)$type,(int)$base,$expertise);
        return view('book.show_book',compact('books'),compact('expertises'));
    }

    /**
     * show the form for crate a new resource
     * @return Response
     */
    public function create()
    {
        $expertises = ClassRoomFunctions::getExpertises();
        return view('book.add_book',compact('expertises'));
    }

    /**
     * store a newly created resource in database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validator($request->toArray())->validate();
        $book=new Book;
        $book->create($request->all());
        return back();
    }



    /**
     * show the form for editing the specified resource
     * @param $id
     */
    public function edit($id)
    {
        $books=Book::find($id);
        $expertises = ClassRoomFunctions::getExpertises();
         return view('book.add_book',compact('books'),compact('expertises'));
    }

    /**
     * update the specified resource
     * @param $id
     */

    public function update(Request $request,$id)
    {
        $this->validator($request->toArray())->validate();
        Book::find($id)->update($request->toArray());
        /*$book=Book::find($id);
        $book->name=$request->name;
        $book->base=$request->base;
        $book->expertise=$request->expertise;
        $book->type=$request->type;
        $book->save();*/
        return redirect($request->pre_page);
    }
    public function destroy($id)
    {
        $book=Book::find($id);
        $book->delete();
        return back();
    }
    public function getBookByBase(Request $request)
    {
        if ($request->ajax()) {
            $books = Book::where('base',$request->base)->where('expertise','LIKE',$request->expertise)->orderBy('type','asc')->get();
            $i=0;
            $jsonData=array();
            if ($books) {
                foreach ($books as $book) {
                    $temp=array(
                        'bookId'=>$book->id,
                        'bookName'=>$book->name,
                        'type'=>$book->type
                    );
                    $jsonData[$i++]=$temp;
                }
                return \Response::json($jsonData);
            }
        }

    }
}
