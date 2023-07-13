<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;

class ChatbotController extends Controller
{
    public function index(){
        $chatbot =Chatbot::all();
        $url="127.0.0.1:8000";
        foreach ($chatbot as $data) {
           $url=$data->url;
        }
         $final_url = "var FreeScoutW={s:{\"color\":\"#0068bd\",\"position\":\"br\",\"id\":2414451153}};(function(d,e,s){if(d.getElementById(\"freescout-w\"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id=\"freescout-w\";a.src=s;m.parentNode.insertBefore(a, m)})(document,\"script\",\"http://$url/modules/enduserportal/js/widget.js?v=1083\")";
            return view('chatbot',compact('final_url','url'));
    }

    public function addUrl(Request $request){
        $chatbot = new Chatbot();
        $url=$request->urls;
        $chatbot->url=$url;
        $chatbot->save();
        return redirect("/chatbot/url");
    }
}
