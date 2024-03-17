<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $group = Group::all();
        return view('backend.pages.group', compact('group'));
    }

    public function create()
    {
        return view('backend.pages.addgroup');
    }

    public function store(Request $request)
    {
        Group::create($request->only('name'));
        return redirect()->route('group.index')->with('success', 'success add data');
    }

    public function edit(int $id)
    {
        $group = Group::find($id);
        return view('backend.pages.addgroup', compact('group'));
    }

    public function update(Request $request, int $id)
    {
        $group = Group::find($id);
        $group->name = $request->name;
        $group->save();
        return redirect()->route('group.index')->with('success', 'success edit data');
    }

    public function delete(int $id){
        Group::destroy($id);
        return redirect()->route('group.index')->with('success', 'success delete data');
    }
}
