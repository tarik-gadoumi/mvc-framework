<?php
namespace app\controllers ;
use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public  function home(){
        $name = [
            'name'=>'Tarik Gadoumi'
        ];
        return  $this->render('home',$name);
    }
    public  function contact(){
        return   $this->render('contact');
    }
    public  function handleSubmit(Request $request){
        var_dump($request->getBody());
        return 'Handlint Submited  Data';
    }
}