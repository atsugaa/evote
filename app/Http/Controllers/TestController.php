<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\User;

class TestController extends Controller
{
    public function generate()
    {
        $process = new Process(['python',"test.py"], 
    null,
    ['SYSTEMROOT' => getenv('SYSTEMROOT'), 'PATH' => getenv("PATH")]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $list_data = array_filter(explode("\n",$process->getOutput()));
        
        dd($list_data);
        foreach ($list_data as $book) {
            $book = str_replace(['[', ']', "'", '"'], '', $book);
            $data = explode(', ', $book);
    
            $user = new User;
            
            $user->NISN = strval($data[2]);
            $user->NAMA = strtoupper($data[1]);
            $user->STATUS = false;
            $user->save();
        }
        return view('test', ['data' => $list_data]);
    }
}
