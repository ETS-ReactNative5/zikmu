<?php

namespace App\Http\Controllers;

use App\Http\Requests\Newsletter as RequestsNewsletter;
use App\Http\Requests\newsletterUnsub;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(RequestsNewsletter $request)
    {
        $newsletter = new Newsletter($request->validated());
        $newsletter->newsletter_email = $request->validated()['newsletter_email'];
        $newsletter->save();
        return back()->with('success', 'Vous êtes désormais abonné a notre newsletter');
    }

    public function unsubscribe()
    {
        return view('pages.newsletter');
    }

    public function exec_unsub(newsletterUnsub $request)
    {
        $newsletter = Newsletter::where('newsletter_email', $request->validated()['newsletter_email'])->take(1)->get();
        $message = "";
        $type = "success";
        if(count($newsletter) > 0){
            foreach($newsletter as $item){
                $item->delete();
            }
            $message = "Votre désinscription a bien été prise en compte";
        }else{
            $type = "warning";
            $message = "Aucun compte trouvé";
        }
        return back()->with($type, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
