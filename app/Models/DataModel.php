<?php
/**
 * Created by PhpStorm.
 * User: Marto
 * Date: 7/17/2018
 * Time: 00:11
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
 use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie;








class DataModel
{
        private $user_id = '';
        private $id ='';
        private $check = '';



    public function indexData()
    {

        $data = DB::select('SELECT * FROM `cats` ');



        return $data;
    }


    public function getSliderImgs(){
        $data = DB::select('SELECT
            *
        FROM
            `slider-images`
        LEFT JOIN `cats` ON `slider-images`.`category_id`=`cats`.`category_id`');

        return $data;
    }

    public function globalSearch($input){
     $data = DB::select("SELECT * FROM `items` WHERE `model` LIKE '%{$input}%' ");
     $cats = $this->indexData();
     return  array('categories'=> $cats,'globalitems'=>$data);
    }

    public function getCounts($input){
        $counts = DB::select( "SELECT count(*) from `items` WHERE `model` LIKE '%{$input}%'");
        return $counts;
    }



    /**
     * @param $name
     */
    public function Categories($category)
    {
        $data = DB::select("SELECT * FROM `products` LEFT JOIN `cats` ON products . category_id = cats . category_id WHERE cats . categories = '".$category."' ");
        return $data;
    }

    public function CategoryItems($cat_item){
        $data = DB::select("SELECT * FROM `items` LEFT JOIN `cats` ON `items`.`category_id`=`cats`.`category_id`
        WHERE `cats`.`categories` LIKE '%{$cat_item}%'  ");
        return $data;
    }

    public function getCertainProduct($product){
            $data = DB::select("SELECT * FROM `items` LEFT JOIN `products` ON `items`.`product_id`=`products`.`product_id`
              WHERE `products`.`product` LIKE '%{$product}%'");
            return $data;
    }


    public function getBrands($brands){
            $data = DB::select("SELECT
            *
        FROM
            `items`
        LEFT JOIN `brands` ON `brands`.`brand_id` = `items`.`brand_id`
        LEFT JOIN `products` ON `items`.`product_id` = `products`.`product_id`
        WHERE
            `products`.`product` LIKE '%{$brands}%' ");

        return $data;
    }

    public function BrandItems($brand,$product){
        $data = DB::select("SELECT
                *
            FROM
                `items`
            LEFT JOIN `cats` ON `cats`.`category_id` = `items`.`category_id`
            LEFT JOIN `products` ON `products`.`product_id` = `items`.`product_id`
            LEFT JOIN `brands` ON `brands`.`brand_id` = `items`.`brand_id`
            WHERE `brands`.`brand_name` LIKE '%{$brand}%' AND `products`.`product` LIKE '{$product}' ");
        return $data;
    }

    public function Item($id){
        $this->id = $id;
           $data = DB::select("SELECT * FROM `product_comments` RIGHT JOIN `items` ON `product_comments`.`product_id`=`items`.`id` WHERE `items`.`id` = ?  ",[$id]);
           return $data;
    }

    public function itemCategories(){
        $id = $this->id;
        $data = DB::select("SELECT
            *
        FROM
            `brands`
        LEFT JOIN `items` ON `items`.`brand_id`=`brands`.`brand_id`
        LEFT JOIN `products` ON `products`.`product_id`=`items`.`product_id`
        LEFT JOIN `cats` ON `cats`.`category_id`=`items`.`category_id`
        WHERE `items`.`id` = ?",[$id]);
        return $data;
    }

  public function postComment(){


        $data = Input::all();

        if(empty($data['user_id'])){
            $data['user_id'] = 0;
        }
      $this->user_id = $data['user_id'];

        DB::insert("INSERT INTO product_comments (comment,product_id,user_id,username)VALUES(?,?,?,?) ",[$data['comment'],$data['id'],$data['user_id'],$data['username']]);



  }

  public function shippingData(){

        $request = new Request();

            if (session()->get('user_id')) {
                $user_id = session()->get('user_id')[0]->user_id;

            } else {
                $user_id = 0;
            }

            $ip = \Request::ip();

            $data = Input::all();
            /*
          isset($data['qty']) ? $qty = $data['qty'] :  0;
          isset($data['items']) ? $items = $data['items'] :  0;
          isset($data['City']) ? $data['City'] : '';
          isset($data['zipcode']) ? $data['zipcode'] : '';
          isset($data['street']) ? $data['street'] : '';
          isset($data['phone']) ? $data['street'] : '';
          isset($data['f-name']) ? $data['f-name'] : '';
          isset($data['l-name']) ? $data['l-name'] : '';
         */


            $qty = unserialize($data['qty']);
            $items = urldecode($data['items']);
            $t = time();
            $date = date("Y-m-d", $t);


          if (!empty($data['City'] && $data['zipcode'] && $data['street'] && $data['phone'] && $data['f-name'] && $data['l-name'])) {
              foreach ($qty as $k => $v) {
                  DB::update("UPDATE `items` SET `qty` = `qty` - '" . $v . "' WHERE `id` = '" . $k . "' ");
              }

              DB::insert("INSERT INTO `orders` (Firstname,Surname,items,City,Zip,Street,Phone,user_ip,`time`,user_id,total_prize)VALUES(?,?,?,?,?,?,?,?,?,?,?) ",
                  [$data['f-name'], $data['l-name'], $items, $data['City'], $data['zipcode'], $data['street'], $data['phone'], inet_pton("$ip"), $date, $user_id, $data['total-prize']]);

              Session::forget('test');

              $this->check = true;






          }
          else{
              $this->check = false;
          }



  }

       public function getCheck(){
          $check = $this->check;
          return $check;
       }



    public function gettingShippingData(){
        if(session()->get('user_id')) {
            $id = session()->get('user_id')[0]->user_id;

        }
        else{
            $id = 0;
        }




        $d=  DB::select(" SELECT `City`,`Zip`,`Street`,`Phone`,`Firstname`,`Surname` from `orders` WHERE `user_id` = '" .$id. " ' ");
        return $d;
    }





}