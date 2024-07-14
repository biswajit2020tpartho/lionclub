<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use App\Models\GroupMember;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage Member Group';

        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');
        if($filter_clumn!='')
        {
            $data['rows'] = GroupMember::when($q, function($query) use ($q){                           
                            $query->whereRaw("( name like '%".$q."%' or slug like '%".$q."%')");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);

        }
        else
        {
            $data['rows'] = GroupMember::when($q, function($query) use ($q){                           
                            $query->whereRaw("( name like '%".$q."%' or slug like '%".$q."%')");
                        })->latest()->paginate($limit);
        }   
        return view('admin.member-group.index', $data);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath('manage-group'))->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add Member Group';
        $data['locales'] = \Config::get('app.locales');
        $data['category'] = Category::Where('status',1)->orderBy('name')->get();    
        return view('admin.member-group.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    function postAddSave(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath('manage-group'))->withError('Sorry you do not have privilege to access this area !');
        }
        //dd($request->all());
        $request->validate([
            'name' => 'required|max:150',
            'category' => 'required|numeric',
            'status' => 'required|numeric'
        ]);     
         
        $isdata = GroupMember::where('name' ,$request->input('name'))
                                ->where('member_category_id',$request->input('category'))
                                ->get();
        if(!$isdata->isEmpty()){
           return redirect()->back()->withInput($request->all())->withError('Member group Already Exists!'); 
        }    

        $cms = new GroupMember ; 
        $cms->name = $request->input('name');        
        $cms->member_category_id  = $request->input('category');
        $cms->slug  = $request->input('category');
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save();       

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-group');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Member group added successfully!');
        }else{
            return redirect()->back()->withSuccess('Member group added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Details Member Group';
        $data['row'] = GroupMember::find($id);
        return view('admin.member-group.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    function getEdit($id)
    {
       if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Edit Member Group';
        $data['row'] = GroupMember::find($id);
        $data['locales'] = \Config::get('app.locales');
        $data['category'] = Category::Where('status',1)->orderBy('name')->get(); 
        return view('admin.member-group.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    function postUpdateSave($id, Request $request)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $cms = GroupMember::find($id);
        $request->validate([
            'name' => 'required|max:150|unique:member_group,name,'.$cms->id,
            'category' => 'required|numeric',
            'status' => 'required|numeric'
        ]);
        
        $cms->name = $request->input('name');
        $cms->member_category_id = $request->input('category');       
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save(); 

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-group');
        return redirect($return_url)->withSuccess('Member Group updated successfully!');
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
            GroupMember::find($id)->delete();
            return redirect()->back()->withSuccess('Member Group deleted successfully!');
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
            if (!AdminHelper::isDelete()) {
                return redirect(AdminHelper::adminPath('manage-group'))->withError('Sorry you do not have privilege to access this area !');
            }                 
            GroupMember::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        }  

        if($button_name == 'active')      
        {
            if (!AdminHelper::isUpdate()) {
                return redirect(AdminHelper::adminPath('manage-group'))->withError('Sorry you do not have privilege to access this area !');
            }
            GroupMember::whereIn('id', $id_selected)->update(['status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            if (!AdminHelper::isUpdate()) {
                return redirect(AdminHelper::adminPath('manage-group'))->withError('Sorry you do not have privilege to access this area !');
            }
            GroupMember::whereIn('id', $id_selected)->update(['status'=>0, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";                
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}
