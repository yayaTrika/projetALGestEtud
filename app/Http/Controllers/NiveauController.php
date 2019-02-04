<?php

namespace App\Http\Controllers;

use App\Model\Niveau;
use Illuminate\Http\Request;
use App\Http\Resources\Niveau\NiveauCollection;
use App\Http\Resources\Niveau\NiveauResource;
use Symfony\Component\HttpFoundation\Response;

class NiveauController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth:api')->except('index','show');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NiveauCollection::collection(Niveau::paginate(20));
        // return EtudiantCollection::collection(Etudiant::paginate(20)); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $niveau = new Niveau();
        $niveau->codeNiveau = $request->code;
        $niveau->libelleNiveau = $request->libelle;

        $niveau->save();

        return response([
            'data' => new NiveauResource($niveau)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function show(Niveau $niveau)
    {
        return new NiveauResource($niveau);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveau $niveau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveau $niveau)
    {
        // dd($request);
        $request['codeNiveau'] = $request->code;
        $request['libelleNiveau'] = $request->libelle;
        unset($request['code']);
        unset($request['libelle']);
        
        return $niveau;
        $niveau->update($request->all());

        return response([
            'data' => new NiveauResource($niveau)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niveau $niveau)
    {
        
    }
}
