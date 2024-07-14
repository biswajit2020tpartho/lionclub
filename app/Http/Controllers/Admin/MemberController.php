<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use App\Models\Member;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath('manage-member'))->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage Member';

        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');
        if($filter_clumn!='')
        {
            $data['rows'] = Member::when($q, function($query) use ($q){                           
                            $query->whereRaw("( name like '%".$q."%' or email like '%".$q."%' or mobile like '%".$q."%')");
                        })->WHERE('member_type',3)->orderBy($filter_clumn,$sorting)->paginate($limit);

        }
        else
        {
            $data['rows'] = Member::when($q, function($query) use ($q){                           
                            $query->whereRaw("( name like '%".$q."%' or email like '%".$q."%' or mobile like '%".$q."%')");
                        })->WHERE('member_type',3)->latest()->paginate($limit);
        }   
        return view('admin.member.index', $data);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath('manage-member'))->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add Member';
        $data['categoryList'] = Category::Where('status',1)->get();
        $data['locales'] = \Config::get('app.locales');
            
        return view('admin.member.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    function postAddSave(Request $request)
    {
       if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath('manage-member'))->withError('Sorry you do not have privilege to access this area !');
        }
        //dd($request->all());
        $request->validate([
            'name' => 'required|max:150',                        
            'email' => 'required|email|unique:admin_users,email',                        
            'mobile' => 'required|digits:10|unique:admin_users,mobile',                        
            'spouse_name' => 'required|max:150',                        
            'date_of_birth' => 'required|date_format:Y-m-d',                        
            'date_of_weding' => 'required|date_format:Y-m-d',                        
            'contact_info' => 'required',       
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5000',        
            'status' => 'required|numeric',
            'category' => 'required|numeric',            
        ]);     
             

        $profile_image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'profile_image-'.time().'.'.$image->getClientOriginalExtension();
            $date = date('d-m-Y');
            $destinationPath = public_path('admin/uploads/images/profile_image/'.$date);
            $image->move($destinationPath, $name);
            $profile_image = 'admin/uploads/images/profile_image/'.$date.'/'.$name;           
        }

        $cms = new Member ; 
        $cms->name = $request->input('name');
        $cms->email = $request->input('email');
        $cms->mobile = $request->input('mobile');
        $cms->member_category_id = $request->input('category');
        $cms->spouse_name = $request->input('spouse_name');
        $cms->date_of_birth = $request->input('date_of_birth');
        $cms->date_of_weding = $request->input('date_of_weding');       
        $cms->contact_info = $request->input('contact_info'); 
        $cms->other_information = $request->input('other_information');
        $cms->photo = $profile_image; 
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->id_admin_privileges = 0;
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save();       

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-member');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('member added successfully!');
        }else{
            return redirect()->back()->withSuccess('member added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath('manage-member'))->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Details Member';
        $data['row'] = Member::find($id);
        return view('admin.member.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath('manage-member'))->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Edit Member';
        $data['row'] = Member::find($id);
        $data['categoryList'] = Category::Where('status',1)->get();
        $data['locales'] = \Config::get('app.locales');

        //dd($data['row']);

        return view('admin.member.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    function postUpdateSave($id, Request $request)
    {
        $cms = Member::find($id);
        $request->validate([
            'name' => 'required|max:150',                        
            'email' => 'required|email|unique:admin_users,email,'.$id,                        
            'mobile' => 'required|digits:10|unique:admin_users,mobile,'.$id,                        
            'spouse_name' => 'required|max:150',                        
            'date_of_birth' => 'required|date_format:Y-m-d',                        
            'date_of_weding' => 'required|date_format:Y-m-d',                        
            'contact_info' => 'required',      
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5000',        
            'status' => 'required|numeric',
            'category' => 'required|numeric',   
        ]);           
        
        $profile_image = $cms->photo;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'profile_image-'.time().'.'.$image->getClientOriginalExtension();
            $date = date('d-m-Y');
            $destinationPath = public_path('admin/uploads/images/profile_image/'.$date);
            $image->move($destinationPath, $name);
            $profile_image = 'admin/uploads/images/profile_image/'.$date.'/'.$name;           
        }

        $cms->name = $request->input('name');
        $cms->email = $request->input('email');
        $cms->mobile = $request->input('mobile');
        $cms->member_category_id = $request->input('category');
        $cms->spouse_name = $request->input('spouse_name');
        $cms->date_of_birth = $request->input('date_of_birth');
        $cms->date_of_weding = $request->input('date_of_weding');       
        $cms->contact_info = $request->input('contact_info'); 
        $cms->other_information = $request->input('other_information');
        $cms->photo = $profile_image; 
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->id_admin_privileges = 0;
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save(); 

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-member');
        return redirect($return_url)->withSuccess('Member updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        if(!empty($id))
        {
            Member::find($id)->delete();
            return redirect()->back()->withSuccess('Member deleted successfully!');
        }
    }

    public function postActionSelected(Request $request)
    {  

        $id_selected = $request->input('checkbox');
        $button_name = $request->input('button_name');
        $message = "No action taken";
        if (empty($id_selected)) {
            AdminHelper::redirect($_SERVER['HTTP_REFERER'], 'Please select at least one data!', 'warning');
        }

        if ($button_name == 'delete') {                  
            Member::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        }  

        if($button_name == 'active')      
        {
            Member::whereIn('id', $id_selected)->update(['status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            Member::whereIn('id', $id_selected)->update(['status'=>0, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";                
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}
