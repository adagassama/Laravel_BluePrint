<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProduitStoreRequest;
use App\Models\Produit;
use App\Notification\ProduitStoreNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProduitController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produits = Produit::all();

        return view('produits.index', compact('produits'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produit $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * @param \App\Http\Requests\ProduitStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProduitStoreRequest $request)
    {
        $produit = Produit::create($request->validated());

        Notification::send($produit->user, new ProduitStoreNotification($produit));

        return redirect()->route('produits.index');
    }
}
