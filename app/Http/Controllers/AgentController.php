<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentRequest;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.agent.index', ['agents' => Agent::with('ots_receptionner', 'ots_tester')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agent.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgentRequest $request)
    {
        //dd($request);
        $agentFind = Agent::where('name', strtoupper($request->input('name')))->first();
        if ($agentFind) {
            $request->session()->flash('message', 'Agent ' . $agentFind->name . ' Existe');
            return redirect()->route('agents.index');
        }
        $agent = new Agent();

        $agent->name = strtoupper($request->input('name'));

        $agent->save();

        $request->session()->flash('message', 'Agent ' . $agent->name . ' has been added');

        return redirect()->route('agents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        return view('admin.agent.edit')->with(['agent' => $agent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(AgentRequest $request, Agent $agent)
    {
        $agent = Agent::find($agent->id);

        $agent->name = strtoupper($request->input('name'));

        $agent->save();

        $request->session()->flash('message', ' Agent ' . $agent->name . ' has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        $id = $agent->id;

        if (is_null($id) || empty($id)) {

            return redirect()->route('agents.index');
        }


        Agent::destroy($id);

        return redirect()->route('agents.index');
    }
}
