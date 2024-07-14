<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use AdminHelper;
use App\Models\Question;

class QuestionController extends Controller
{
	function getIndex()
    { 
    	if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath('manage-question'))->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
		$request = request();
        $data['page_title'] = 'Question';
        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');
		$data['rows'] = Question::when($q, function($query) use ($q){        					
        					$query->whereRaw("(name ilike '%".$q."%' or subject ilike '%".$q."%')");
        				})->latest()->paginate($limit);       
        return view('admin.question.index', $data);
    }
	
	public function addQuestion (Request $request){
		if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath('manage-question'))->withError('Sorry you do not have privilege to access this area !');
        }
		$data = [];
		$request = request();
		$data['page_title'] = 'Add Question';
		if ($request->isMethod('post')) {
			$request->validate([
				'question' 	=> 'required',		
				'question_type' 	=> 'required|numeric',
				'option_1' 	=> 'required',
				'option_2' 	=> 'required',
				'option_3' 	=> 'required',
				'option_4' 	=> 'required',				
				'status' 	=> 'required|numeric'
			]);
			$insertData = new Question;
			$insertData->question_title =  $request->input('question');
			$insertData->question_type = $request->input('question_type');
			$insertData->option1 = $request->input('option_1');
			$insertData->option2 = $request->input('option_2');
			$insertData->option3 = $request->input('option_3');
			$insertData->option4 = $request->input('option_4');	
			$insertData->status = $request->input('status');
			$insertData->created_by = AdminHelper::myId();
			$insertData->updated_by = AdminHelper::myId();
			$insertData->created_at = date('Y-m-d h:i:s');
			$insertData->ip_address = $_SERVER['REMOTE_ADDR'];
			$insertData->save();
			
			$return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-question');
			if($request->input('submit')=='Save')
			{
				return redirect($return_url)->withSuccess('Question added successfully!');
			}else{
				return redirect()->back()->withSuccess('Question added successfully!');
			}
		}
		return view('admin.question.add', $data);
	}
	
	public function viewQuestion($id){
		if (!AdminHelper::isRead('manage-question')) {
            return redirect(AdminHelper::adminPath('manage-member'))->withError('Sorry you do not have privilege to access this area !');
        }
		$data = [];
    	$data['page_title'] = 'Details Question';
    	$data['row'] = Question::find($id);		
    	return view('admin.question.detail', $data);
	}
	
	public function editQuestion($id,Request $request){
		if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath('manage-question'))->withError('Sorry you do not have privilege to access this area !');
        }
		$data = [];
    	$data['page_title'] = 'Edit Question';
    	$data['row'] = Question::find($id);
		$courseId = $data['row']->getChapterDetails->course_id;
		$data['chapter'] = Chapter::Where([['course_id',$courseId],['status',1]])->get();	
		if ($request->isMethod('post')) {	
			$request->validate([
				'question' 		=> 'required|unique:tbl_question,question,'.$data['row']->id,				
				'chapter' 		=> 'required',
				'question_type' => 'required',
				'option_1' 		=> 'required',
				'option_2' 		=> 'required',
				'option_3' 		=> 'required',
				'option_4' 		=> 'required',
				'answer' 		=> 'required',
				'marks' 		=> 'required',
				'sort_order' 	=> 'required',
				'status' 		=> 'required|numeric'
			]);
			$update = Question::find($id);
			$update->chapter_id = $request->input('chapter');
			$update->question_type = $request->input('question_type');
			$update->question = $request->input('question');
			$update->option1 = $request->input('option_1');
			$update->option2 = $request->input('option_2');
			$update->option3 = $request->input('option_3');
			$update->option4 = $request->input('option_4');
			$update->answer = $request->input('answer');
			$update->marks = $request->input('marks');
			$update->sort_order = $request->input('sort_order');
			$update->status = $request->input('status');
			$update->updated_by = AdminHelper::myId();
			$update->updated_at = date('Y-m-d h:i:s');
			$update->ip_address = $_SERVER['REMOTE_ADDR'];
			$update->save();
			$return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-question');
			return redirect($return_url)->withSuccess('Question updated successfully!');
		}
    	return view('admin.question.edit', $data);
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
            DB::statement('DROP TABLE IF EXISTS tbl_Question_bkp');
            DB::statement('CREATE TABLE tbl_Question_bkp AS TABLE tbl_Question');
			
            Question::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        }  

        if($button_name == 'active')      
        {
            Question::whereIn('id', $id_selected)->update(['status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            Question::whereIn('id', $id_selected)->update(['status'=>0, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}