<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AssetController extends Controller
{
    public function create()
    {
        return view('asset.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'assets_key' => 'required',
            'assets_type' => 'required',
            'zero_code' => 'required',
            'start_depreciation' => 'required',
            'address' => 'required',
            'qty' => 'required|numeric',
            'unit' => 'required',
            'age' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'layout' => 'required',
            // 'user_id' => 'required|numeric',
            // 'created_date' => 'required|date',
            // 'updated_date' => 'required|date',
        ]);

        $attributes = [
            'assets_key' => $validatedData['assets_key'],
            'keygen' => 'KEY_' . $validatedData['assets_key'] . '_' . $validatedData['zero_code'],
            'assets_type' => $validatedData['assets_type'],
            'zero_code' => $validatedData['zero_code'],
            'start_depreciation' => $validatedData['start_depreciation'],
            'address' => $validatedData['address'],
            'qty' => $validatedData['qty'],
            'unit' => $validatedData['unit'],
            'age' => $validatedData['age'],
            'cost_price' => $validatedData['cost_price'],
            'total_price' => $validatedData['total_price'],
            'layout' => $validatedData['layout'],
            'user_id' => 'test',
            // 'created_date' => now(),
            // 'updated_date' => now(),
        ];

        DB::table('qr_data')->insert($attributes);

        return response()->json(['data' => $attributes]);
        // return redirect()->route('asset.create')->with('success', 'Asset created successfully!');
    }
    public function listRowQR()
    {

        // สร้าง raw query
        $query = "SELECT assets_key,keygen, assets_type, zero_code, layout, created_date FROM qr_data";

        // ดึงข้อมูลจากฐานข้อมูลโดยใช้ raw query
        $assets = DB::select($query);

        // สามารถทำการประมวลผลหรือใช้ข้อมูลที่ได้รับได้ต่อไปตามต้องการ
        // เช่น ส่งข้อมูลกลับไปในรูปแบบ JSON หรือแสดงผลบนหน้า View

        return response()->json($assets);
    }
    public function checkQR(Request $request)
    {
        // สร้าง raw query
        $query = "SELECT * FROM qr_data WHERE keygen = ?";

        // ดึงข้อมูลจากฐานข้อมูลโดยใช้ SQL query
        $assets = DB::select($query, array($request->qrText));



        return response()->json($assets);
    }
}
