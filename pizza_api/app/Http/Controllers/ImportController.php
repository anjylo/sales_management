<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Services\ImportService;

class ImportController extends Controller
{
    public function __construct(private ImportService $importService)
    {
        
    }

    /**
     * Import Files
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(ImportRequest $request)
    {
        try {
            $this->importService->import($request->file('file'), $request->type);
            return response()->json(['message' => 'Import successful.']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid file. Please check and re-upload.', 
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
