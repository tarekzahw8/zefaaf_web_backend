<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailySteps;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{

    
    function __construct(DailySteps $model){
        $this->model = $model;
        $this->view = 'statistics';
        $view = 'statistics';
        $route = 'statistics';
        $OtherRoute = 'statistic';
        view()->share(compact('view','route','OtherRoute'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$users = User::where('account_type','0')->latest()->paginate(10);

        $collection = $this->model->latest()->paginate(10);
        return view("admin.$this->view.index",compact('collection'));

    }

    public function search( Request $request )
    {
        $query =  $request->q;
        
        if ( $query == "") {
            return redirect()->back();
        }else{

            

             $collection   = $this->model->where([['step_date', 'LIKE', '%' . $query. '%']] )
                                     ->orWhere([['distance', 'LIKE', '%' . $query. '%']] )
                                     ->orWhere([['calories', 'LIKE', '%' . $query. '%']] )
                                     ->orWhere([['coins', 'LIKE', '%' . $query. '%']] )
                                     ->orWhere([['step_time', 'LIKE', '%' . $query. '%']] )
                                     ->ORwhereHas('user', function($q) use($query){
                                        $q->where('name', 'LIKE', '%' . $query. '%');
                                    })
                                     ->latest()->paginate(10);
            $collection->appends( ['q' => $request->q] );

            if (count ( $collection ) > 0){
                return view("admin.$this->view.index",[ 'collection' => $collection ])->withQuery($query);
            }else{
                return view("admin.$this->view.index",[ 'collection'=>null ,'message' => __('admin.no_result') ]);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       
    }




}
