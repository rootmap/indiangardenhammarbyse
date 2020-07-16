<?php

namespace App\Http\Controllers;

use App\HomeDelivery;
use App\AdminLog;
use Illuminate\Http\Request;

class HomeDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Home Delivery";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=HomeDelivery::count();
        if($tabCount==0)
        {
            return redirect(url('homedelivery/create'));
        }else{

            $tab=HomeDelivery::orderBy('id','DESC')->first();      
        return view('admin.pages.homedelivery.homedelivery_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=HomeDelivery::count();
        if($tabCount==0)
        {            
        return view('admin.pages.homedelivery.homedelivery_create');
            
        }else{

            $tab=HomeDelivery::orderBy('id','DESC')->first();      
        return view('admin.pages.homedelivery.homedelivery_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                'first_logo'=>'required',
                'second_logo'=>'required',
                'third_logo'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Home Delivery","Save New","Create New");

        

        $filename_homedelivery_1='';
        if ($request->hasFile('first_logo')) {
            $img_homedelivery_1 = $request->file('first_logo');
            $upload_homedelivery_1 = 'upload/homedelivery';
            $filename_homedelivery_1 = time() . '.' . $img_homedelivery_1->getClientOriginalExtension();
            $img_homedelivery_1->move($upload_homedelivery_1, $filename_homedelivery_1);
        }

                

        $filename_homedelivery_3='';
        if ($request->hasFile('second_logo')) {
            $img_homedelivery_3 = $request->file('second_logo');
            $upload_homedelivery_3 = 'upload/homedelivery';
            $filename_homedelivery_3 = time() . '.' . $img_homedelivery_3->getClientOriginalExtension();
            $img_homedelivery_3->move($upload_homedelivery_3, $filename_homedelivery_3);
        }

                

        $filename_homedelivery_5='';
        if ($request->hasFile('third_logo')) {
            $img_homedelivery_5 = $request->file('third_logo');
            $upload_homedelivery_5 = 'upload/homedelivery';
            $filename_homedelivery_5 = time() . '.' . $img_homedelivery_5->getClientOriginalExtension();
            $img_homedelivery_5->move($upload_homedelivery_5, $filename_homedelivery_5);
        }

                
        $tab=new HomeDelivery();
        
        $tab->heading=$request->heading;
        $tab->first_logo=$filename_homedelivery_1;
        $tab->first_logo_link=$request->first_logo_link;
        $tab->second_logo=$filename_homedelivery_3;
        $tab->second_logo_link=$request->second_logo_link;
        $tab->third_logo=$filename_homedelivery_5;
        $tab->third_logo_link=$request->third_logo_link;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('homedelivery')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'first_logo'=>'required',
                'second_logo'=>'required',
                'third_logo'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new HomeDelivery();
        
        $tab->heading=$request->heading;
        $tab->first_logo=$filename_homedelivery_1;
        $tab->first_logo_link=$request->first_logo_link;
        $tab->second_logo=$filename_homedelivery_3;
        $tab->second_logo_link=$request->second_logo_link;
        $tab->third_logo=$filename_homedelivery_5;
        $tab->third_logo_link=$request->third_logo_link;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('first_logo','LIKE','%'.$search.'%');
                            $query->orWhere('first_logo_link','LIKE','%'.$search.'%');
                            $query->orWhere('second_logo','LIKE','%'.$search.'%');
                            $query->orWhere('second_logo_link','LIKE','%'.$search.'%');
                            $query->orWhere('third_logo','LIKE','%'.$search.'%');
                            $query->orWhere('third_logo_link','LIKE','%'.$search.'%');
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
                            $query->orWhere('first_logo','LIKE','%'.$search.'%');
                            $query->orWhere('first_logo_link','LIKE','%'.$search.'%');
                            $query->orWhere('second_logo','LIKE','%'.$search.'%');
                            $query->orWhere('second_logo_link','LIKE','%'.$search.'%');
                            $query->orWhere('third_logo','LIKE','%'.$search.'%');
                            $query->orWhere('third_logo_link','LIKE','%'.$search.'%');
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

    
    public function HomeDeliveryQuery($request)
    {
        $HomeDelivery_data=HomeDelivery::orderBy('id','DESC')->get();

        return $HomeDelivery_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Heading','First Logo','First Logo Link','Second Logo','Second Logo Link','Third Logo','Third Logo Link','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->HomeDeliveryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->heading,$voi->first_logo,$voi->first_logo_link,$voi->second_logo,$voi->second_logo_link,$voi->third_logo,$voi->third_logo_link,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Home Delivery Report',
            'report_title'=>'Home Delivery Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >First Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >First Logo Link</th>
                        
                            <th class='text-center' style='font-size:12px;' >Second Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Second Logo Link</th>
                        
                            <th class='text-center' style='font-size:12px;' >Third Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Third Logo Link</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->HomeDeliveryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->first_logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->first_logo_link."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->second_logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->second_logo_link."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->third_logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->third_logo_link."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Home Delivery Report',$html);


    }
    public function show(HomeDelivery $homedelivery)
    {
        
        $tab=HomeDelivery::all();return view('admin.pages.homedelivery.homedelivery_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeDelivery $homedelivery,$id=0)
    {
        $tab=HomeDelivery::find($id);      
        return view('admin.pages.homedelivery.homedelivery_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeDelivery $homedelivery,$id=0)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Home Delivery","Update","Edit / Modify");

        

        $filename_homedelivery_1=$request->ex_first_logo;
        if ($request->hasFile('first_logo')) {
            $first_logo_1 = $request->file('first_logo');
            $upload_homedelivery_1 = 'upload/homedelivery';
            $filename_homedelivery_1 = time() . '.' . $first_logo_1->getClientOriginalExtension();
            $first_logo_1->move($upload_homedelivery_1, $filename_homedelivery_1);
        }

                

        $filename_homedelivery_3=$request->ex_second_logo;
        if ($request->hasFile('second_logo')) {
            $second_logo = $request->file('second_logo');
            $upload_homedelivery_3 = 'upload/homedelivery';
            $filename_homedelivery_3 = time() . '.' . $second_logo->getClientOriginalExtension();
            $second_logo->move($upload_homedelivery_3, $filename_homedelivery_3);
        }

                

        $filename_homedelivery_5=$request->ex_third_logo;
        if ($request->hasFile('third_logo')) {
            $third_logo_5 = $request->file('third_logo');
            $upload_homedelivery_5 = 'upload/homedelivery';
            $filename_homedelivery_5 = time() . '.' . $third_logo_5->getClientOriginalExtension();
            $third_logo_5->move($upload_homedelivery_5, $filename_homedelivery_5);
        }

        //dd($filename_homedelivery_5);
                
        $tab=HomeDelivery::find($id);
        
        $tab->heading=$request->heading;
        $tab->first_logo=$filename_homedelivery_1;
        $tab->first_logo_link=$request->first_logo_link;
        $tab->second_logo=$filename_homedelivery_3;
        $tab->second_logo_link=$request->second_logo_link;
        $tab->third_logo=$filename_homedelivery_5;
        $tab->third_logo_link=$request->third_logo_link;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('homedelivery')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeDelivery $homedelivery,$id=0)
    {
        $this->SystemAdminLog("Home Delivery","Destroy","Delete");

        $tab=HomeDelivery::find($id);
        $tab->delete();
        return redirect('homedelivery')->with('status','Deleted Successfully !');}
}
