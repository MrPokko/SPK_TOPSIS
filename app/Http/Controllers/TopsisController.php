<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\HasilTopsis;

class TopsisController extends Controller
{
    public function index()
    {
        // Retrieve alternatives and criteria from the database
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        // Step 1: Populate the decision matrix
        $decisionMatrix = $this->getDecisionMatrix($alternatifs, $kriterias);

        // Step 2: Normalize the decision matrix
        $normalizedMatrix = $this->normalizeMatrix($decisionMatrix);

        // Step 3: Weighted Normalization
        $weightedMatrix = $this->weightedNormalization($normalizedMatrix, $kriterias);

        // Step 4: Identify ideal positive and negative solutions
        list($idealPositives, $idealNegatives) = $this->calculateIdealSolutions($weightedMatrix, $kriterias);

        // Step 5: Calculate distances to ideal solutions
        list($positiveDistances, $negativeDistances) = $this->calculateDistances($weightedMatrix, $idealPositives, $idealNegatives);

        // Step 6: Calculate relative closeness
        $closenessValues = $this->calculateCloseness($positiveDistances, $negativeDistances);

        // Step 7: Update or create TOPSIS results in the database
        $this->updateOrCreateResults($alternatifs, $closenessValues);

        // Retrieve the TOPSIS results from the database
        $hasilTopsis = HasilTopsis::all();

        // Display the results in the 'topsis.index' view
        return view('topsis.index', compact('hasilTopsis'));
    }

    public function deleteAllItems()
    {
        // Delete all TOPSIS results from the 'HasilTopsis' table
        HasilTopsis::truncate();

        return redirect()->route('alternatif.index')->with('success', 'Semua data hasil perhitungan topsis telah dihapus!');
    }

    // Helper function to populate the decision matrix
    private function getDecisionMatrix($alternatifs, $kriterias)
    {
        $decisionMatrix = [];

        foreach ($alternatifs as $alternatif) {
            $nilaiRow = [];

            foreach ($kriterias as $kriteria) {
                $nilai = Nilai::where('id_alternatif', $alternatif->id_alternatif)
                    ->where('id_kriteria', $kriteria->id_kriteria)
                    ->value('nilai');
                $nilaiRow[] = $nilai;
            }

            $decisionMatrix[] = $nilaiRow;
        }

        return $decisionMatrix;
    }

    // Helper function to normalize the matrix
    private function normalizeMatrix($matrix)
    {
        $normalizedMatrix = [];

        foreach ($matrix as $row) {
            $sumSquare = array_sum(array_map('pow', $row, array_fill(0, count($row), 2)));
            $magnitude = sqrt($sumSquare == 0 ? 1 : $sumSquare);

            $normalizedRow = array_map(function ($value) use ($magnitude) {
                return $value / $magnitude;
            }, $row);

            $normalizedMatrix[] = $normalizedRow;
        }

        return $normalizedMatrix;
    }

    // Helper function for weighted normalization
    private function weightedNormalization($normalizedMatrix, $kriterias)
    {
        $weightedMatrix = [];

        foreach ($normalizedMatrix as $index => $row) {
            $weightedRow = array_map(function ($value, $kriteria) {
                return $value * $kriteria['bobot']; // Accessing the 'bobot' property
            }, $row, $kriterias->toArray());

            $weightedMatrix[] = $weightedRow;
        }

        return $weightedMatrix;
    }

    // Helper function to calculate ideal positive and negative solutions
    private function calculateIdealSolutions($weightedMatrix, $kriterias)
    {
        $idealPositives = [];
        $idealNegatives = [];

        foreach ($kriterias as $index => $kriteria) {
            $col = array_column($weightedMatrix, $index);

            $idealPositives[] = $kriteria->jenis == 'benefit' ? max($col) : min($col);
            $idealNegatives[] = $kriteria->jenis == 'benefit' ? min($col) : max($col);
        }

        return [$idealPositives, $idealNegatives];
    }

    // Helper function to calculate distances to ideal solutions
    private function calculateDistances($weightedMatrix, $idealPositives, $idealNegatives)
    {
        $positiveDistances = [];
        $negativeDistances = [];

        foreach ($weightedMatrix as $rowIndex => $row) {
            $positiveDistances[] = sqrt(array_sum(array_map(function ($x, $y) {
                return pow($x - $y, 2);
            }, $row, $idealPositives)));

            $negativeDistances[] = sqrt(array_sum(array_map(function ($x, $y) {
                return pow($x - $y, 2);
            }, $row, $idealNegatives)));
        }

        return [$positiveDistances, $negativeDistances];
    }

    // Helper function to calculate relative closeness
    private function calculateCloseness($positiveDistances, $negativeDistances)
    {
        $closenessValues = [];

        foreach ($negativeDistances as $index => $jarakNegatif) {
            $denominator = $jarakNegatif + $positiveDistances[$index];

            $closenessValues[] = $denominator != 0 ? $jarakNegatif / $denominator : 0;
        }

        return $closenessValues;
    }

    // Helper function to update or create TOPSIS results in the database
    private function updateOrCreateResults($alternatifs, $closenessValues)
    {
        foreach ($alternatifs as $index => $alternatif) {
            $alternatif->hasil_topsis()->updateOrCreate(
                [],
                [
                    'nilai_preferensi' => $closenessValues[$index],
                    'urutan' => $index + 1,
                    'id_alternatif' => $alternatif->id_alternatif,
                   // 'nama_alternatif' => $alternatif->nama_alternatif,
                ]
            );
        }
    }
}
