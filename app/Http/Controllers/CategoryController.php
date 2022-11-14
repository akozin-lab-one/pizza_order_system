<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function listPage(){
        $categories = Category::when(request('key'), function($query){
                        $query->where('name', 'like', '%'.request('key').'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(5);
        return view('Admin.category.list', compact('categories'));
    }

    // createPage
    public function createPage(){
        return view('Admin.category.create');
    }

    // create
    public function createData(Request $request){
        $this->validateCheckData($request);
        $data = $this->requestData($request);
        Category::create($data);
        return back()->with(['createsuccess'=>'Create Success!']);
    }

    // edit data Page
    public function editDataPage($id){
        $category = Category::where('id', $id)->first();
        return view('Admin.category.edit', compact('category'));
    }

    // update Data
    public function updateData(Request $request){
        $this->validateCheckData($request);
        $data = $this->requestData($request);
        Category::where('id', $request->id)->update($data);
        return redirect()->route('Category#list');
    }

    // delete Data
    public function deteteData($id){
        Category::where('id', $id)->delete();
        return back()->with(['deletesuccess' => 'Delete Success!']);
    }

    // validateData
    private function validateCheckData($request){
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,' . $request->id
        ])->validate();
    }

    // arraydata change
    private function requestData($request){
        $data = [
            'name' => $request->categoryName
        ];

        return $data;
    }
}
