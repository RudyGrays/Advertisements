<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;




class AdvertisementController extends Controller
{
    public function getAdvertisements(Request $request) {
        $categories = Category::all();
        $advertisements = Advertisement::where('status', 'fullfield')->get();
        return view('advertisements', compact('categories', 'advertisements'));
    }

    public function getAdvertisementsWithCategory(Request $request) {
        $categories = Category::all();
        
        $advertisements = Advertisement::where('categoryID', $request['categoryID'])->where('status', 'fullfield')->get();
        
        $category = Category::find($request['categoryID']);
        
        return view('advertisements', compact('categories', 'advertisements', 'category'));
    }


    public function getFormAdvertisement(Request $request) {
        $categories = Category::all();
        return view('advertisementsForm', compact('categories'));  
    }


    public function createAdvertisement(Request $request) {
        
        if($request['categoryInput']){
            $newCategory = Category::create([
                'categoryName'=> $request['categoryInput']
            ]);

            $advertisement = Advertisement::create([
                'userID' => Auth::user()->id,
                'categoryID' => $newCategory->id,
                'title'=>$request->title,
                'adPhoto'=>$request->file,
                'description'=>$request->description,
                'status'=>'pending'
            ]);
        }

        if(!$request['categoryInput']){
            $advertisement = Advertisement::create([
                'userID' => Auth::user()->id,
                'categoryID' => $request->categoryID,
                'title'=>$request->title,
                'adPhoto'=>$request->file,
                'description'=>$request->description,
                'status'=>'pending'
            ]);
        } 
        $categories = Category::all();
        $advertisements = Advertisement::where('categoryID', $request['categoryID'])->where('status', 'fullfield')->get();
        $category = Category::find($request['categoryID']);
        return view('advertisements', compact('advertisements','categories', 'category'));
    }
    
}
