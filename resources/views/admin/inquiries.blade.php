@extends('layouts.admin')

@section('title', 'Inquiries Inbox - Admin CRM')

@section('page_title', 'Inquiries Inbox')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 32px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #dcfce7; color: #15803d; padding: 16px 24px; border-radius: 12px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.05);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="dash-table-card">
        <div class="dash-table-header">
            <h2>Contact Form Submissions</h2>
            <span style="font-size: 14px; color: #a3aed1; font-weight: 500;">Total messages: {{ count($inquiries) }}</span>
        </div>

        <div class="dash-table-wrapper">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th style="width: 250px;">Customer Info</th>
                        <th style="width: 140px;">Service Requested</th>
                        <th>Details / Inquiry Message</th>
                        <th style="width: 130px;">Priority</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 120px;">Date</th>
                        <th style="width: 80px; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr style="{{ $highlightId == $inquiry->id ? 'background-color: #eff6ff; border-left: 4px solid #4318ff;' : '' }}">
                            <td>
                                <div class="dash-customer-row">
                                    <div class="dash-avatar">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($inquiry->name) }}&background=4318FF&color=fff&size=36" alt="{{ $inquiry->name }}">
                                    </div>
                                    <div>
                                        <div class="dash-customer-name">{{ $inquiry->name }}</div>
                                        <div style="font-size: 12px; color: #a3aed1;">{{ $inquiry->email }}</div>
                                        @if($inquiry->company)
                                            <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-top: 2px;">
                                                🏢 {{ $inquiry->company }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 600; font-size: 13px; color: #2b3674;">
                                    @if($inquiry->service == 'ai')
                                        AI & ML
                                    @elseif($inquiry->service == 'web')
                                        Web Development
                                    @elseif($inquiry->service == 'mobile')
                                        Mobile Solutions
                                    @else
                                        Other Consulting
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div style="font-size: 14px; color: #2b3674; line-height: 1.5; white-space: pre-line; max-height: 120px; overflow-y: auto; padding-right: 8px;">
                                    {{ $inquiry->details }}
                                </div>
                            </td>
                            <td>
                                <form action="/admin/inquiries/{{ $inquiry->id }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('PUT')
                                    <!-- Hidden status input to preserve status when updating priority -->
                                    <input type="hidden" name="status" value="{{ $inquiry->status }}">
                                    
                                    <select name="priority" onchange="this.form.submit()" style="padding: 6px 10px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; border: 1px solid #e0e8ff; outline: none; width: 100%;" class="priority-{{ strtolower($inquiry->priority) }}">
                                        <option value="Low" {{ $inquiry->priority == 'Low' ? 'selected' : '' }}>Low</option>
                                        <option value="Medium" {{ $inquiry->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="High" {{ $inquiry->priority == 'High' ? 'selected' : '' }}>High</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="/admin/inquiries/{{ $inquiry->id }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('PUT')
                                    <!-- Hidden priority input to preserve priority when updating status -->
                                    <input type="hidden" name="priority" value="{{ $inquiry->priority }}">

                                    <select name="status" onchange="this.form.submit()" style="padding: 6px 10px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; border: 1px solid #e0e8ff; outline: none; width: 100%;" class="status-{{ strtolower($inquiry->status) }}">
                                        <option value="Open" {{ $inquiry->status == 'Open' ? 'selected' : '' }}>Open</option>
                                        <option value="Closed" {{ $inquiry->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="date-cell">
                                <div>{{ $inquiry->created_at->format('M d, Y') }}</div>
                                <div style="font-size: 11px; margin-top: 2px;">{{ $inquiry->created_at->format('H:i A') }}</div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; justify-content: center;">
                                    <form action="/admin/inquiries/{{ $inquiry->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dash-btn-primary" style="background-color: #ef4444; padding: 6px 10px; font-size: 12px; border-radius: 8px; display: flex; align-items: center; justify-content: center;" title="Delete Message">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 60px; color: #a3aed1;">
                                No inquiries or contact submissions found in database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
