<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorApiController extends Controller
{

    public function getAlllanguage() {

      	$language = CourseLanguage::get()->toJson(JSON_PRETTY_PRINT);
      	return response($language, 200);
    }

    public function getlanguage($id) {

	    if (CourseLanguage::where('id', $id)->exists()) {
	        $language = CourseLanguage::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
	        return response($language, 200);
	    } else {
	        return response()->json([
	          "message" => "language not found"
	        ], 404);
	    }

    }

    public function createlanguage(Request $request) {

	    $language = new CourseLanguage;
	    $language->name = $request->name;
	    $language->status = isset($request->status)  ? 1 : 0;
	    $language->save();

	    return response()->json([
	        "message" => "language created"
	    ], 201);
    }

    public function updatelanguage(Request $request, $id) {

	    if (CourseLanguage::where('id', $id)->exists()) {
	        $language = CourseLanguage::find($id);

	       	$language->name = is_null($request->name) ? $language->name : $language->name;
	        $language->status = is_null($request->status) ? 1 : 0;
	        $language->save();

	        return response()->json([
	          "message" => "records updated successfully"
	        ], 200);
	    } else {
	        return response()->json([
	          "message" => "language not found"
	        ], 404);
	    }
    }


    public function deletelanguage($id) {
	    if(language::where('id', $id)->exists()) {
	        $language = language::find($id);
	        $language->delete();

	        return response()->json([
	          "message" => "records deleted"
	        ], 202);

	    } else {
	        return response()->json([
	          "message" => "language not found"
	        ], 404);
	    }
    }
}
