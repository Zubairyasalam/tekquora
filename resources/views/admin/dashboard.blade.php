@extends('layouts.admin')

@section('title', 'Admin Dashboard - TekQuora')

@section('page_title', 'Dashboard Overview')

@section('content')
<div class="dash-content-container" style="padding: 10px 0;">

    <!-- Top Action Row -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
        <h1 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 28px; font-weight: 800; color: #1b2559; margin: 0;">Home</h1>
        <a href="/admin/inquiries" style="background: #0061ff; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(0, 97, 255, 0.3); transition: all 0.2s;" onmouseover="this.style.background='#0052d6'" onmouseout="this.style.background='#0061ff'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            + Automation
        </a>
    </div>

    <!-- Analytics Box -->
    <div class="dash-table-card" style="padding: 28px; margin-bottom: 24px; border-radius: 20px; background: #ffffff; box-shadow: 0 10px 30px rgba(112, 144, 176, 0.08); border: 1px solid #f1f5f9;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <h2 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 20px; font-weight: 700; color: #1b2559; margin: 0;">My Automation Analytics</h2>
            <div style="background: #f4f7fe; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; color: #a3aed0; display: flex; align-items: center; gap: 8px; border: 1px solid #e9edf7;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ date('m/01/Y') }} - {{ date('m/d/Y') }}
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <!-- Blue Box -->
            <div style="background: #e8f2ff; border-radius: 16px; padding: 22px; position: relative; border: 1px solid rgba(0, 97, 255, 0.05);">
                <div style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px;">All Time</div>
                <div style="font-size: 26px; font-weight: 800; color: #0061ff; margin-bottom: 4px;">{{ $totalProjects ?? 12 }}</div>
                <div style="font-size: 12px; font-weight: 500; color: #64748b;">Active Projects Showcased</div>
                <div style="position: absolute; top: 20px; right: 20px; width: 38px; height: 38px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #0061ff; box-shadow: 0 4px 10px rgba(0,0,0,0.04);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
            </div>

            <!-- Purple Box -->
            <div style="background: #f3e8ff; border-radius: 16px; padding: 22px; position: relative; border: 1px solid rgba(124, 58, 237, 0.05);">
                <div style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px;">Sent Emails</div>
                <div style="font-size: 26px; font-weight: 800; color: #7c3aed; margin-bottom: 4px;">{{ $openInquiries ?? 5 }}</div>
                <div style="font-size: 12px; font-weight: 500; color: #64748b;">Open Contact Inquiries</div>
                <div style="position: absolute; top: 20px; right: 20px; width: 38px; height: 38px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #7c3aed; box-shadow: 0 4px 10px rgba(0,0,0,0.04);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
            </div>

            <!-- Green Box -->
            <div style="background: #e8fff3; border-radius: 16px; padding: 22px; position: relative; border: 1px solid rgba(22, 163, 74, 0.05);">
                <div style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px;">Open Rate</div>
                <div style="font-size: 26px; font-weight: 800; color: #16a34a; margin-bottom: 4px;">{{ $closedInquiries ?? 8 }}</div>
                <div style="font-size: 12px; font-weight: 500; color: #64748b;">Resolved Lead Messages</div>
                <div style="position: absolute; top: 20px; right: 20px; width: 38px; height: 38px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #16a34a; box-shadow: 0 4px 10px rgba(0,0,0,0.04);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
            </div>

            <!-- Orange Box -->
            <div style="background: #fff4e8; border-radius: 16px; padding: 22px; position: relative; border: 1px solid rgba(234, 88, 12, 0.05);">
                <div style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px;">Click Rate</div>
                <div style="font-size: 26px; font-weight: 800; color: #ea580c; margin-bottom: 4px;">{{ $totalInquiries ?? 13 }}</div>
                <div style="font-size: 12px; font-weight: 500; color: #64748b;">Total Leads Captured</div>
                <div style="position: absolute; top: 20px; right: 20px; width: 38px; height: 38px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #ea580c; box-shadow: 0 4px 10px rgba(0,0,0,0.04);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Outreach & Automation Row -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
        <!-- Left Card -->
        <div class="dash-table-card" style="padding: 28px; border-radius: 20px; background: #ffffff; box-shadow: 0 10px 30px rgba(112, 144, 176, 0.08); border: 1px solid #f1f5f9; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 18px; font-weight: 700; color: #1b2559; margin: 0;">Connect Email Outreach</h3>
                    <span style="color: #a3aed0; font-weight: 800; letter-spacing: 2px;">...</span>
                </div>
                <p style="font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 24px;">Connect your account inquiries to our outreach deliverability tools and respond to customer questions instantly.</p>
            </div>
            <a href="/admin/inquiries" style="display: block; text-align: center; border: 1.5px solid #0061ff; color: #0061ff; padding: 12px; border-radius: 12px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#0061ff'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#0061ff';">Connect Email</a>
        </div>

        <!-- Right Card -->
        <div class="dash-table-card" style="padding: 28px; border-radius: 20px; background: #ffffff; box-shadow: 0 10px 30px rgba(112, 144, 176, 0.08); border: 1px solid #f1f5f9; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 18px; font-weight: 700; color: #1b2559; margin: 0;">Create a new Automation</h3>
                    <span style="color: #a3aed0; font-weight: 800; letter-spacing: 2px;">...</span>
                </div>
                <p style="font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 24px;">Use our automation and project showcase builder to publish innovative digital solutions and capture warm leads.</p>
            </div>
            <a href="/admin/projects" style="display: block; text-align: center; border: 1.5px solid #0061ff; color: #0061ff; padding: 12px; border-radius: 12px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#0061ff'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#0061ff';">Create Automation</a>
        </div>
    </div>

    <!-- Bottom Row: Activation Steps & Unicorn Inbox -->
    <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px;">
        <!-- Activation Steps & Email Automation -->
        <div class="dash-table-card" style="padding: 28px; border-radius: 20px; background: #ffffff; box-shadow: 0 10px 30px rgba(112, 144, 176, 0.08); border: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 18px; font-weight: 700; color: #1b2559; margin: 0;">Activation Steps</h3>
                <a href="/admin/services" style="font-size: 13px; font-weight: 600; color: #a3aed0; text-decoration: none;">View All</a>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: #f3e8ff; color: #7c3aed; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #1b2559;">Configure Hero & Header</div>
                            <div style="font-size: 12px; color: #a3aed0;">Active website branding</div>
                        </div>
                    </div>
                    <span style="font-size: 12px; font-weight: 600; color: #a3aed0;">Completed</span>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: #e8f2ff; color: #0061ff; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #1b2559;">Connect Contact Inquiries</div>
                            <div style="font-size: 12px; color: #a3aed0;">Automatic lead routing</div>
                        </div>
                    </div>
                    <span style="font-size: 12px; font-weight: 600; color: #16a34a;">Active</span>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 0;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: #fff4e8; color: #ea580c; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #1b2559;">Meet Our Team Setup</div>
                            <div style="font-size: 12px; color: #a3aed0;">Showcase leadership profiles</div>
                        </div>
                    </div>
                    <span style="font-size: 12px; font-weight: 600; color: #16a34a;">Active</span>
                </div>
            </div>
        </div>

        <!-- Unicorn Inbox -->
        <div class="dash-table-card" style="padding: 28px; border-radius: 20px; background: #ffffff; box-shadow: 0 10px 30px rgba(112, 144, 176, 0.08); border: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 18px; font-weight: 700; color: #1b2559; margin: 0;">Unicorn Inbox</h3>
                <div style="background: #f4f7fe; padding: 4px 10px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #64748b;">All v</div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 12px;">
                @forelse($recentInquiries as $inquiry)
                    <div style="padding: 14px; border-radius: 14px; background: #f8fafc; border: 1px solid #f1f5f9; display: flex; flex-direction: column; gap: 8px; transition: all 0.2s;" onmouseover="this.style.background='#ffffff'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.04)'" onmouseout="this.style.background='#f8fafc'; this.style.boxShadow='none'">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($inquiry->name) }}&background=0061FF&color=fff&size=32" alt="{{ $inquiry->name }}" style="width: 32px; height: 32px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b2559;">{{ $inquiry->name }}</div>
                                    <div style="font-size: 11px; color: #16a34a; font-weight: 600; display: flex; align-items: center; gap: 4px;">
                                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #16a34a; display: inline-block;"></span> Online
                                    </div>
                                </div>
                            </div>
                            <span style="background: #fff4e8; color: #ea580c; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px; display: flex; align-items: center; gap: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/></svg>
                                Inbox
                            </span>
                        </div>
                        <p style="font-size: 13px; color: #64748b; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $inquiry->details }}</p>
                    </div>
                @empty
                    <!-- Fallback sample messages matching screenshot if empty -->
                    <div style="padding: 14px; border-radius: 14px; background: #f8fafc; border: 1px solid #f1f5f9; display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="https://ui-avatars.com/api/?name=Qualified+Leads&background=0061FF&color=fff&size=32" style="width: 32px; height: 32px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b2559;">Qualified Leads</div>
                                    <div style="font-size: 11px; color: #16a34a; font-weight: 600; display: flex; align-items: center; gap: 4px;">
                                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #16a34a; display: inline-block;"></span> Online
                                    </div>
                                </div>
                            </div>
                            <span style="background: #fff4e8; color: #ea580c; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px;">Inbox</span>
                        </div>
                        <p style="font-size: 13px; color: #64748b; margin: 0;">We are looking for an AI solutions partner to scale our operations.</p>
                    </div>

                    <div style="padding: 14px; border-radius: 14px; background: #f8fafc; border: 1px solid #f1f5f9; display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="https://ui-avatars.com/api/?name=Emily+Butler&background=7C3AED&color=fff&size=32" style="width: 32px; height: 32px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b2559;">Emily Butler</div>
                                    <div style="font-size: 11px; color: #16a34a; font-weight: 600; display: flex; align-items: center; gap: 4px;">
                                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #16a34a; display: inline-block;"></span> Online
                                    </div>
                                </div>
                            </div>
                            <span style="background: #fff4e8; color: #ea580c; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px;">Inbox</span>
                        </div>
                        <p style="font-size: 13px; color: #64748b; margin: 0;">Can we schedule a call tomorrow to discuss web development?</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection
