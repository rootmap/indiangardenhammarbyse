<?php

namespace App\Http\Controllers;

use App\WeAreOpen;
use App\AdminLog;
use Illuminate\Http\Request;

class WeAreOpenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="We Are Open";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=WeAreOpen::count();
        if($tabCount==0)
        {
            return redirect(url('weareopen/create'));
        }else{

            $tab=WeAreOpen::orderBy('id','DESC')->first();      
        return view('admin.pages.weareopen.weareopen_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=WeAreOpen::count();
        if($tabCount==0)
        {            
        return view('admin.pages.weareopen.weareopen_create');
            
        }else{

            $tab=WeAreOpen::orderBy('id','DESC')->first();      
        return view('admin.pages.weareopen.weareopen_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                'first_box_icon'=>'required',
                'first_box_heading'=>'required',
                'first_box_sub_heading'=>'required',
                'second_box_icon'=>'required',
                'second_box_heading'=>'required',
                'second_box_sub_heading'=>'required',
                'third_box_icon'=>'required',
                'third_box_heading'=>'required',
                'third_box_sub_heading'=>'required',
        ]);

        $this->SystemAdminLog("We Are Open","Save New","Create New");

        
        $tab=new WeAreOpen();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->first_box_icon=$request->first_box_icon;
        $tab->first_box_heading=$request->first_box_heading;
        $tab->first_box_sub_heading=$request->first_box_sub_heading;
        $tab->second_box_icon=$request->second_box_icon;
        $tab->second_box_heading=$request->second_box_heading;
        $tab->second_box_sub_heading=$request->second_box_sub_heading;
        $tab->third_box_icon=$request->third_box_icon;
        $tab->third_box_heading=$request->third_box_heading;
        $tab->third_box_sub_heading=$request->third_box_sub_heading;
        $tab->save();

        return redirect('weareopen')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'first_box_icon'=>'required',
                'first_box_heading'=>'required',
                'first_box_sub_heading'=>'required',
                'second_box_icon'=>'required',
                'second_box_heading'=>'required',
                'second_box_sub_heading'=>'required',
                'third_box_icon'=>'required',
                'third_box_heading'=>'required',
                'third_box_sub_heading'=>'required',
        ]);

        $tab=new WeAreOpen();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->first_box_icon=$request->first_box_icon;
        $tab->first_box_heading=$request->first_box_heading;
        $tab->first_box_sub_heading=$request->first_box_sub_heading;
        $tab->second_box_icon=$request->second_box_icon;
        $tab->second_box_heading=$request->second_box_heading;
        $tab->second_box_sub_heading=$request->second_box_sub_heading;
        $tab->third_box_icon=$request->third_box_icon;
        $tab->third_box_heading=$request->third_box_heading;
        $tab->third_box_sub_heading=$request->third_box_sub_heading;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WeAreOpen  $weareopen
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('first_box_icon','LIKE','%'.$search.'%');
                            $query->orWhere('first_box_heading','LIKE','%'.$search.'%');
                            $query->orWhere('first_box_sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('second_box_icon','LIKE','%'.$search.'%');
                            $query->orWhere('second_box_heading','LIKE','%'.$search.'%');
                            $query->orWhere('second_box_sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('third_box_icon','LIKE','%'.$search.'%');
                            $query->orWhere('third_box_heading','LIKE','%'.$search.'%');
                            $query->orWhere('third_box_sub_heading','LIKE','%'.$search.'%');
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
                            $query->orWhere('first_box_icon','LIKE','%'.$search.'%');
                            $query->orWhere('first_box_heading','LIKE','%'.$search.'%');
                            $query->orWhere('first_box_sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('second_box_icon','LIKE','%'.$search.'%');
                            $query->orWhere('second_box_heading','LIKE','%'.$search.'%');
                            $query->orWhere('second_box_sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('third_box_icon','LIKE','%'.$search.'%');
                            $query->orWhere('third_box_heading','LIKE','%'.$search.'%');
                            $query->orWhere('third_box_sub_heading','LIKE','%'.$search.'%');
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

    
    public function WeAreOpenQuery($request)
    {
        $WeAreOpen_data=WeAreOpen::orderBy('id','DESC')->get();

        return $WeAreOpen_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Heading','Sub Heading','First Box Icon','First Box Heading','First Box Sub Heading','Second Box Icon','Second Box Heading','Second Box Sub Heading','Third Box Icon','Third Box Heading','Third Box Sub Heading','Created Date');
        array_push($data, $array_column);
        $inv=$this->WeAreOpenQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->heading,$voi->sub_heading,$voi->first_box_icon,$voi->first_box_heading,$voi->first_box_sub_heading,$voi->second_box_icon,$voi->second_box_heading,$voi->second_box_sub_heading,$voi->third_box_icon,$voi->third_box_heading,$voi->third_box_sub_heading,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'We Are Open Report',
            'report_title'=>'We Are Open Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >First Box Icon</th>
                        
                            <th class='text-center' style='font-size:12px;' >First Box Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >First Box Sub Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Second Box Icon</th>
                        
                            <th class='text-center' style='font-size:12px;' >Second Box Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Second Box Sub Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Third Box Icon</th>
                        
                            <th class='text-center' style='font-size:12px;' >Third Box Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Third Box Sub Heading</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->WeAreOpenQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->first_box_icon."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->first_box_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->first_box_sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->second_box_icon."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->second_box_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->second_box_sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->third_box_icon."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->third_box_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->third_box_sub_heading."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('We Are Open Report',$html);


    }
    public function show(WeAreOpen $weareopen)
    {
        
        $tab=WeAreOpen::all();return view('admin.pages.weareopen.weareopen_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WeAreOpen  $weareopen
     * @return \Illuminate\Http\Response
     */
    public function edit(WeAreOpen $weareopen,$id=0)
    {
        $tab=WeAreOpen::find($id);      
        return view('admin.pages.weareopen.weareopen_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WeAreOpen  $weareopen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeAreOpen $weareopen,$id=0)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'first_box_icon'=>'required',
                'first_box_heading'=>'required',
                'first_box_sub_heading'=>'required',
                'second_box_icon'=>'required',
                'second_box_heading'=>'required',
                'second_box_sub_heading'=>'required',
                'third_box_icon'=>'required',
                'third_box_heading'=>'required',
                'third_box_sub_heading'=>'required',
        ]);

        $this->SystemAdminLog("We Are Open","Update","Edit / Modify");

        $filename=$request->ex_backdroung_image;
        if ($request->hasFile('background_image')) {
            $img = $request->file('background_image');
            $upload = 'upload/weareopen';
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move($upload, $filename);
        }
        
        $tab=WeAreOpen::find($id);
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->first_box_icon=$request->first_box_icon;
        $tab->first_box_heading=$request->first_box_heading;
        $tab->first_box_sub_heading=$request->first_box_sub_heading;
        $tab->second_box_icon=$request->second_box_icon;
        $tab->second_box_heading=$request->second_box_heading;
        $tab->second_box_sub_heading=$request->second_box_sub_heading;
        $tab->third_box_icon=$request->third_box_icon;
        $tab->third_box_heading=$request->third_box_heading;
        $tab->third_box_sub_heading=$request->third_box_sub_heading;
        $tab->background_image=$filename;
        $tab->save();

        return redirect('weareopen')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeAreOpen  $weareopen
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeAreOpen $weareopen,$id=0)
    {
        $this->SystemAdminLog("We Are Open","Destroy","Delete");

        $tab=WeAreOpen::find($id);
        $tab->delete();
        return redirect('weareopen')->with('status','Deleted Successfully !');}
}
