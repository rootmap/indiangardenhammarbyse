<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\AdminLog;
use Illuminate\Http\Request;
use App\GalleryCategory;
                

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Gallery";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=Gallery::all();
        return view('admin.pages.gallery.gallery_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_Category=GalleryCategory::all();           
        return view('admin.pages.gallery.gallery_create',['dataRow_Category'=>$tab_Category]);
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


    private function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }
    //usage example
    //resize_crop_image(100, 100, "test.jpg", "test.jpg");

    public function store(Request $request)
    {
        $this->validate($request,[
                
                'category'=>'required',
                'gallery_content'=>'required',
                'gallery_image'=>'required|mimes:jpeg,bmp,png|max:1000',
        ]);

        $this->SystemAdminLog("Gallery","Save New","Create New");

        
        $tab_0_Category=GalleryCategory::where('id',$request->category)->first();
        $category_0_Category=$tab_0_Category->name;

        $filename_gallery_2='';
        if ($request->hasFile('gallery_image')) {


            

            $img_gallery = $request->file('gallery_image');
            $upload_gallery = 'upload/gallery';
            $filename_gallery_2 = 'indiangarden_'.time() . '.' . $img_gallery->getClientOriginalExtension();
            $img_gallery->move($upload_gallery, $filename_gallery_2);

            $this->resize_crop_image(345, 345, $upload_gallery.'/'.$filename_gallery_2, $upload_gallery.'/small/'.$filename_gallery_2);

            //echo url($upload_gallery.'/small/'.$filename_gallery_2); 
        }

       //die();

                
        $tab=new Gallery();
        
        $tab->category_name=$category_0_Category;
        $tab->category=$request->category;
        $tab->gallery_content=$request->gallery_content;
        $tab->gallery_image=$filename_gallery_2;
        $tab->save();

        return redirect('galleryphoto')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'category'=>'required',
                'gallery_content'=>'required',
                'gallery_image'=>'required',
        ]);

        $tab=new Gallery();
        
        $tab->category_name=$category_0_Category;
        $tab->category=$request->category;
        $tab->gallery_content=$request->gallery_content;
        $tab->gallery_image=$filename_gallery_2;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('category','LIKE','%'.$search.'%');
                            $query->orWhere('gallery_content','LIKE','%'.$search.'%');
                            $query->orWhere('gallery_image','LIKE','%'.$search.'%');
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
                            $query->orWhere('gallery_content','LIKE','%'.$search.'%');
                            $query->orWhere('gallery_image','LIKE','%'.$search.'%');
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

    
    public function GalleryQuery($request)
    {
        $Gallery_data=Gallery::orderBy('id','DESC')->get();

        return $Gallery_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Category','Gallery Content','Gallery Image','Created Date');
        array_push($data, $array_column);
        $inv=$this->GalleryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->category,$voi->gallery_content,$voi->gallery_image,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Gallery Report',
            'report_title'=>'Gallery Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Gallery Content</th>
                        
                            <th class='text-center' style='font-size:12px;' >Gallery Image</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->GalleryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->category."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->gallery_content."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->gallery_image."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Gallery Report',$html);


    }
    public function show(Gallery $gallery)
    {
        
        $tab=Gallery::all();return view('admin.pages.gallery.gallery_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery,$id=0)
    {
        $tab=Gallery::find($id); 
        $tab_Category=GalleryCategory::all();     
        return view('admin.pages.gallery.gallery_edit',['dataRow_Category'=>$tab_Category,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery,$id=0)
    {
        $this->validate($request,[
                
                'category'=>'required',
                'gallery_content'=>'required',
        ]);

        $this->SystemAdminLog("Gallery","Update","Edit / Modify");

        
        $tab_0_Category=GalleryCategory::where('id',$request->category)->first();
        $category_0_Category=$tab_0_Category->name;

        $filename_gallery_2=$request->ex_gallery_image;
        if ($request->hasFile('gallery_image')) {



            $this->validate($request,[
                    'gallery_image'=>'required|mimes:jpeg,bmp,png|max:1000',
            ]);


            $img_gallery = $request->file('gallery_image');
            $upload_gallery = 'upload/gallery';
            $filename_gallery_2 = 'indiangarden_'.time() . '.' . $img_gallery->getClientOriginalExtension();
            $img_gallery->move($upload_gallery, $filename_gallery_2);

            $this->resize_crop_image(345, 345, $upload_gallery.'/'.$filename_gallery_2, $upload_gallery.'/small/'.$filename_gallery_2);
        }

                
        $tab=Gallery::find($id);
        
        $tab->category_name=$category_0_Category;
        $tab->category=$request->category;
        $tab->gallery_content=$request->gallery_content;
        $tab->gallery_image=$filename_gallery_2;
        $tab->save();

        return redirect('galleryphoto')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery,$id=0)
    {
        $this->SystemAdminLog("Gallery","Destroy","Delete");

        $tab=Gallery::find($id);
        $tab->delete();
        return redirect('galleryphoto')->with('status','Deleted Successfully !');}
}
