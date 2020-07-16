<?php

namespace App\Http\Controllers;

use App\MenuItem;
use App\AdminLog;
use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
                

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Menu Item";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=MenuItem::all();
        return view('admin.pages.menuitem.menuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $tab_Category=Category::all();           
        $tab_SubCategory=SubCategory::select('id','category_id','category_id_name','name')->get();           
        return view('admin.pages.menuitem.menuitem_create',['dataRow_Category'=>$tab_Category,'SubCategory'=>$tab_SubCategory]);
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
                
                'category'=>'required',
                'sub_category'=>'required',
                'name'=>'required',
                'price'=>'required',
        ]);

        $this->SystemAdminLog("Menu Item","Save New","Create New");

        
        $tab_0_Category=Category::where('id',$request->category)->first();
        $category_0_Category=$tab_0_Category->name;
        
        $tab_0_SubCategory=SubCategory::where('id',$request->sub_category)->first();
        $category_0_SubCategory=$tab_0_SubCategory->name;

        $filename_menuitem_4='';
        if ($request->hasFile('menu_item_image')) {
            $img_menuitem = $request->file('menu_item_image');
            $upload_menuitem = 'upload/menuitem';
            $filename_menuitem_4 = time() . '.' . $img_menuitem->getClientOriginalExtension();
            $img_menuitem->move($upload_menuitem, $filename_menuitem_4);
        }

                
        $tab=new MenuItem();
        $tab->category_name=$category_0_Category;
        $tab->category=$request->category;
        $tab->sub_category_name=$category_0_SubCategory;
        $tab->sub_category_id=$request->sub_category;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->menu_item_image=$filename_menuitem_4;
        $tab->special=$request->special;
        $tab->spicy=$request->spicy;
        $tab->save();

        return redirect('menuitem')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'category'=>'required',
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'menu_item_image'=>'required',
                'special'=>'required',
                'spicy'=>'required',
        ]);

        $tab=new MenuItem();
        
        $tab->category_name=$category_0_Category;
        $tab->category=$request->category;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->menu_item_image=$filename_menuitem_4;
        $tab->special=$request->special;
        $tab->spicy=$request->spicy;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem  $menuitem
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('category','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('description','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('menu_item_image','LIKE','%'.$search.'%');
                            $query->orWhere('special','LIKE','%'.$search.'%');
                            $query->orWhere('spicy','LIKE','%'.$search.'%');
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
                            $query->orWhere('category','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('description','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('menu_item_image','LIKE','%'.$search.'%');
                            $query->orWhere('special','LIKE','%'.$search.'%');
                            $query->orWhere('spicy','LIKE','%'.$search.'%');
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

    
    public function MenuItemQuery($request)
    {
        $MenuItem_data=MenuItem::orderBy('id','DESC')->get();

        return $MenuItem_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Category','Name','Description','Price','Menu Item Image','Special','Spicy','Created Date');
        array_push($data, $array_column);
        $inv=$this->MenuItemQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->category,$voi->name,$voi->description,$voi->price,$voi->menu_item_image,$voi->special,$voi->spicy,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Menu Item Report',
            'report_title'=>'Menu Item Report',
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
                            <th class='text-center' style='font-size:12px;' >Category</th>
                        
                            <th class='text-center' style='font-size:12px;' >Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Price</th>
                        
                            <th class='text-center' style='font-size:12px;' >Menu Item Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Special</th>
                        
                            <th class='text-center' style='font-size:12px;' >Spicy</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->MenuItemQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->category."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->menu_item_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->special."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->spicy."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Menu Item Report',$html);


    }
    public function show(MenuItem $menuitem)
    {
        
        $tab=MenuItem::all();return view('admin.pages.menuitem.menuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuitem,$id=0)
    {
        $tab=MenuItem::find($id); 
        $tab_Category=Category::all();  
        $tab_SubCategory=SubCategory::select('id','category_id','category_id_name','name')->get();           
        return view('admin.pages.menuitem.menuitem_edit',['dataRow_Category'=>$tab_Category,'dataRow'=>$tab,'edit'=>true,'SubCategory'=>$tab_SubCategory]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $menuitem,$id=0)
    {
        $this->validate($request,[
                
                'category'=>'required',
                'sub_category'=>'required',
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
        ]);

        $this->SystemAdminLog("Menu Item","Update","Edit / Modify");

        
        $tab_0_Category=Category::where('id',$request->category)->first();
        $category_0_Category=$tab_0_Category->name;

        $tab_0_SubCategory=SubCategory::where('id',$request->sub_category)->first();
        $category_0_SubCategory=$tab_0_SubCategory->name;

        $filename_menuitem_4=$request->ex_menu_item_image;
        if ($request->hasFile('menu_item_image')) {
            $img_menuitem = $request->file('menu_item_image');
            $upload_menuitem = 'upload/menuitem';
            $filename_menuitem_4 = time() . '.' . $img_menuitem->getClientOriginalExtension();
            $img_menuitem->move($upload_menuitem, $filename_menuitem_4);
        }

                
        $tab=MenuItem::find($id);
        
        $tab->category_name=$category_0_Category;
        $tab->category=$request->category;
        $tab->sub_category_name=$category_0_SubCategory;
        $tab->sub_category_id=$request->sub_category;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->menu_item_image=$filename_menuitem_4;
        $tab->special=$request->special;
        $tab->spicy=$request->spicy;
        $tab->save();

        return redirect('menuitem')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuitem,$id=0)
    {
        $this->SystemAdminLog("Menu Item","Destroy","Delete");

        $tab=MenuItem::find($id);
        $tab->delete();
        return redirect('menuitem')->with('status','Deleted Successfully !');}
}
