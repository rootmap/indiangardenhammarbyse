<?php

namespace App\Http\Controllers;

use App\GalleryCategory;
use App\AdminLog;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Gallery Category";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=GalleryCategory::all();
        return view('admin.pages.gallerycategory.gallerycategory_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.gallerycategory.gallerycategory_create');
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
                
                'name'=>'required',
                'category_status'=>'required',
        ]);

        $this->SystemAdminLog("Gallery Category","Save New","Create New");

        
        $tab=new GalleryCategory();
        
        $tab->name=$request->name;
        $tab->category_status=$request->category_status;
        $tab->save();

        return redirect('gallerycategory')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'category_status'=>'required',
        ]);

        $tab=new GalleryCategory();
        
        $tab->name=$request->name;
        $tab->category_status=$request->category_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GalleryCategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('category_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('category_status','LIKE','%'.$search.'%');
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

    
    public function GalleryCategoryQuery($request)
    {
        $GalleryCategory_data=GalleryCategory::orderBy('id','DESC')->get();

        return $GalleryCategory_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Name','Category Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->GalleryCategoryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->name,$voi->category_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Gallery Category Report',
            'report_title'=>'Gallery Category Report',
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
                            <th class='text-center' style='font-size:12px;' >Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Category Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->GalleryCategoryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->category_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Gallery Category Report',$html);


    }
    public function show(GalleryCategory $gallerycategory)
    {
        
        $tab=GalleryCategory::all();return view('admin.pages.gallerycategory.gallerycategory_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GalleryCategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryCategory $gallerycategory,$id=0)
    {
        $tab=GalleryCategory::find($id);      
        return view('admin.pages.gallerycategory.gallerycategory_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GalleryCategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryCategory $gallerycategory,$id=0)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'category_status'=>'required',
        ]);

        $this->SystemAdminLog("Gallery Category","Update","Edit / Modify");

        
        $tab=GalleryCategory::find($id);
        
        $tab->name=$request->name;
        $tab->category_status=$request->category_status;
        $tab->save();

        return redirect('gallerycategory')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GalleryCategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryCategory $gallerycategory,$id=0)
    {
        $this->SystemAdminLog("Gallery Category","Destroy","Delete");

        $tab=GalleryCategory::find($id);
        $tab->delete();
        return redirect('gallerycategory')->with('status','Deleted Successfully !');}
}
