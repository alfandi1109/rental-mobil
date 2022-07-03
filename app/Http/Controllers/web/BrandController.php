<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use DataTables;

class BrandController extends Controller
{
    public function index()
    {
        return view('pages.brand.index');
    }

    public function show($id)
    {
        try {
            $data = Brand::find($id);
            return response()->json(['error' => false, 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            Brand::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json(['error' => false, 'message' => 'Berhasil Insert Data'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = Brand::find($request->id);
            $data->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json(['error' => false, 'message' => 'Berhasil Update Data'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Brand::find($id);
            $data->delete();
            return response()->json(['error' => false, 'message' => 'Berhasil Hapus Data'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function all(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" onclick="editData(\''.$row->id.'\')" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onclick="deleteData(\''.$row->id.'\')" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
