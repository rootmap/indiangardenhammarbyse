<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use App\AdminLog;
use Illuminate\Http\Request;
use Auth;
use Socialite;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Customer";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=Customer::all();
        return view('admin.pages.customer.customer_list',['dataRow'=>$tab]);
    }

    public function logoutMember(Request $request)
    {   
        $res=0;
        if(Auth::logout())
        {
            $res=1;
        }

        return Response()->json($res);
    }



    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user->name);
        // $user->token;
        $chk=\DB::table('users')->where('email',$user->email)->where('user_type','0')->count();
        if($chk==0)
        {

            \DB::beginTransaction();
            try {
                
                $checkExCustomer=Customer::where('email_address',$user->email)->count();
                if($checkExCustomer==0)
                {
                    $tab=new Customer();
                    $tab->name=$user->name;
                    $tab->email_address=$user->email;
                    $tab->password=$user->id.'Facebook';
                    $tab->save();

                    $customer_id=$tab->id;

                    $user=User::create([
                        'name' =>$user->name,
                        'email' =>$user->email,
                        'password' =>\Hash::make('@sdQwe123Facebook'),
                        'user_type' =>1,
                        'customer_id' =>$customer_id,
                    ]);
                }
                else
                {
                    $tab=Customer::where('email_address',$user->email)->first();
                    $tab->name=$user->name;
                    $tab->password=$user->id.'Facebook';
                    $tab->save();

                    $customer_id=$tab->id;
                    $user=User::where('email',$user->email)->first();
                    $user->password=\Hash::make('@sdQwe123Facebook');
                    $user->user_type=1;
                    $user->customer_id=$customer_id;
                    $user->save();
                    
                }
                


                \DB::commit();

                if (\Auth::attempt(['email' =>$user->email,'password' =>'@sdQwe123Facebook'])){
                    return redirect('user/dashboard');
                }
                else
                {
                     return redirect('/');
                }

                
                // all good
            } catch (\Exception $e) {
                \DB::rollback();
                return redirect('/')->with('error','Failed, Please try again.');
            }
            

            
        }
        else
        {
            return redirect('/')->with('error','Email address already in use.');
        }



    }

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();
        //dd($user);
        // $user->token;
        $chk=\DB::table('users')->where('email',$user->email)->where('user_type','0')->count();
        if($chk==0)
        {

            \DB::beginTransaction();
            try {
                
                $checkExCustomer=Customer::where('email_address',$user->email)->count();
                if($checkExCustomer==0)
                {
                    $tab=new Customer();
                    $tab->name=$user->name;
                    $tab->email_address=$user->email;
                    $tab->password=$user->id.'Google';
                    $tab->save();

                    $customer_id=$tab->id;

                    $user=User::create([
                        'name' =>$user->name,
                        'email' =>$user->email,
                        'password' =>\Hash::make('@sdQwe123Google'),
                        'user_type' =>1,
                        'customer_id' =>$customer_id,
                    ]);
                }
                else
                {
                    $tab=Customer::where('email_address',$user->email)->first();
                    $tab->name=$user->name;
                    $tab->password=$user->id.'Google';
                    $tab->save();

                    $customer_id=$tab->id;

                    $user=User::where('email',$user->email)->first();
                    $user->password=\Hash::make('@sdQwe123Google');
                    $user->user_type=1;
                    $user->customer_id=$customer_id;
                    $user->save();
                }
                


                \DB::commit();

                if (\Auth::attempt(['email' =>$user->email,'password' =>'@sdQwe123Google'])){
                    return redirect('user/dashboard');
                }
                else
                {
                     return redirect('/');
                }

                
                // all good
            } catch (\Exception $e) {
                \DB::rollback();
                return redirect('/')->with('error','Failed, Please try again.');
            }
            

            
        }
        else
        {
            return redirect('/')->with('error','Email address already in use.');
        }
    }

    public function login(Request $request){
    	if(empty($request->email))
    	{
    		$res=array('status'=>0,'msg'=>'Email address required.');
    	}
    	elseif(empty($request->password))
    	{
    		$res=array('status'=>0,'msg'=>'Password required.');
    	}
    	else
    	{
    		$chk=Customer::where('email_address',$request->email)->where('password',$request->password)->count();
    		if($chk==1)
    		{
    			$auth=0;
    			if (\Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
			        $auth =1; // Success
			    }

    			$res=array('status'=>$auth,'msg'=>'Login successful, Redirecting please wait...');
    		}
    		else
    		{
    			$res=array('status'=>0,'msg'=>'Invalid Credentials.');
    		}
    	}

    	return Response()->json($res);
    	
    }

    public function register(Request $request)
    {


    	if(!empty($request->fullname) && !empty($request->email) && !empty($request->password))
    	{
    		$chk=Customer::where('email_address',$request->email)->count();
    		if($chk==0)
	    	{

	    		\DB::beginTransaction();
				try {
				    
				    $tab=new Customer();
			        $tab->name=$request->fullname;
			        $tab->email_address=$request->email;
			        $tab->password=$request->password;
			        $tab->save();

			        $customer_id=$tab->id;

			        $user=User::create([
				        'name' =>$request->fullname,
				        'email' =>$request->email,
				        'password' =>\Hash::make($request->password),
				        'user_type' =>1,
				        'customer_id' =>$customer_id,
				    ]);


				    \DB::commit();

                    $auth=1;
                    if (\Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
                        $auth =0; // Success
                    }


				    $res=array('status'=>$auth,'msg'=>'Signup successful, Please wait...');
				    // all good
				} catch (\Exception $e) {
				    \DB::rollback();
				    $res=array('status'=>2,'msg'=>'Failed, Please try again.');
				    // something went wrong
				}
	    		

		        
	    	}
	    	else
	    	{
	    		$res=array('status'=>$chk,'msg'=>'Email address already in use.');
	    	}
    	}
    	else
    	{
    		if(empty($request->fullname))
    		{
    			$res=array('status'=>0,'msg'=>'Full name required.');
    		}
    		elseif(empty($request->email))
    		{
    			$res=array('status'=>0,'msg'=>'Email address required.');
    		}
    		elseif(empty($request->password))
    		{
    			$res=array('status'=>0,'msg'=>'Password required.');
    		}

    	}
    	


    	

    	return Response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.customer.customer_create');
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
                'email_address'=>'required',
                'gander'=>'required',
                'date_of_birth'=>'required',
                'password'=>'required',
        ]);

        $this->SystemAdminLog("Customer","Save New","Create New");

        
        $tab=new Customer();
        
        $tab->name=$request->name;
        $tab->email_address=$request->email_address;
        $tab->gander=$request->gander;
        $tab->date_of_birth=$request->date_of_birth;
        $tab->password=$request->password;
        $tab->save();

        return redirect('customer')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'email_address'=>'required',
                'gander'=>'required',
                'date_of_birth'=>'required',
                'password'=>'required',
        ]);

        $tab=new Customer();
        
        $tab->name=$request->name;
        $tab->email_address=$request->email_address;
        $tab->gander=$request->gander;
        $tab->date_of_birth=$request->date_of_birth;
        $tab->password=$request->password;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('email_address','LIKE','%'.$search.'%');
                            $query->orWhere('gander','LIKE','%'.$search.'%');
                            $query->orWhere('date_of_birth','LIKE','%'.$search.'%');
                            $query->orWhere('password','LIKE','%'.$search.'%');
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
                            $query->orWhere('email_address','LIKE','%'.$search.'%');
                            $query->orWhere('gander','LIKE','%'.$search.'%');
                            $query->orWhere('date_of_birth','LIKE','%'.$search.'%');
                            $query->orWhere('password','LIKE','%'.$search.'%');
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

    
    public function CustomerQuery($request)
    {
        $Customer_data=Customer::orderBy('id','DESC')->get();

        return $Customer_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Name','Email Address','Gander','Date Of Birth','Password','Created Date');
        array_push($data, $array_column);
        $inv=$this->CustomerQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->name,$voi->email_address,$voi->gander,$voi->date_of_birth,$voi->password,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Customer Report',
            'report_title'=>'Customer Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Email Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Gander</th>
                        
                            <th class='text-center' style='font-size:12px;' >Date Of Birth</th>
                        
                            <th class='text-center' style='font-size:12px;' >Password</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->CustomerQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->email_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->gander."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->date_of_birth."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->password."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Customer Report',$html);


    }
    public function show(Customer $customer)
    {
        
        $tab=Customer::all();return view('admin.pages.customer.customer_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$id=0)
    {
        $tab=Customer::find($id);      
        return view('admin.pages.customer.customer_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer,$id=0)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'email_address'=>'required',
                'gander'=>'required',
                'date_of_birth'=>'required',
                'password'=>'required',
        ]);

        $this->SystemAdminLog("Customer","Update","Edit / Modify");

        
        $tab=Customer::find($id);
        
        $tab->name=$request->name;
        $tab->email_address=$request->email_address;
        $tab->gander=$request->gander;
        $tab->date_of_birth=$request->date_of_birth;
        $tab->password=$request->password;
        $tab->save();

        return redirect('customer')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,$id=0)
    {
        $this->SystemAdminLog("Customer","Destroy","Delete");

        $tab=Customer::find($id);
        $tab->delete();
        return redirect('customer')->with('status','Deleted Successfully !');}
}
