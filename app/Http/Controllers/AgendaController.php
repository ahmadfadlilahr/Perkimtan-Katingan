<?php

namespace App\Http\Controllers;

use App\Services\AgendaService;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    private AgendaService $agendaService;

    public function __construct(AgendaService $agendaService)
    {
        $this->agendaService = $agendaService;
    }

    /**
     * Display a listing of agenda for public view
     */
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search'),
            'kategori' => $request->query('category'),
            'month' => $request->query('month'),
            'year' => $request->query('year')
        ];

        $agendas = $this->agendaService->getPublicAgendas($filters, 12);
        $featuredAgendas = $this->agendaService->getFeaturedAgendas(6);

        return view('agenda.index', compact('agendas', 'featuredAgendas'));
    }

    /**
     * Display the specified agenda
     */
    public function show(string $slug)
    {
        $agenda = $this->agendaService->getBySlug($slug);

        // Only check if agenda exists and is published
        // The is_publik field is used only for display purposes (badge), not access control
        if (!$agenda || $agenda->status !== 'published') {
            abort(404, 'Agenda tidak ditemukan');
        }

        $filters = [
            'kategori' => $agenda->kategori,
            'exclude_id' => $agenda->id
        ];

        $relatedAgendas = $this->agendaService->getPublicAgendas($filters, 4);

        return view('agenda.show', compact('agenda', 'relatedAgendas'));
    }
}
