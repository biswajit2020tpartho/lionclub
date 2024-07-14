<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use App\Models\Meeting;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath('manage-meeting'))->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage Meeting';

        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');
        if($filter_clumn!='')
        {
            $data['rows'] = Meeting::when($q, function($query) use ($q){                           
                            $query->whereRaw("( meeting_title like '%".$q."%' or agenda like '%".$q."%' or description like '%".$q."%')");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);

        }
        else
        {
            $data['rows'] = Meeting::when($q, function($query) use ($q){                           
                            $query->whereRaw("( meeting_title like '%".$q."%' or agenda like '%".$q."%' or description like '%".$q."%')");
                        })->latest()->paginate($limit);
        }   
        return view('admin.meeting.index', $data);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    function getAdd()
    {
        if (!AdminHelper::isCreate('manage-meeting')) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add Meeting';
        $data['categoryList'] = Category::Where('status',1)->get();
        $data['locales'] = \Config::get('app.locales');
            
        return view('admin.meeting.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    function postAddSave(Request $request)
    {
       if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath('manage-meeting'))->withError('Sorry you do not have privilege to access this area !');
        }
        //dd($request->all());
        $request->validate([
            'meeting_title' => 'required|max:200', 
            'location' => 'required|max:150',                        
            'meeting_date' => 'required|date_format:Y-m-d',                       
            'meeting_time' => 'required',       
            'agenda' => 'required',       
            'description' => 'required',       
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5000',        
            'status' => 'required|numeric'           
        ]);     
             

        $meeting_image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'profile_image-'.time().'.'.$image->getClientOriginalExtension();
            $date = date('d-m-Y');
            $destinationPath = public_path('admin/uploads/images/profile_image/'.$date);
            $image->move($destinationPath, $name);
            $meeting_image = 'admin/uploads/images/profile_image/'.$date.'/'.$name;           
        }

        $slug_val = SlugService::createSlug(Meeting::class, 'slug', $request->input('meeting_title'));

        $cms = new Meeting ; 
        $cms->meeting_title = $request->input('meeting_title');
        $cms->slug = $slug_val;
        $cms->location = $request->input('location');
        $cms->meeting_date = $request->input('meeting_date');
        $cms->meeting_time = $request->input('meeting_time');
        $cms->agenda = $request->input('agenda');       
        $cms->description = $request->input('description');          
        $cms->feature_image = $meeting_image; 
        $cms->status = $request->input('status');
        $cms->user_ip = $request->ip();
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();        
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save();       

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-meeting');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Meeting added successfully!');
        }else{
            return redirect()->back()->withSuccess('Meeting added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath('manage-meeting'))->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Details Meeting';
        $data['row'] = Meeting::find($id);
        return view('admin.meeting.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    function getEdit($id)
    {
       if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath('manage-meeting'))->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Edit Meeting';
        $data['row'] = Meeting::find($id);
        $data['categoryList'] = Category::Where('status',1)->get();
        $data['locales'] = \Config::get('app.locales');

        //dd($data['row']);

        return view('admin.meeting.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    function postUpdateSave($id, Request $request)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath('manage-meeting'))->withError('Sorry you do not have privilege to access this area !');
        }
        $cms = Meeting::find($id);
        $request->validate([
            'meeting_title' => 'required|max:200', 
            'location' => 'required|max:150',                        
            'meeting_date' => 'required|date_format:Y-m-d',                       
            'meeting_time' => 'required',       
            'agenda' => 'required',       
            'description' => 'required',       
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5000',        
            'status' => 'required|numeric'           
        ]);          
        
        $meeting_image = $cms->feature_image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'profile_image-'.time().'.'.$image->getClientOriginalExtension();
            $date = date('d-m-Y');
            $destinationPath = public_path('admin/uploads/images/meeting_image/'.$date);
            $image->move($destinationPath, $name);
            $meeting_image = 'admin/uploads/images/meeting_image/'.$date.'/'.$name;           
        }
        $slug_val = SlugService::createSlug(Meeting::class, 'slug', $request->input('meeting_title'));
        $cms->meeting_title = $request->input('meeting_title');
        $cms->slug = $slug_val;
        $cms->location = $request->input('location');
        $cms->meeting_date = $request->input('meeting_date');
        $cms->meeting_time = $request->input('meeting_time');
        $cms->agenda = $request->input('agenda');       
        $cms->description = $request->input('description');         
        $cms->feature_image = $meeting_image; 
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save(); 

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-meeting');
        return redirect($return_url)->withSuccess('Meeting updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath('manage-meeting'))->withError('Sorry you do not have privilege to access this area !');
        }
        if(!empty($id))
        {
            Meeting::find($id)->delete();
            return redirect()->back()->withSuccess('Meeting deleted successfully!');
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
            Meeting::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        }  

        if($button_name == 'active')      
        {
            Meeting::whereIn('id', $id_selected)->update(['status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            Meeting::whereIn('id', $id_selected)->update(['status'=>0, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";                
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}
