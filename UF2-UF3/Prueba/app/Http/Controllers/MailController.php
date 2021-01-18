<?php

namespace App\Http\Controllers; 

use Mail;
use Illuminate\Http\Request;
use App\Mail\CloudHostingProduct;

class MailController extends Controller
{
    public function mail() {
        $name = 'Correo';
        Mail::to('kchaflam@fp.insjoaquimmir.cat')->send(new CloudHostingProduct($name));
        return 'Email sent Successfully';
    }
}
