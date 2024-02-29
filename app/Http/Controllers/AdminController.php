<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getAdminPanel(){
        return view('admin.admin');
    }

    public function getInfo(Request $request){
        
        $type = $request->type;

        if(!$type) return view('admin.admin'); 

        if($type == 'users'){
            $users = User::whereIn('role', ['user', 'Blocked'])->get();

            return view('admin.admin', compact('users', 'type'));
        } 

        if($type == 'advertisements') {
            $advertisements = Advertisement::where('userID', '!=', Auth::user()->id)->get();

            return view('admin.admin', compact('advertisements', 'type'));
        }
    }



    public function controlUser(Request $request){
        if(isset($request->blockUser)){
            $user = User::find($request->blockUser);

            $user->role = 'Blocked';
            $user->save();

            $users = User::whereIn('role', ['user', 'Blocked'])->get();
            $type = 'users';

            return view('admin.admin', compact('users', 'type'));
        }

        $user = User::find($request->unBlockUser);

        $user->role = 'user';
        $user->save();

        $users = User::whereIn('role', ['user', 'Blocked'])->get();
        $type = 'users';
        
        return view('admin.admin', compact('users', 'type'));
    }

    public function controlAdvertisement(Request $request){

        if(isset($request->unBlockAdvertisement)){
            $advertisement = Advertisement::find($request->unBlockAdvertisement);

            $advertisement->status = 'fullfield';
            $advertisement->save();

           
            $type = 'advertisements';

            $advertisements = Advertisement::where('userID', '!=', Auth::user()->id)->get();

            return view('admin.admin', compact('advertisements', 'type'));
        }
        if(isset($request->blockAdvertisement)){
            $advertisement = Advertisement::find($request->blockAdvertisement);

            $advertisement->status = 'pending';
            $advertisement->save();

           
            $type = 'advertisements';

            $advertisements = Advertisement::where('userID', '!=', Auth::user()->id)->get();

            return view('admin.admin', compact('advertisements', 'type'));
        }
        if(isset($request->editAdvertisement)){
            $advertisement = Advertisement::find($request->editAdvertisement);
            $categories = Category::where('id', '!=', $advertisement->categoryID)->get();
            $currentCategory = Category::where('id', $advertisement->categoryID)->first();
            $advertisementID =  $advertisement->id;
            return view('admin.editForm', compact('advertisement', 'categories', 'currentCategory', 'advertisementID'));
        }

    }

    public function editAdvertisement(Request $request) {
        $advertisement = Advertisement::find($request->advertisementID);

        if($request['categoryInput']){
            return dd($request->all());
            $newCategory = Category::create([
                'categoryName'=> $request['categoryInput']
            ]);

            $advertisement->title = $request->title;
            $advertisement->categoryID = $request->newCategoryID;
            $advertisement->adPhoto = $request->file;
            $advertisement->description = $request->description;
            $advertisement->status = $advertisement->status;

            $advertisement->save();
        }

        if(!$request['categoryInput']){
            
            $advertisement->title = $request->title;
            $advertisement->categoryID = $request->categoryID;
            $advertisement->adPhoto = $request->file;
            $advertisement->description = $request->description;
            $advertisement->status = $advertisement->status;
            $advertisement->save();
        } 

        $categories = Category::all();
        $advertisements = Advertisement::where('userID', '!=', Auth::user()->id)->get();
        $category = Category::find($request['categoryID']);

        $type = 'advertisements';
        return view('admin.admin', compact('advertisements', 'type'));
    }

}
