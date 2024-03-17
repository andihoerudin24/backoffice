<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Group;
use App\Models\ListGroup;
use Illuminate\Http\Request;

class ListGroupController extends Controller
{
    protected ListGroup $users;
    protected Group $group;

    public function __construct(ListGroup $users,Group $group) {
        $this->users = $users;
        $this->group = $group;
    }

    public function index() {
       $group =  $this->group::all();
       return view('backend.pages.listgroup',compact('group'));
    }


    public function datatable(Request $request)
    {
        if (request()->ajax()) {
            $idgroup = $request->get('idgroup') ?? null;
            $search = $request['search']['value'] ?? null;
            $limit = request('length');
            $start = request('start');
            $agregateUser = $this->users->countUser($idgroup, $search);
            $users = $this->users->datatable($idgroup, $limit, $start, $search);
            $totaldata = intval($agregateUser);
            return response()->json([
                'draw' => intval(request('draw')),
                'recordsTotal' => intval($agregateUser),
                'recordsFiltered' => $totaldata,
                'data' => $users,
            ]);
        }
    }

    public function create() {
        $group =  $this->group::all();
        $company = Company::limit(10)->get();
        $companies = null;
        $groupselected = null;
        return view('backend.pages.addlistgroup',compact('group','company','groupselected','companies'));
    }

    public function search(Request $request) {
        $searchTerm = $request->term;
        $results = Company::where('id', 'like', "%$searchTerm%")
        ->limit(10)
        ->get();
        return response()->json($results);
    }

    public function store(Request $request) {
        $idgroup = $request->id_group;
        $selectedPerusahaan = $request->id_perusahaan;
        foreach ($selectedPerusahaan as $value) {
             ListGroup::create([
                'id_group' => $idgroup,
                'id_perusahaan' => $value
             ]);
        }
        return redirect()->route('listgroup.index')->with('success', 'success add data');
    }

    public function edit(int $id) {
        $listgroup =  $this->users::find($id);
        $group =  $this->group::all();
        $groupselected    = Group::find($listgroup->id_group);
        $companies  = Company::find($listgroup->id_perusahaan);
        return view('backend.pages.addlistgroup',compact('group','groupselected','listgroup','companies'));
    }


    public function update(Request $request, int $id) {
        $idgroup = $request->id_group;
        $selectedPerusahaan = $request->id_perusahaan;
        foreach ($selectedPerusahaan as $perusahaanId) {
            ListGroup::updateOrCreate(
               ['id_group' => $idgroup, 'id_perusahaan' => $perusahaanId],
               ['id_group' => $idgroup, 'id_perusahaan' => $perusahaanId]
            );
        }
        return redirect()->route('listgroup.index')->with('success', 'success update data');
    }

    public function delete(int $id) {
        ListGroup::destroy($id);
        return redirect()->route('listgroup.index')->with('success', 'success delete data');
    }
}
