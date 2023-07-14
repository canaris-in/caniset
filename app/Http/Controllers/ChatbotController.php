<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;

class ChatbotController extends Controller
{
    public function index(){
        $chatbot =Chatbot::all();
        $urls = $chatbot->pluck('url');
        $url = $urls->first();
        $final_url = "var FreeScoutW={s:{\"color\":\"#0068bd\",\"position\":\"bl\",\"id\":3427502676}};(function(d,e,s){if(d.getElementById(\"freescout-w\"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id=\"freescout-w\";a.src=s;m.parentNode.insertBefore(a, m)})(document,\"script\",\"https://$url/modules/enduserportal/js/widget.js?v=7516\")";
            return view('chatbot',compact('final_url','url'));
    }

    public function addUrl(Request $request){
        $chatbot = new Chatbot();
        $url=$request->urls;
        $chatbot->where('id', '1')->update(['url' => $url]);
        return redirect("/chatbot/url");
    }
}
