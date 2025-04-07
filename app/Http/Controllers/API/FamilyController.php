<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Family;
use App\Models\FamilyInvite;
use App\Models\Notification;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $members = [];
      if($request->user()->family_id){
        $family = Family::find($request->user()->family_id);
        if($family) {
          $members = $request->user()->family->members->pluck('id')->toArray();
        }
      }
      $phone = $request->search;
      $results = $phone != '' ? Customer::select('id', 'phone')->whereNotIn('id', $members)->where('phone', 'like', '%'.$phone.'%')->get() : [];
      return response()->json([
        'status' => true,
        'results' => $results
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->user()->update(['family_id'=>$request->family_id, 'family_joined_at'=>now()]);
      FamilyInvite::find($request->invite_id)->update(['status'=>'accepted']);
      if($request->has('notification_id') && $request->notification_id != '') {
        $data = [
          'invite_id' => $request->invite_id,
          'family_id' => $request->family_id,
          'status' => 'Accepted'
        ];
        Notification::find($request->notification_id)->update(['data'=>$data]);
      }
      return response()->json([
        'status' => true,
        'message' => 'Request accepted successfully.'
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
      if($id == 'invites'){
        $invites = FamilyInvite::select('id','sender_id','family_id')->with('inviter:id,name,phone')->where('receiver_id', $request->user()->id)->latest()->get();
        return response()->json([
          'status' => true,
          'invites' => $invites
        ]);
      }

      if($id == 'members'){
        $family = Family::find($request->user()->family_id);
        $members = [];$head=[];
        if($family && $family->has('members')){
          $key = 0;
          foreach ($family->members as $member) {
            if($family->head->id != $member->id) {
              $members[$key]['id'] = $member->id;
              $members[$key]['name'] = $member->name;
              $members[$key]['email'] = $member->email;
              $members[$key]['phone'] = $member->phone;
              $members[$key]['gender'] = $member->gender;
              $members[$key]['latitude'] = $member->latitude;
              $members[$key]['longitude'] = $member->longitude;
              $key++;
            }
          }
        }
        if($family){
          $head['id'] = $family->head->id;
          $head['name'] = $family->head->name;
          $head['email'] = $family->head->email;
          $head['phone'] = $family->head->phone;
          $head['gender'] = $family->head->gender;
          $head['latitude'] = $family->head->latitude;
          $head['longitude'] = $family->head->longitude;
        }
        return response()->json([
          'status' => true,
          'head' => $head,
          'members' => $members,
        ]);
      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      if(!$request->user()->family_id){
        $family = Family::create(['head_id'=>$request->user()->id]);
        $request->user()->update(['family_id'=>$family->id, 'family_joined_at'=>now()]);
      }else{
        $family = Family::find($request->user()->family_id);
      }
      $data['sender_id'] = $request->user()->id;
      $data['receiver_id'] = $id;
      $data['family_id'] = $family->id;
      
      $invite = FamilyInvite::create($data);
      Notification::create([
        'data' => [
            'invite_id' => $invite->id,
            'family_id' => $invite->family_id,
            'status' => 'Pending'
        ],
        'type' => 'family-invite',
        'customer_id' => $id,
        'message' => $request->user()->name.' is inviting you to join his family.',
        'is_read' => false,
      ]);
      return response()->json([
        'status' => true,
        'message' => 'Invite sent to user.'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
      if($id == 'quit'){
        $family = Family::find($request->user()->family_id);
        if(!$family) {
          return response()->json([
            'status' => false,
            'message' => 'No family found.'
          ]);
        }
        if($family->head_id == $request->user()->id) {
          if(count($family->members) > 1) {
            $family->update(['head_id'=>$family->firstMember()->id]);
          }else{
            $family->delete();
          }
        }
        $request->user()->update(['family_id'=> null, 'family_joined_at'=>null]);
        return response()->json([
          'status' => true,
          'message' => 'Exited from family successfully.'
        ]);
      }
      FamilyInvite::find($id)->update(['status'=>'rejected']);
      $invite = FamilyInvite::find($id);
      if($request->has('notification_id') && $request->notification_id != '') {
        $data = [
          'invite_id' => $invite->id,
          'family_id' => $request->family_id,
          'status' => 'Rejected'
        ];
        Notification::find($request->notification_id)->update(['data'=>$data]);
      }
      return response()->json([
        'status' => true,
        'message' => 'Request rejected successfully.'
      ]);
    }
}
