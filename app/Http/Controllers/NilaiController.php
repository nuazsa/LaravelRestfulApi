<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class NilaiController extends Controller
{
    /**
     * Get Nilai RT
     */
    public function getNilaiRT(): JsonResponse
    {
        $results = DB::table('nilai')
            ->select(
                'id_siswa',
                'nama',
                'nisn',
                'nama_pelajaran',
                DB::raw('SUM(skor) AS total_skor')
            )
            ->where('materi_uji_id', 7)
            ->where('nama_pelajaran', '!=', 'Pelajaran Khusus')
            ->groupBy('id_siswa', 'nama', 'nisn', 'nama_pelajaran')
            ->get();
    
        $groupedResults = $results->groupBy('id_siswa')->map(function ($items) {
            $siswa = $items->first();
            $nilaiRT = $items->pluck('total_skor', 'nama_pelajaran');
    
            return [
                'nama' => $siswa->nama,
                'nisn' => $siswa->nisn,
                'nilaiRT' => $nilaiRT,
            ];
        });
    
        return response()->json([
            'status' => 'success',
            'data' => $groupedResults->values(),
        ]);
    }
    
    /**
     * Get Nilai ST
     */
    public function getNilaiST(): JsonResponse
    {
        $results = DB::table('nilai')
            ->select(
                'id_siswa',
                'nama',
                'nisn',
                'nama_pelajaran',
                'pelajaran_id',
                DB::raw('SUM(CASE
                    WHEN pelajaran_id = 44 THEN skor * 41.67
                    WHEN pelajaran_id = 45 THEN skor * 29.67
                    WHEN pelajaran_id = 46 THEN skor * 100
                    WHEN pelajaran_id = 47 THEN skor * 23.81
                    ELSE 0 END) AS total_skor')
            )
            ->where('materi_uji_id', 4)
            ->groupBy('id_siswa', 'nama', 'nisn', 'nama_pelajaran', 'pelajaran_id')
            ->get();
    
        $groupedResults = $results->groupBy('id_siswa')->map(function ($items) {
            $siswa = $items->first();
            $listNilai = [];
            $total = 0;
    
            foreach ($items as $item) {
                $listNilai[$item->nama_pelajaran] = round((float) $item->total_skor, 2);
                $total += $item->total_skor;
            }
    
            return [
                'nama' => $siswa->nama,
                'nisn' => $siswa->nisn,
                'listNilai' => $listNilai,
                'total' => round($total, 2),
            ];
        });
    
        $sortedResults = $groupedResults->sortByDesc('total')->values();
    
        return response()->json($sortedResults);
    }
    
}