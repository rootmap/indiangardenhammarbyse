<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\AdminLog;
use Auth;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Blogs";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=Blogs::all();
        return view('admin.pages.blogs.blogs_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('admin.pages.blogs.blogs_create');
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
                
                'title'=>'required',
                'image'=>'required',
                'details'=>'required',
        ]);

        $this->SystemAdminLog("Blogs","Save New","Create New");

        

        $filename_blogs_3='';
        if ($request->hasFile('image')) {
            $img_blogs = $request->file('image');
            $upload_blogs = 'upload/blogs';
            $filename_blogs_3 = time() . '.' . $img_blogs->getClientOriginalExtension();
            $img_blogs->move($upload_blogs, $filename_blogs_3);
        }

                
        $tab=new Blogs();
        
        $tab->title=$request->title;
        $tab->post_by=Auth::user()->name;
        $tab->total_view=$request->total_view;
        $tab->image=$filename_blogs_3;
        $tab->details=$request->details;
        $tab->save();

        return redirect('blogs')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'title'=>'required',
                'image'=>'required',
                'details'=>'required',
        ]);

        $tab=new Blogs();
        
        $tab->title=$request->title;
        $tab->post_by=Auth::user()->name;
        $tab->total_view=$request->total_view;
        $tab->image=$filename_blogs_3;
        $tab->details=$request->details;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('title','LIKE','%'.$search.'%');
                            $query->orWhere('post_by','LIKE','%'.$search.'%');
                            $query->orWhere('total_view','LIKE','%'.$search.'%');
                            $query->orWhere('image','LIKE','%'.$search.'%');
                            $query->orWhere('details','LIKE','%'.$search.'%');
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
                            $query->orWhere('title','LIKE','%'.$search.'%');
                            $query->orWhere('post_by','LIKE','%'.$search.'%');
                            $query->orWhere('total_view','LIKE','%'.$search.'%');
                            $query->orWhere('image','LIKE','%'.$search.'%');
                            $query->orWhere('details','LIKE','%'.$search.'%');
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

    
    public function BlogsQuery($request)
    {
        $Blogs_data=Blogs::orderBy('id','DESC')->get();

        return $Blogs_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Title','Post By','Total view','Image','Details','Created Date');
        array_push($data, $array_column);
        $inv=$this->BlogsQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->title,$voi->post_by,$voi->total_view,$voi->image,$voi->details,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Blogs Report',
            'report_title'=>'Blogs Report',
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
                            <th class='text-center' style='font-size:12px;' >Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Post By</th>
                        
                            <th class='text-center' style='font-size:12px;' >Total view</th>
                        
                            <th class='text-center' style='font-size:12px;' >Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Details</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->BlogsQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->post_by."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->total_view."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->details."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Blogs Report',$html);


    }
    public function show(Blogs $blogs)
    {
        
        $tab=Blogs::all();return view('admin.pages.blogs.blogs_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs $blogs,$id=0)
    {
        $tab=Blogs::find($id);      
        return view('admin.pages.blogs.blogs_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogs $blogs,$id=0)
    {
        $this->validate($request,[
                
                'title'=>'required',
                'details'=>'required',
        ]);

        $this->SystemAdminLog("Blogs","Update","Edit / Modify");

        

        $filename_blogs_3=$request->ex_image;
        if ($request->hasFile('image')) {
            $img_blogs = $request->file('image');
            $upload_blogs = 'upload/blogs';
            $filename_blogs_3 = time() . '.' . $img_blogs->getClientOriginalExtension();
            $img_blogs->move($upload_blogs, $filename_blogs_3);
        }

                
        $tab=Blogs::find($id);
        
        $tab->title=$request->title;
        $tab->post_by=Auth::user()->name;
        $tab->total_view=$request->total_view;
        $tab->image=$filename_blogs_3;
        $tab->details=$request->details;
        $tab->save();

        return redirect('blogs')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogs $blogs,$id=0)
    {
        $this->SystemAdminLog("Blogs","Destroy","Delete");

        $tab=Blogs::find($id);
        $tab->delete();
        return redirect('blogs')->with('status','Deleted Successfully !');}
}
