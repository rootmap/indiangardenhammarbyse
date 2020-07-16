<?php

namespace App\Http\Controllers;

use App\HomePageVideo;
use App\AdminLog;
use Illuminate\Http\Request;

class HomePageVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Home Page Video";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=HomePageVideo::count();
        if($tabCount==0)
        {
            return redirect(url('homepagevideo/create'));
        }else{

            $tab=HomePageVideo::orderBy('id','DESC')->first();      
        return view('admin.pages.homepagevideo.homepagevideo_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=HomePageVideo::count();
        if($tabCount==0)
        {            
        return view('admin.pages.homepagevideo.homepagevideo_create');
            
        }else{

            $tab=HomePageVideo::orderBy('id','DESC')->first();      
        return view('admin.pages.homepagevideo.homepagevideo_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function SystemAdminLog($module_name="",$action="",$details=""){
        $tab=new AdminLog();
        $tab->module_name=$module_name;
        $tab->action=$action;
        $tab->details=$details;
        $tab->admin_id=$this->sdc->admin_id();
        $tab->admin_name=$this->sdc->UserName();
        $tab->save();
    }


    public function store(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'vimeo_video_url'=>'required',
        ]);

        $this->SystemAdminLog("Home Page Video","Save New","Create New");

        
        $tab=new HomePageVideo();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->vimeo_video_url=$request->vimeo_video_url;
        $tab->save();

        return redirect('homepagevideo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'vimeo_video_url'=>'required',
        ]);

        $tab=new HomePageVideo();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->vimeo_video_url=$request->vimeo_video_url;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomePageVideo  $homepagevideo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('vimeo_video_url','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->count();
        return $tab;
    }


    private function methodToGetMembers($start, $length,$search=''){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('vimeo_video_url','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }

    public function datatable(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
        $members = $this->methodToGetMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    
    public function HomePageVideoQuery($request)
    {
        $HomePageVideo_data=HomePageVideo::orderBy('id','DESC')->get();

        return $HomePageVideo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Heading','Sub Heading','Vimeo Video URL','Created Date');
        array_push($data, $array_column);
        $inv=$this->HomePageVideoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->heading,$voi->sub_heading,$voi->vimeo_video_url,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Home Page Video Report',
            'report_title'=>'Home Page Video Report',
            'report_description'=>'Report Genarated : '.$dataDateTimeIns,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function ExportPDF(Request $request)
    {

        $html="<table class='table table-bordered' style='width:100%;'>
                <thead>
                <tr>
                <th class='text-center' style='font-size:12px;'>ID</th>
                            <th class='text-center' style='font-size:12px;' >Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Sub Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Vimeo Video URL</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->HomePageVideoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->vimeo_video_url."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Home Page Video Report',$html);


    }
    public function show(HomePageVideo $homepagevideo)
    {
        
        $tab=HomePageVideo::all();return view('admin.pages.homepagevideo.homepagevideo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomePageVideo  $homepagevideo
     * @return \Illuminate\Http\Response
     */
    public function edit(HomePageVideo $homepagevideo,$id=0)
    {
        $tab=HomePageVideo::find($id);      
        return view('admin.pages.homepagevideo.homepagevideo_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomePageVideo  $homepagevideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomePageVideo $homepagevideo,$id=0)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'vimeo_video_url'=>'required',
        ]);

        $this->SystemAdminLog("Home Page Video","Update","Edit / Modify");

        
        $tab=HomePageVideo::find($id);
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->vimeo_video_url=$request->vimeo_video_url;
        $tab->save();

        return redirect('homepagevideo')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomePageVideo  $homepagevideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomePageVideo $homepagevideo,$id=0)
    {
        $this->SystemAdminLog("Home Page Video","Destroy","Delete");

        $tab=HomePageVideo::find($id);
        $tab->delete();
        return redirect('homepagevideo')->with('status','Deleted Successfully !');}
}
