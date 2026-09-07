<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelPlans;
use Illuminate\Http\Request;

class TravelPlansController extends Controller
{
    /* Метод отвечающий за создание страницы, которая отображает список поездок */
    public function index()
    {
        $plans = TravelPlans::query()
            ->orderBy('start_date')
            ->get();
        return view('admin.travel-plans.index', compact('plans'));
    }

   /* Метод отвечающий за создание страницы для создания записи */
    public function create()
    {
        return view('admin.travel-plans.create');
    }

    /* Метод отвечающий за сохранение информации о поездке */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'flag' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string', 'max:2048'],
            'link_page' => ['nullable', 'string', 'max:2048'],
        ]);

        TravelPlans::create($data);

        return redirect()
            ->route('admin.travel-plans.index')
            ->with('succesы', 'Поездка создана');
    }

    /* Метод отвечающий за редактирование существующей записи */
    public function edit(TravelPlans $travelPlans)
    {
        return view(
            'admin.travel-plans.edit',
            compact('travelPlans')
        );
    }

    /* Метод отвечающий за обновление существующей записи */
    public function update(
        Request $request,
        TravelPlans $travelPlans
    ) {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'flag' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string', 'max:2048'],
            'link_page' => ['nullable', 'string', 'max:2048'],
        ]);

        $travelPlans->update($data);

        return redirect()
            ->route('admin.travel-plans.index')
            ->with('success', 'Путешествие обновлено');
    }

    /* Метод отвечающий за удаление существующей записи */
    public function destroy(TravelPlans $travelPlans)
    {
        $travelPlans->delete();

        return redirect()
            ->route('admin.travel-plans.index')
            ->with('success', 'Путешествие удалено');
    }
}
