<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ListGroup extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "tb_listgroup";

    protected $fillable = ['id_perusahaan','id_group'];


    public function countUser($idgroup = null, $search = null){
        $query = DB::table('tb_listgroup')
                ->leftJoin('tb_perusahaan', 'tb_perusahaan.id', '=', 'tb_listgroup.id_perusahaan')
                ->leftJoin('tb_group', 'tb_group.id', '=', 'tb_listgroup.id_group');

        if ($idgroup != 'all' && $idgroup != null) {
            $query->where('id_group', $idgroup);
        }

        if ($search != null) {
            $query->where(function($query) use ($search) {
                $query->where(DB::raw('lower(tb_perusahaan.nama)'),'LIKE','%'.$search.'%');
                $query->where(DB::raw('lower(tb_perusahaan.alamat)'),'LIKE','%'.$search.'%');
                $query->where(DB::raw('lower(tb_perusahaan.email)'),'LIKE','%'.$search.'%');
            });
        }
        $query->where('tb_listgroup.deleted_at', null);

        return  $query->count();
    }

    public function datatable($idgroup = null, $limit = null, $start = null, $search = null)
    {
        $query = DB::table('tb_listgroup')
            ->select(
                'tb_listgroup.id',
                 DB::raw("lower(tb_perusahaan.nama) as nama"),
                 DB::raw("lower(tb_group.name) as namagroup"),
                 DB::raw("lower(tb_group.id) as idgroup"),
                 DB::raw("lower(tb_perusahaan.email) as email"),
                 DB::raw("lower(tb_perusahaan.alamat) as alamat"),
            )
            ->leftJoin('tb_perusahaan', 'tb_perusahaan.id', '=', 'tb_listgroup.id_perusahaan')
            ->leftJoin('tb_group', 'tb_group.id', '=', 'tb_listgroup.id_group');
        if ($search != null) {
            $query->where(function($query) use ($search) {
                $query->orwhere(DB::raw('lower(tb_perusahaan.nama)'),'LIKE','%'.$search.'%');
                $query->orwhere(DB::raw('lower(tb_perusahaan.alamat)'),'LIKE','%'.$search.'%');
                $query->orwhere(DB::raw('lower(tb_perusahaan.email)'),'LIKE','%'.$search.'%');
            });
        }
        if ($idgroup != 'all' && $idgroup != null) {
            $query->where('id_group', $idgroup);
        }
        $query->where('tb_listgroup.deleted_at', null);
        $query->offset($start)->limit($limit);
        return  $query->get();
    }
}
