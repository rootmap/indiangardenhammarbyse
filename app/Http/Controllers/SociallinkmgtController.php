<?php

namespace App\Http\Controllers;

use App\SocialLinkMgt;
use App\AdminLog;
use Illuminate\Http\Request;

class SocialLinkMgtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Social Link Mgt";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=SocialLinkMgt::count();
        if($tabCount==0)
        {
            return redirect(url('sociallinkmgt/create'));
        }else{

            $tab=SocialLinkMgt::orderBy('id','DESC')->first();      
        return view('admin.pages.sociallinkmgt.sociallinkmgt_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=SocialLinkMgt::count();
        if($tabCount==0)
        {            
        return view('admin.pages.sociallinkmgt.sociallinkmgt_create');
            
        }else{

            $tab=SocialLinkMgt::orderBy('id','DESC')->first();      
        return view('admin.pages.sociallinkmgt.sociallinkmgt_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
        ]);

        $this->SystemAdminLog("Social Link Mgt","Save New","Create New");

        
        $tab=new SocialLinkMgt();
        
        $tab->facebook=$request->facebook;
        $tab->twitter=$request->twitter;
        $tab->linkin=$request->linkin;
        $tab->google_plus=$request->google_plus;
        $tab->pinterest=$request->pinterest;
        $tab->instagram=$request->instagram;
        $tab->save();

        return redirect('sociallinkmgt')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
        ]);

        $tab=new SocialLinkMgt();
        
        $tab->facebook=$request->facebook;
        $tab->twitter=$request->twitter;
        $tab->linkin=$request->linkin;
        $tab->google_plus=$request->google_plus;
        $tab->pinterest=$request->pinterest;
        $tab->instagram=$request->instagram;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialLinkMgt  $sociallinkmgt
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('facebook','LIKE','%'.$search.'%');
                            $query->orWhere('twitter','LIKE','%'.$search.'%');
                            $query->orWhere('linkin','LIKE','%'.$search.'%');
                            $query->orWhere('google_plus','LIKE','%'.$search.'%');
                            $query->orWhere('pinterest','LIKE','%'.$search.'%');
                            $query->orWhere('instagram','LIKE','%'.$search.'%');
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
                            $query->orWhere('facebook','LIKE','%'.$search.'%');
                            $query->orWhere('twitter','LIKE','%'.$search.'%');
                            $query->orWhere('linkin','LIKE','%'.$search.'%');
                            $query->orWhere('google_plus','LIKE','%'.$search.'%');
                            $query->orWhere('pinterest','LIKE','%'.$search.'%');
                            $query->orWhere('instagram','LIKE','%'.$search.'%');
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

    
    public function SocialLinkMgtQuery($request)
    {
        $SocialLinkMgt_data=SocialLinkMgt::orderBy('id','DESC')->get();

        return $SocialLinkMgt_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Facebook','Twitter','Linkin','Google Plus','Pinterest','Instagram','Created Date');
        array_push($data, $array_column);
        $inv=$this->SocialLinkMgtQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->facebook,$voi->twitter,$voi->linkin,$voi->google_plus,$voi->pinterest,$voi->instagram,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Social Link Mgt Report',
            'report_title'=>'Social Link Mgt Report',
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
                            <th class='text-center' style='font-size:12px;' >Facebook</th>
                        
                            <th class='text-center' style='font-size:12px;' >Twitter</th>
                        
                            <th class='text-center' style='font-size:12px;' >Linkin</th>
                        
                            <th class='text-center' style='font-size:12px;' >Google Plus</th>
                        
                            <th class='text-center' style='font-size:12px;' >Pinterest</th>
                        
                            <th class='text-center' style='font-size:12px;' >Instagram</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->SocialLinkMgtQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->facebook."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->twitter."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->linkin."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->google_plus."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->pinterest."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->instagram."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Social Link Mgt Report',$html);


    }
    public function show(SocialLinkMgt $sociallinkmgt)
    {
        
        $tab=SocialLinkMgt::all();return view('admin.pages.sociallinkmgt.sociallinkmgt_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialLinkMgt  $sociallinkmgt
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialLinkMgt $sociallinkmgt,$id=0)
    {
        $tab=SocialLinkMgt::find($id);      
        return view('admin.pages.sociallinkmgt.sociallinkmgt_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialLinkMgt  $sociallinkmgt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialLinkMgt $sociallinkmgt,$id=0)
    {
        $this->validate($request,[
                
        ]);

        $this->SystemAdminLog("Social Link Mgt","Update","Edit / Modify");

        
        $tab=SocialLinkMgt::find($id);
        
        $tab->facebook=$request->facebook;
        $tab->twitter=$request->twitter;
        $tab->linkin=$request->linkin;
        $tab->google_plus=$request->google_plus;
        $tab->pinterest=$request->pinterest;
        $tab->instagram=$request->instagram;
        $tab->save();

        return redirect('sociallinkmgt')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialLinkMgt  $sociallinkmgt
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialLinkMgt $sociallinkmgt,$id=0)
    {
        $this->SystemAdminLog("Social Link Mgt","Destroy","Delete");

        $tab=SocialLinkMgt::find($id);
        $tab->delete();
        return redirect('sociallinkmgt')->with('status','Deleted Successfully !');}
}
