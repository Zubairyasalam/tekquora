<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        $highlightId = $request->query('highlight');

        return view('admin.inquiries', compact('inquiries', 'highlightId'));
    }

    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:Open,Closed',
            'priority' => 'required|string|in:Low,Medium,High',
        ]);

        $inquiry->status = $request->status;
        $inquiry->priority = $request->priority;
        $inquiry->save();

        return redirect()->back()->with('success', 'Inquiry updated successfully!');
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully!');
    }
}
