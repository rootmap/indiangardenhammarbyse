<?php

namespace App\Http\Controllers;

use App\HomeOrderDelivery;
use App\AdminLog;
use Illuminate\Http\Request;

class HomeOrderDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Home Order Delivery";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=HomeOrderDelivery::count();
        if($tabCount==0)
        {
            return redirect(url('homeorderdelivery/create'));
        }else{

            $tab=HomeOrderDelivery::orderBy('id','DESC')->first();      
        return view('admin.pages.homeorderdelivery.homeorderdelivery_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=HomeOrderDelivery::count();
        if($tabCount==0)
        {            
        return view('admin.pages.homeorderdelivery.homeorderdelivery_create');
            
        }else{

            $tab=HomeOrderDelivery::orderBy('id','DESC')->first();      
        return view('admin.pages.homeorderdelivery.homeorderdelivery_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                'first_icon'=>'required',
                'first_icon_text'=>'required',
                'second_icon'=>'required',
                'second_icon_text'=>'required',
                'third_icon'=>'required',
                'third_icon_text'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Home Order Delivery","Save New","Create New");

        
        $tab=new HomeOrderDelivery();
        
        $tab->heading=$request->heading;
        $tab->first_icon=$request->first_icon;
        $tab->first_icon_text=$request->first_icon_text;
        $tab->second_icon=$request->second_icon;
        $tab->second_icon_text=$request->second_icon_text;
        $tab->third_icon=$request->third_icon;
        $tab->third_icon_text=$request->third_icon_text;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('homeorderdelivery')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'first_icon'=>'required',
                'first_icon_text'=>'required',
                'second_icon'=>'required',
                'second_icon_text'=>'required',
                'third_icon'=>'required',
                'third_icon_text'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new HomeOrderDelivery();
        
        $tab->heading=$request->heading;
        $tab->first_icon=$request->first_icon;
        $tab->first_icon_text=$request->first_icon_text;
        $tab->second_icon=$request->second_icon;
        $tab->second_icon_text=$request->second_icon_text;
        $tab->third_icon=$request->third_icon;
        $tab->third_icon_text=$request->third_icon_text;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeOrderDelivery  $homeorderdelivery
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('first_icon','LIKE','%'.$search.'%');
                            $query->orWhere('first_icon_text','LIKE','%'.$search.'%');
                            $query->orWhere('second_icon','LIKE','%'.$search.'%');
                            $query->orWhere('second_icon_text','LIKE','%'.$search.'%');
                            $query->orWhere('third_icon','LIKE','%'.$search.'%');
                            $query->orWhere('third_icon_text','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('first_icon','LIKE','%'.$search.'%');
                            $query->orWhere('first_icon_text','LIKE','%'.$search.'%');
                            $query->orWhere('second_icon','LIKE','%'.$search.'%');
                            $query->orWhere('second_icon_text','LIKE','%'.$search.'%');
                            $query->orWhere('third_icon','LIKE','%'.$search.'%');
                            $query->orWhere('third_icon_text','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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

    
    public function HomeOrderDeliveryQuery($request)
    {
        $HomeOrderDelivery_data=HomeOrderDelivery::orderBy('id','DESC')->get();

        return $HomeOrderDelivery_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Heading','First Icon','First Icon Text','Second Icon','Second Icon Text','Third Icon','Third Icon Text','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->HomeOrderDeliveryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->heading,$voi->first_icon,$voi->first_icon_text,$voi->second_icon,$voi->second_icon_text,$voi->third_icon,$voi->third_icon_text,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Home Order Delivery Report',
            'report_title'=>'Home Order Delivery Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >First Icon</th>
                        
                            <th class='text-center' style='font-size:12px;' >First Icon Text</th>
                        
                            <th class='text-center' style='font-size:12px;' >Second Icon</th>
                        
                            <th class='text-center' style='font-size:12px;' >Second Icon Text</th>
                        
                            <th class='text-center' style='font-size:12px;' >Third Icon</th>
                        
                            <th class='text-center' style='font-size:12px;' >Third Icon Text</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->HomeOrderDeliveryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->first_icon."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->first_icon_text."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->second_icon."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->second_icon_text."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->third_icon."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->third_icon_text."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Home Order Delivery Report',$html);


    }
    public function show(HomeOrderDelivery $homeorderdelivery)
    {
        
        $tab=HomeOrderDelivery::all();return view('admin.pages.homeorderdelivery.homeorderdelivery_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeOrderDelivery  $homeorderdelivery
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeOrderDelivery $homeorderdelivery,$id=0)
    {
        $tab=HomeOrderDelivery::find($id);      
        return view('admin.pages.homeorderdelivery.homeorderdelivery_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeOrderDelivery  $homeorderdelivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeOrderDelivery $homeorderdelivery,$id=0)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'first_icon'=>'required',
                'first_icon_text'=>'required',
                'second_icon'=>'required',
                'second_icon_text'=>'required',
                'third_icon'=>'required',
                'third_icon_text'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Home Order Delivery","Update","Edit / Modify");

        
        $tab=HomeOrderDelivery::find($id);
        
        $tab->heading=$request->heading;
        $tab->first_icon=$request->first_icon;
        $tab->first_icon_text=$request->first_icon_text;
        $tab->second_icon=$request->second_icon;
        $tab->second_icon_text=$request->second_icon_text;
        $tab->third_icon=$request->third_icon;
        $tab->third_icon_text=$request->third_icon_text;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('homeorderdelivery')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeOrderDelivery  $homeorderdelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeOrderDelivery $homeorderdelivery,$id=0)
    {
        $this->SystemAdminLog("Home Order Delivery","Destroy","Delete");

        $tab=HomeOrderDelivery::find($id);
        $tab->delete();
        return redirect('homeorderdelivery')->with('status','Deleted Successfully !');}
}
