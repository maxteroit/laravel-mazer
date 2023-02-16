<?php

namespace App\Http\Controllers;

use App\Models\SendRequestAPI;
use Illuminate\Http\Request;

class IntroController extends Controller
{
    public function index()
    {
        $data = SendRequestAPI::sendGet('intro', session('token'));
        // dd($data);
        $intros = $data->data->data;
        return view('intro.index', compact('intros'));
    }

    public function create()
    {
        return view('intro.create');
    }

    public function store(Request $request)
    {
        // $request->image = $request->file('image');
        $data = SendRequestAPI::sendPostIntro('intro', session('token'), $request);
        // dd($data);
        if($data->meta->code != 200) return redirect()->route('intro')->with('error', $data->meta->messages);
        return redirect()->route('intro')->with('success', $data->meta->messages);
    }

    public function show($id)
    {
        $data = SendRequestAPI::sendGet('intro/'.$id, session('token'));
        return view('intro.show', compact('data'));
    }

    public function edit($id)
    {
        $data = SendRequestAPI::sendGet('intro/'.$id, session('token'));
        return view('intro.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = SendRequestAPI::sendPost('intro/'.$id, session('token'), $request);
        return redirect()->route('intro')->with('success', $data->meta->message);
    }

    public function destroy($id)
    {
        $data = SendRequestAPI::sendGet('intro/'.$id, session('token'));
        return redirect()->route('intro')->with('success', $data->meta->message);
    }
}
