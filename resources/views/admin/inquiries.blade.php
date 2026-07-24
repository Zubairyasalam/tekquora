@extends('layouts.admin')

@section('title', 'Inquiries Inbox - Admin CRM')

@section('page_title', 'Inquiries Inbox')

@section('content')
<div class="dash-content-container" style="display: flex; flex-direction: column; gap: 24px;">

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; padding: 14px 20px; border-radius: 14px; font-weight: 600; display: flex; align-items: center; gap: 12px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.08);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Top Summary Metrics Row -->
    @php
        $totalCount = count($inquiries);
        $openCount = $inquiries->where('status', 'Open')->count();
        $closedCount = $inquiries->where('status', 'Closed')->count();
        $highPriorityCount = $inquiries->where('priority', 'High')->count();
    @endphp

    <div class="dash-stats-row">
        <div class="dash-stat-card">
            <div class="dash-stat-icon icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div class="dash-stat-info">
                <h3>{{ $totalCount }}</h3>
                <p>Total Messages</p>
            </div>
        </div>

        <div class="dash-stat-card">
            <div class="dash-stat-icon icon-green">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="dash-stat-info">
                <h3>{{ $openCount }}</h3>
                <p>Open Inquiries</p>
            </div>
        </div>

        <div class="dash-stat-card">
            <div class="dash-stat-icon icon-orange">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="dash-stat-info">
                <h3>{{ $highPriorityCount }}</h3>
                <p>High Priority</p>
            </div>
        </div>

        <div class="dash-stat-card">
            <div class="dash-stat-icon icon-red" style="background-color: #f3e8ff; color: #7e22ce;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div class="dash-stat-info">
                <h3>{{ $closedCount }}</h3>
                <p>Closed</p>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="dash-table-card">
        <div class="dash-table-header">
            <div>
                <h2 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 18px; color: #0f172a;">Contact Form Submissions</h2>
                <span style="font-size: 13px; color: #64748b; font-weight: 500;">Manage incoming customer inquiries & status tracking</span>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; background: #f8fafc; border: 1px solid #e2e8f0; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; color: #0061ff;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #0061ff; display: inline-block;"></span>
                Total messages: {{ $totalCount }}
            </div>
        </div>

        <div class="dash-table-wrapper">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th style="width: 240px;">Customer Info</th>
                        <th style="width: 150px;">Service Requested</th>
                        <th>Details / Inquiry Message</th>
                        <th style="width: 130px;">Priority</th>
                        <th style="width: 125px;">Status</th>
                        <th style="width: 130px;">Date</th>
                        <th style="width: 70px; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr style="{{ $highlightId == $inquiry->id ? 'background-color: #eff6ff; border-left: 4px solid #0061ff;' : '' }}">
                            <td>
                                <div class="dash-customer-row">
                                    <div class="dash-avatar-wrapper">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($inquiry->name) }}&background=0061ff&color=fff&size=42&bold=true" alt="{{ $inquiry->name }}" class="dash-avatar-img">
                                    </div>
                                    <div style="display: flex; flex-direction: column;">
                                        <span class="dash-customer-name">{{ $inquiry->name }}</span>
                                        <span class="dash-customer-email">{{ $inquiry->email }}</span>
                                        @if($inquiry->company)
                                            <span class="company-badge">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v8h4"/><path d="M18 9h2a2 2 0 0 1 2 2v11h-4"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                                                {{ $inquiry->company }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($inquiry->service == 'ai')
                                    <span class="service-pill service-ai">🤖 AI & ML</span>
                                @elseif($inquiry->service == 'web')
                                    <span class="service-pill service-web">💻 Web Dev</span>
                                @elseif($inquiry->service == 'mobile')
                                    <span class="service-pill service-mobile">📱 Mobile App</span>
                                @else
                                    <span class="service-pill service-other">💡 Consulting</span>
                                @endif
                            </td>
                            <td>
                                <div class="message-box">
                                    {{ $inquiry->details }}
                                </div>
                            </td>
                            <td>
                                <form action="/admin/inquiries/{{ $inquiry->id }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ $inquiry->status }}">
                                    
                                    <select name="priority" onchange="this.form.submit()" class="priority-select priority-{{ strtolower($inquiry->priority) }}">
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
                                    <input type="hidden" name="priority" value="{{ $inquiry->priority }}">

                                    <select name="status" onchange="this.form.submit()" class="status-select status-{{ strtolower($inquiry->status) }}">
                                        <option value="Open" {{ $inquiry->status == 'Open' ? 'selected' : '' }}>Open</option>
                                        <option value="Closed" {{ $inquiry->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="date-cell">
                                <div style="font-weight: 700; color: #0f172a;">{{ $inquiry->created_at->format('M d, Y') }}</div>
                                <div class="time-sub">{{ $inquiry->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; justify-content: center;">
                                    <form action="/admin/inquiries/{{ $inquiry->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?')" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dash-btn-delete" title="Delete Message">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 60px; color: #94a3b8; font-weight: 500;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 12px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <div>No inquiries or contact submissions found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
