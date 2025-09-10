<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use App\Services\VisiMisiService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class VisiMisiController extends Controller
{
    protected VisiMisiService $visiMisiService;

    public function __construct(VisiMisiService $visiMisiService)
    {
        $this->visiMisiService = $visiMisiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $type = $request->query('type', 'visi');
        $visiMisiItems = $this->visiMisiService->getByType($type, false);
        $allVisiMisiItems = $this->visiMisiService->getAll(false); // Ambil semua data untuk counting
        $types = VisiMisi::getTypes();

        return view('admin.visi-misi.index', compact('visiMisiItems', 'allVisiMisiItems', 'types', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $type = $request->query('type', 'visi');
        $types = VisiMisi::getTypes();
        $colorClasses = VisiMisiService::getColorClasses();
        $iconClasses = VisiMisiService::getIconClasses();

        return view('admin.visi-misi.create', compact('types', 'type', 'colorClasses', 'iconClasses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(array_keys(VisiMisi::getTypes()))],
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'color_class' => 'nullable|string|max:100',
            'order_position' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        try {
            $this->visiMisiService->create($validated);

            return redirect()
                ->route('admin.visi-misi.index', ['type' => $validated['type']])
                ->with('success', 'Item berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan item: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VisiMisi $visiMisi): View
    {
        return view('admin.visi-misi.show', compact('visiMisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisiMisi $visiMisi): View
    {
        $types = VisiMisi::getTypes();
        $colorClasses = VisiMisiService::getColorClasses();
        $iconClasses = VisiMisiService::getIconClasses();

        return view('admin.visi-misi.edit', compact('visiMisi', 'types', 'colorClasses', 'iconClasses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisiMisi $visiMisi): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(array_keys(VisiMisi::getTypes()))],
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'color_class' => 'nullable|string|max:100',
            'order_position' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        try {
            $this->visiMisiService->update($visiMisi, $validated);

            return redirect()
                ->route('admin.visi-misi.index', ['type' => $validated['type']])
                ->with('success', 'Item berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui item: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisiMisi $visiMisi): RedirectResponse
    {
        try {
            $type = $visiMisi->type;
            $this->visiMisiService->delete($visiMisi);

            return redirect()
                ->route('admin.visi-misi.index', ['type' => $type])
                ->with('success', 'Item berhasil dihapus.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus item: ' . $e->getMessage());
        }
    }

    /**
     * Toggle active status
     */
    public function toggleActive(VisiMisi $visiMisi): RedirectResponse
    {
        try {
            $this->visiMisiService->toggleActive($visiMisi);

            return back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    /**
     * Reorder items
     */
    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(array_keys(VisiMisi::getTypes()))],
            'item_ids' => 'required|array',
            'item_ids.*' => 'integer|exists:visi_misis,id'
        ]);

        try {
            $this->visiMisiService->reorder($validated['type'], $validated['item_ids']);

            return back()->with('success', 'Urutan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui urutan: ' . $e->getMessage());
        }
    }
}
