<?php
/**
 * Created by PhpStorm.
 * User: Marto
 * Date: 7/17/2018
 * Time: 00:13
 */

namespace App\Http\Controllers;
use App\Models\DataModel;
use App\Models\UserModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Request;






class DataController
{
           protected  $databrands =  '';
         protected  $brands = '';
         protected $product_name = '';
         protected $certain_product = '';
         protected $branditems = '';
         protected $sidebar ='';

           public function getCategories($name = ''){

                 $this->product_name = $name;
                 $dm = new DataModel();
                 $data = $dm->Categories($name);
                 $data2 = $dm->CategoryItems($name);

                 if(empty($name)){

                     return redirect('/')->with('msg', 'You haven\'t chosen any category!');
                 }

               return view('templates.data')->with(array('sidebar'=>$data,'data'=>$data2));

           }
     /*
           public function AjaxReturn(){

                 $input = Input::all();

                 return response()->json(['jsondata'=>$input]);

           }
     */


               public function CertainProducts($name, $certainproducts = ''){
                       $this->product_name = $name;
                       $this->certain_product = $certainproducts;






                   $dm = new DataModel();
                   $data2 = $dm->getBrands($certainproducts);
                   $data = $dm->getCertainProduct($certainproducts);

                   if(empty($certainproducts)){

                       return redirect("/Category/$name")->with('msg', 'You haven\'t chosen any subcategory!');
                   }



                   return view('templates.subdata')->with(array('data'=>$data,'brands'=>$data2));



               }


               public function getBrandItems($name,$certainproducts,$branditem = ''){
                   $this->product_name = $name;

                  $this->certain_product = $certainproducts;
                   $this->branditems = $branditem;

                   $dm = new DataModel();

                  $sidebar = $dm->getBrands($certainproducts);
                   $this->sidebar = $sidebar;
                   $data = $dm->BrandItems($branditem,$certainproducts);


                  if(empty($branditem)){
                      return redirect("/Category/$name/Subcategory/$certainproducts")->with('msg', 'You haven\'t chosen any brand!');
                  }

                   return view('templates.branditems')->with(array('sidebar'=>$sidebar,'data'=>$data));


               }

               public function getItem($id){

                   $dm = new DataModel();
                   $data = $dm->Item($id);
                   $side = $dm->itemCategories();
                   return view('templates.item')->with(array('item'=>$data,'sidebar'=>$side));
               }

               public function comment(){
                   $dm = new DataModel();
                   $dm->postComment();

                   return redirect()->back();

               }

               public function getShippingData(){
                   $dm = new DataModel();

                return view('templates.chart')->with(array('sh'=>$dm->gettingShippingData()));

               }
               public function postShoppingData(){
                   $dm = new DataModel();

                   try {
                      $dm->shippingData();
                   } catch (Exception $e) {
                       echo 'Caught exception: ',  $e->getMessage(), "\n";
                   }

                     if($dm->getCheck() == true) {
                         return Redirect::to('Cart')->with('order', 'Your order was successful!');
                     }
                        else {
                            return Redirect::to('Cart')->with('fail', 'All fields must be filled!');
                        }


               }

















}