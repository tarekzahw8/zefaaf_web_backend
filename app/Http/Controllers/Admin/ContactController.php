<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;
use App\Mail\TestEmail;
use App\Http\Requests\Admin\Contacts\EditContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = ContactUs::latest()->paginate(10);
        return view('admin.contact.index',compact('list'));
    }

    public function search( Request $request )
    {
        $query =  $request->q;

        if ( $query == "") {
            return redirect()->back();
        }else{

             /*$users   = User::where([['name', 'LIKE', '%' . $query. '%'],
                                            ['account_type','0']] )
                                     ->orWhere([['phone', 'LIKE', '%' . $query. '%'],
                                        ['account_type','0']] )*/

             $list   = ContactUs::where('name', 'LIKE', '%' . $query. '%')
                                ->orWhere('email', 'LIKE', '%' . $query. '%')
                                ->orWhere('phone', 'LIKE', '%' . $query. '%')
                                ->orWhere('message', 'LIKE', '%' . $query. '%')
                                ->ORwhereHas('types', function($q) use($query){
                                    $q->where('title', 'LIKE', '%' . $query. '%');
                                })->latest()->paginate(10);
             $list->appends( ['q' => $request->q] );

            if (count ( $list ) > 0){
                return view('admin.contact.index',[ 'list' => $list ])->withQuery($query);
            }else{
                return view('admin.contact.index',[ 'list'=>null ,'message' => __('admin.no_result') ]);
            }
            //dd($users);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $row = ContactUs::find($id);
        //dd($row);
        return view('admin.contact.show',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $row = ContactUs::find($id);
        //dd($row);
        return view('admin.contact.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditContactRequest $request, $id)
    {
        //
        $request->persist($id);

        $row = ContactUs::find($id);
        //$txt = "<p> رسالتك هى : $row->message </p> </br/> <p> $row->admin_reply </p>";
        $data = ['message' => $row->admin_reply,'view' => 'email.contact_mail','subject'=>'رسالة التواصل - تطبيق إياس','txt'=>$row->message];
        //\Mail::to($row->email)->send(new TestEmail($data));
        try{
			\Mail::to($row->email)->send(new TestEmail($data));
		}
		catch(\Exception $e){


            $subject = 'بريد الكترونى من اياس';

            $headers = "From: info@eyasapp.com \r\n";
            $headers .= "Reply-To: info@eyasapp.com \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $message = '<!DOCTYPE html>
            <html lang="en-US">
                <head>
                    <meta charset="utf-8">
                </head>
                <body>
                <h4>رسالتك هى : '.$row->message.' </h4>
                <br />
                <h2>
                الرد : 	`.$row->admin_reply.`
                </h2>
                </body>
            </html>
            ';


            mail($row->email, $subject, $message, $headers);
        }
        return redirect()->back()->with('status' , __('admin.updated') );



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if ($request->ajax()) {
            ContactUs::find($id)->delete();
            return response(['msg' => 'deleted', 'status' => 'success']);
        }
    }
}
