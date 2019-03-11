<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\DataModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;



class IndexController{
    
    public function rendTemplate(){


    return view('index');
    }
       
        
    public function SessDestroy(UserModel $usermodel){
            $usermodel->sessdestroy();
           return  redirect ('/');
        }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getData()
    {
        $dm = new DataModel();
       $data = $dm->indexData();
       $imgs = $dm->getSliderImgs();



        return view('index')->with(array('data'=>$data,'imgs'=>$imgs));
    }

    public function globalData(){

        $dm = new DataModel();

               $input = Input::get('gb-search');
                 $count = $dm->getCounts($input);
                 $data = $dm->globalSearch($input);
            if(empty($input) || $count < 1 ){

                return redirect()->back()->with('err','Nothing was found!');

            }
            else{

                $data = $dm->globalSearch($input);



                if(empty($data['globalitems'])){
                    return redirect()->back()->with('err','Nothing was found!');

                }
                else {
                    return view('templates.global')->with('data', $data);
                }

            }

        }


      public function chartSession(){

        $test = Input::all();

        $um = new UserModel();
        $um->pushSess('test',$test);

        return redirect()->back();


      }

      public function deleteItem(Request $request,$id){
           # $i = 0;
           # $sd = session()->get('test');
          #session()->forget($sd[$id]);
           # unset($sd[$id]);
        # session()->forget('test'.$id);
        #  unset($sd[$id]);
         # $request->session()->forget('test');
         # unset($sd[0][$id]);
                 #  session()->forget('test.'.$id);

          foreach (session()->get('test') as $key => $value) {
              if($value['id'] === $id){
                     session()->forget('test.'.$key);
                      break;
                }
                      }


          return redirect()->back();

      }

      public function receiveShippingData(){
        $i = new DataModel();
      $data=  $i->gettingShippingData();


          return view('templates.shipping-data')->with('data', $data);
      }




}