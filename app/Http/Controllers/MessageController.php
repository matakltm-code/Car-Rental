<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // manager
    // |-> view report from rental officer
    // |-> send report for rental officer
    // |-> view feedback from customer
    public function view_report_from_rental_officer()
    {
        // Check user is manager
        if (auth()->user()->user_type != 'manager') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // Get all reservation
        $messages = Message::where('sender_user_type', 'rentalofficer')->where('reciver_user_type', 'manager')->orderBy('created_at', 'DESC')->paginate(10);
        return view('manager.report.rental-officer-reports', [
            'messages' => $messages
        ]);
    }
    public function send_report_for_rental_officer()
    {
        return view('manager.report.create-report-for-rental-officer');
    }
    public function store_send_report_for_rental_officer(Request $request)
    {
        // Check user is manager
        if (auth()->user()->user_type != 'manager') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // dd($request);
        $data = $request->validate([
            'title' => 'required|string',
            'detail' => 'required|string'
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'sender_user_type' => 'manager',
            'reciver_user_type' => 'rentalofficer',
            'title' => $data['title'],
            'detail' => $data['detail'],
            'message_type' => 'report',
        ]);
        return back()->with('success', 'Report sent successfuly');
    }
    public function view_feedback_from_customer()
    {
        // Check user is manager
        if (auth()->user()->user_type != 'manager') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // Get all reservation
        $messages = Message::where('sender_user_type', 'customer')->where('reciver_user_type', 'manager')->orderBy('created_at', 'DESC')->paginate(10);
        return view('manager.feedback.customer-feedbacks', [
            'messages' => $messages
        ]);
    }



    // rentalofficer
    // |-> send report for manager
    // |-> view report from driver
    public function send_report_for_manager()
    {
        return view('rentalofficer.report.create');
    }
    public function store_send_report_for_manager(Request $request)
    {
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // dd($request);
        $data = $request->validate([
            'title' => 'required|string',
            'detail' => 'required|string'
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'sender_user_type' => 'rentalofficer',
            'reciver_user_type' => 'manager',
            'title' => $data['title'],
            'detail' => $data['detail'],
            'message_type' => 'report',
        ]);
        return back()->with('success', 'Report sent to manager');
    }
    public function view_report_from_manager()
    {
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // Get all reservation
        $messages = Message::where('sender_user_type', 'manager')->where('reciver_user_type', 'rentalofficer')->orderBy('created_at', 'DESC')->paginate(10);
        return view('rentalofficer.report.manager-reports', [
            'messages' => $messages
        ]);
    }
    public function view_report_from_driver()
    {
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // Get all reservation
        $messages = Message::where('sender_user_type', 'driver')->where('reciver_user_type', 'rentalofficer')->orderBy('created_at', 'DESC')->paginate(10);
        return view('rentalofficer.report.driver-reports', [
            'messages' => $messages
        ]);
    }



    // driver -> send report for rental officer
    public function send_report_for_rental_officer_from_driver()
    {
        return view('driver.report.create');
    }
    public function store_send_report_for_rental_officer_from_driver(Request $request)
    {
        // Check user is driver
        if (auth()->user()->user_type != 'driver') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // dd($request);
        $data = $request->validate([
            'title' => 'required|string',
            'detail' => 'required|string'
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'sender_user_type' => 'driver',
            'reciver_user_type' => 'rentalofficer',
            'title' => $data['title'],
            'detail' => $data['detail'],
            'message_type' => 'report',
        ]);
        return back()->with('success', 'Report sent successfuly!');
    }



    // customer -> send feedback for manager
    public function send_feedback_for_manager()
    {
        return view('customer.feedback.create');
    }
    public function store_send_feedback_for_manager(Request $request)
    {
        // Check user is customer
        if (auth()->user()->user_type != 'customer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // dd($request);
        $data = $request->validate([
            'title' => 'required|string',
            'detail' => 'required|string'
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'sender_user_type' => 'customer',
            'reciver_user_type' => 'manager',
            'title' => $data['title'],
            'detail' => $data['detail'],
            'message_type' => 'feedback',
        ]);
        return back()->with('success', 'Thank you for your feedback!');
    }





    public function destroy(Message $message)
    {
        //
    }
}
