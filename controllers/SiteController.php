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
    // le  seul argument qu'accepte  ces action est la class request  check   call_user_func($callback,$this->request) in router
    public  function handleSubmit(Request $request){
        var_dump($request->getBody());
        return 'Handlint Submited  Data';
    }
}