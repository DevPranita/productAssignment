<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Validator;
use Redirect;
use Storage;

class ProductController extends Controller
{
    public function __construct(ProductModel $product){
        $this->ProductModel   = $product;
    }

    public function index(Request $request)
    {
        $page = 1;
        $per_page = 20;
        $i =1;
        if (!empty($_GET['page'])) {
            if ($_GET['page']>1) {
                $i = ($_GET['page']-1)*$per_page+1;
            }
            $page = $_GET['page'];
        }        
        $parameter_arr['page'] = $page;
        
        $keyword  = trim($request->input('keyword'));
        $products  = $this->ProductModel;
        if (isset($keyword) && $keyword != '') {
            $products = $products->whereRaw('(product_name like "%'.$keyword.'%" OR product_description like "%'.$keyword.'%")');
        }
        $products = $products->orderBy('id', 'DESC');
        $products = $products->paginate($per_page);
        foreach($products as $row => $value)
        {
            if($value['product_images']) {
                $products[$row]['product_images'] = implode(",",json_decode($value['product_images']));
            }
        }
        return view('index', compact('products', 'i', 'page','parameter_arr'));
    }

    public function add(Request $request)
    {
        if(!empty($_POST)) {
            $input = $request->all();
            $rules= ['product_name' => 'required',
                     'product_price'=>'required|integer'
                   ];
            $validation = Validator::make($input, $rules);
            if ($validation->fails()) {
                    return Redirect::to(env('APP_URL').'product/add')->withErrors($validation)->withInput();
            }else {
                $insert_data = $input;

                $insert_data['product_name']            = (isset($insert_data['product_name'])) ? $insert_data['product_name'] : '';
                $insert_data['product_price']           = (isset($insert_data['product_price'])) ? $insert_data['product_price'] : '';
                $insert_data['product_description']     = (isset($insert_data['product_description'])) ? $insert_data['product_description'] : '';
                
                unset($insert_data['_token']);
                unset($insert_data['images']);               
                $result = $this->ProductModel->create($insert_data);
                if($result) {
                    if($_FILES) {
                        $id = $result->id;
                        $input_img = 'images';
                        $imageArr = array();
                        $images = '';
                        if($_FILES[$input_img]['name'][0] != ""){
                            foreach($_FILES[$input_img]['name'] as $row => $value) {
                                $destination = public_path('products/').$id.'/';
                                $imgInfo = getimagesize($_FILES[$input_img]['tmp_name'][$row]);
                                $imageWidth = $imgInfo[0];
                                $imageheight = $imgInfo[1];
                                $arg = explode('.',$_FILES[$input_img]['name'][$row]);
                                $total = sizeof($arg);
                                $ext = $arg[$total-1];  
                                $raw_name = $arg[0];  
                                $name = rand().'.'.$ext;
                                if(is_dir($destination)) {
                                    if(move_uploaded_file($_FILES[$input_img]['tmp_name'][$row], $destination.$name)) array_push($imageArr,$name);
                                }else{
                                    mkdir($destination, 0777, true);
                                    if(move_uploaded_file($_FILES[$input_img]['tmp_name'][$row], $destination.$name)) array_push($imageArr,$name);
                                }
                            }
                            $images = json_encode($imageArr);
                        }
                        $update_data['product_images']     = (isset($images)) ? $images : '';
                        $this->ProductModel->where('id',$id)->update($update_data);
                    }


                    return Redirect::to(env('APP_URL'))->with('flash_notice', 'Product added successfully.')->withInput();
                }else{
                    return Redirect::to(env('APP_URL'))->with('flash_notice', 'Error occue while adding Product')->withInput();
                }
            }
          }else{
            return view('add');
          }
    }

    public function edit($id, Request $request)
    {
        $result = $this->ProductModel->where('id',$id)->first();
        if(!empty($_POST)) {
            $input = $request->all();
            $rules= ['product_name' => 'required',
                     'product_price'=>'required|integer'
                   ];
            $validation = Validator::make($input, $rules);
            if ($validation->fails()) {
                    return Redirect::to(env('APP_URL').'product/edit/'.$id)->withErrors($validation)->withInput();
            }else {
                $update_data = $input;

                $update_data['product_name']            = (isset($update_data['product_name'])) ? $update_data['product_name'] : '';
                $update_data['product_price']           = (isset($update_data['product_price'])) ? $update_data['product_price'] : '';
                $update_data['product_description']     = (isset($update_data['product_description'])) ? $update_data['product_description'] : '';
                    
                if($_FILES) {
                    $input_img = 'images';
                    $imageArr = [];
                    $images = '';
                    if($_FILES[$input_img]['name'][0] != ""){
                        foreach($_FILES[$input_img]['name'] as $row => $value) {
                            $destination = public_path('products/').$id.'/';
                            $imgInfo = getimagesize($_FILES[$input_img]['tmp_name'][$row]);
                            $imageWidth = $imgInfo[0];
                            $imageheight = $imgInfo[1];
                            $arg = explode('.',$_FILES[$input_img]['name'][$row]);
                            $total = sizeof($arg);
                            $ext = $arg[$total-1];  
                            $raw_name = $arg[0];  
                            $name = rand().'.'.$ext;
                            if(is_dir($destination)) {
                                if(move_uploaded_file($_FILES[$input_img]['tmp_name'][$row], $destination.$name)) array_push($imageArr,$name);;
                            }else{
                                mkdir($destination, 0777, true);
                                if(move_uploaded_file($_FILES[$input_img]['tmp_name'][$row], $destination.$name)) array_push($imageArr,$name);;
                            }
                        }
                        $images = json_encode($imageArr);
                    }
                }
                unset($update_data['_token']);
                unset($update_data['images']);
                $update_data['product_images']     = (isset($images)) ? $images : '';
                $result = $this->ProductModel->where('id',$id)->update($update_data);
                if($result) {
                    return Redirect::to(env('APP_URL'))->with('flash_notice', 'Product updated successfully.')->withInput();
                }else{
                    return Redirect::to(env('APP_URL'))->with('flash_notice', 'Error occue while updating Product')->withInput();
                }
            }
          }else{
            return view('edit')->with('result', $result);
          }
    }



    public function destroy($id){
        if (isset($id) && $id != '') {
            $result     = $this->ProductModel->where('id',$id)->delete();
            return Redirect::to(env('APP_URL'))->with('flash_notice', 'Product deleted successfully.');
        }else{
            return Redirect::to(env('APP_URL'))->with('flash_notice', 'Error occure while deleteing Product.');
        }
    }

}
