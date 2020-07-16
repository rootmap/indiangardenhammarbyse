<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\AdminLog;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Reservation";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=Reservation::count();
        if($tabCount==0)
        {
            return redirect(url('reservation-contact/create'));
        }else{

            $tab=Reservation::orderBy('id','DESC')->first();      
        return view('admin.pages.reservation.reservation_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=Reservation::count();
        if($tabCount==0)
        {            
        return view('admin.pages.reservation.reservation_create');
            
        }else{

            $tab=Reservation::orderBy('id','DESC')->first();      
        return view('admin.pages.reservation.reservation_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'page_name'=>'required',
                'reservation_form_title'=>'required',
                'reservation_button_title'=>'required',
                'fore_ground_image'=>'required',
                'contact_form_title'=>'required',
                'contact_button_title'=>'required',
                'get_directions'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Reservation","Save New","Create New");

        

        $filename_reservation_3='';
        if ($request->hasFile('fore_ground_image')) {
            $img_reservation = $request->file('fore_ground_image');
            $upload_reservation = 'upload/reservation';
            $filename_reservation_3 = time() . '.' . $img_reservation->getClientOriginalExtension();
            $img_reservation->move($upload_reservation, $filename_reservation_3);
        }

                
        $tab=new Reservation();
        
        $tab->page_name=$request->page_name;
        $tab->reservation_form_title=$request->reservation_form_title;
        $tab->reservation_button_title=$request->reservation_button_title;
        $tab->fore_ground_image=$filename_reservation_3;
        $tab->contact_form_title=$request->contact_form_title;
        $tab->contact_button_title=$request->contact_button_title;
        $tab->get_directions=$request->get_directions;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('reservation-contact')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'page_name'=>'required',
                'reservation_form_title'=>'required',
                'reservation_button_title'=>'required',
                'fore_ground_image'=>'required',
                'contact_form_title'=>'required',
                'contact_button_title'=>'required',
                'get_directions'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new Reservation();
        
        $tab->page_name=$request->page_name;
        $tab->reservation_form_title=$request->reservation_form_title;
        $tab->reservation_button_title=$request->reservation_button_title;
        $tab->fore_ground_image=$filename_reservation_3;
        $tab->contact_form_title=$request->contact_form_title;
        $tab->contact_button_title=$request->contact_button_title;
        $tab->get_directions=$request->get_directions;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('page_name','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_form_title','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_button_title','LIKE','%'.$search.'%');
                            $query->orWhere('fore_ground_image','LIKE','%'.$search.'%');
                            $query->orWhere('contact_form_title','LIKE','%'.$search.'%');
                            $query->orWhere('contact_button_title','LIKE','%'.$search.'%');
                            $query->orWhere('get_directions','LIKE','%'.$search.'%');
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
                            $query->orWhere('page_name','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_form_title','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_button_title','LIKE','%'.$search.'%');
                            $query->orWhere('fore_ground_image','LIKE','%'.$search.'%');
                            $query->orWhere('contact_form_title','LIKE','%'.$search.'%');
                            $query->orWhere('contact_button_title','LIKE','%'.$search.'%');
                            $query->orWhere('get_directions','LIKE','%'.$search.'%');
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

    
    public function ReservationQuery($request)
    {
        $Reservation_data=Reservation::orderBy('id','DESC')->get();

        return $Reservation_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Page Name','Reservation Form Title','Reservation Button Title','Fore Ground Image','Contact Form Title','Contact Button Title','Get Directions','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->ReservationQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->page_name,$voi->reservation_form_title,$voi->reservation_button_title,$voi->fore_ground_image,$voi->contact_form_title,$voi->contact_button_title,$voi->get_directions,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Reservation Report',
            'report_title'=>'Reservation Report',
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
                            <th class='text-center' style='font-size:12px;' >Page Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Reservation Form Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Reservation Button Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Fore Ground Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact Form Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact Button Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Get Directions</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->ReservationQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->page_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->reservation_form_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->reservation_button_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->fore_ground_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_form_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_button_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->get_directions."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Reservation Report',$html);


    }
    public function show(Reservation $reservation)
    {
        
        $tab=Reservation::all();return view('admin.pages.reservation.reservation_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation,$id=0)
    {
        $tab=Reservation::find($id);      
        return view('admin.pages.reservation.reservation_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation,$id=0)
    {
        $this->validate($request,[
                
                'page_name'=>'required',
                'reservation_form_title'=>'required',
                'reservation_button_title'=>'required',
                'contact_form_title'=>'required',
                'contact_button_title'=>'required',
                'get_directions'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Reservation","Update","Edit / Modify");

        

        $filename_reservation_3=$request->ex_fore_ground_image;
        if ($request->hasFile('fore_ground_image')) {
            $img_reservation = $request->file('fore_ground_image');
            $upload_reservation = 'upload/reservation';
            $filename_reservation_3 = time() . '.' . $img_reservation->getClientOriginalExtension();
            $img_reservation->move($upload_reservation, $filename_reservation_3);
        }

                
        $tab=Reservation::find($id);
        
        $tab->page_name=$request->page_name;
        $tab->reservation_form_title=$request->reservation_form_title;
        $tab->reservation_button_title=$request->reservation_button_title;
        $tab->fore_ground_image=$filename_reservation_3;
        $tab->contact_form_title=$request->contact_form_title;
        $tab->contact_button_title=$request->contact_button_title;
        $tab->get_directions=$request->get_directions;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('reservation-contact')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation,$id=0)
    {
        $this->SystemAdminLog("Reservation","Destroy","Delete");

        $tab=Reservation::find($id);
        $tab->delete();
        return redirect('reservation-contact')->with('status','Deleted Successfully !');}
}
