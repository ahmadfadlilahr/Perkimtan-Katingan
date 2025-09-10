<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AgendaRequest;
use App\Models\Agenda;
use App\Services\AgendaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function __construct(
        protected AgendaService $agendaService
    ) {
        $this->middleware('can:kelola agenda');
    }

    /**
     * Display a listing of agendas
     */
    public function index(Request $request): View
    {
        $filters = $request->only([
            'search', 'status', 'kategori', 'prioritas',
            'is_featured', 'is_publik', 'date_from', 'date_to'
        ]);

        $agendas = $this->agendaService->getPaginatedAgendas($filters, 10);
        $statistics = $this->agendaService->getStatistics();

        return view('admin.agenda.index', compact('agendas', 'statistics', 'filters'));
    }

    /**
     * Show the form for creating a new agenda
     */
    public function create(): View
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created agenda
     */
    public function store(AgendaRequest $request): RedirectResponse
    {
        try {
            $this->agendaService->createAgenda($request->validated());

            return redirect()
                ->route('dashboard.agenda.index')
                ->with('success', 'Agenda berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal membuat agenda: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified agenda
     */
    public function show(Agenda $agenda): View
    {
        $agenda->load('creator');
        return view('admin.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified agenda
     */
    public function edit(Agenda $agenda): View
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified agenda
     */
    public function update(AgendaRequest $request, Agenda $agenda): RedirectResponse
    {
        try {
            $this->agendaService->updateAgenda($agenda, $request->validated());

            return redirect()
                ->route('dashboard.agenda.index')
                ->with('success', 'Agenda berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui agenda: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified agenda
     */
    public function destroy(Agenda $agenda): RedirectResponse
    {
        try {
            $this->agendaService->deleteAgenda($agenda);

            return redirect()
                ->route('dashboard.agenda.index')
                ->with('success', 'Agenda berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus agenda: ' . $e->getMessage());
        }
    }

    /**
     * Bulk update status
     */
    public function bulkUpdateStatus(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:agendas,id',
            'status' => 'required|in:draft,published,selesai,dibatalkan'
        ]);

        try {
            Agenda::whereIn('id', $request->ids)
                ->update(['status' => $request->status]);

            $count = count($request->ids);
            return redirect()
                ->route('dashboard.agenda.index')
                ->with('success', "{$count} agenda berhasil diperbarui statusnya!");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui status agenda: ' . $e->getMessage());
        }
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Agenda $agenda): RedirectResponse
    {
        try {
            $agenda->update(['is_featured' => !$agenda->is_featured]);

            $status = $agenda->is_featured ? 'ditandai sebagai unggulan' : 'dihapus dari unggulan';
            return redirect()
                ->back()
                ->with('success', "Agenda berhasil {$status}!");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengubah status unggulan: ' . $e->getMessage());
        }
    }
}
