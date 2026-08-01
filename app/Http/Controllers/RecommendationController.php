<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function recommend($userId)
    {
        $python = base_path(".venv\\Scripts\\python.exe");
        $script = storage_path("app/ai/recommend.py");

        $command = "\"{$python}\" \"{$script}\" {$userId}";

        $output = shell_exec($command);

        $data = json_decode($output, true);

        if (!$data || empty($data['success'])) {
            return "Không lấy được dữ liệu gợi ý.";
        }

        return view('recommend', [
            'userId' => $userId,
            'recommendations' => $data['recommendations']
        ]);
    }
}