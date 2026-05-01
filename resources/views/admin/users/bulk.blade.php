<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bulk Operations</title>
    <style>
        /* Import base variables dari atas */
        :root {
            --bg-base: #050505; --bg-main: #121214; --bg-card: #1c1c21;
            --border: #27272a; --text-main: #ffffff; --text-muted: #9ca3af;
            --purple: #a855f7; --pink: #ec4899; --red: #ef4444;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; background-color: var(--bg-base); color: var(--text-main); overflow: hidden; }
        
        .sidebar { width: 260px; padding: 30px 20px; border-right: 1px solid var(--border); display: flex; flex-direction: column; }
        .main-content { flex: 1; padding: 40px; background-color: var(--bg-main); overflow-y: auto; }
        
        .logo { font-size: 20px; font-weight: bold; color: var(--pink); letter-spacing: 1px; margin-bottom: 40px; }
        .logo span { color: var(--text-main); }
        .user-title { color: var(--purple); font-weight: bold; font-size: 14px; }
        .user-subtitle { color: var(--text-muted); font-size: 11px; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px;}
        .nav-menu { list-style: none; display: flex; flex-direction: column; gap: 15px; }
        .nav-item { color: var(--text-muted); font-size: 14px; cursor: pointer; padding: 10px; border-radius: 8px; transition: 0.3s; }
        .nav-item.active { background-color: rgba(255,255,255,0.05); color: var(--purple); border-left: 3px solid var(--purple); border-radius: 0 8px 8px 0; }

        /* Specific Styles */
        .header h1 { font-size: 32px; margin-bottom: 10px; }
        .header p { color: var(--text-muted); font-size: 14px; max-width: 60%; margin-bottom: 40px; line-height: 1.5; }

        .layout-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        
        /* Left Panel */
        .upload-box { border: 2px dashed var(--border); background: var(--bg-card); border-radius: 12px; padding: 40px 20px; text-align: center; margin-bottom: 20px; }
        .upload-icon { width: 50px; height: 50px; background: var(--bg-base); border-radius: 50%; margin: 0 auto 15px; display: flex; justify-content: center; align-items: center; color: var(--purple); font-size: 24px; }
        .upload-box h3 { margin-bottom: 10px; font-size: 18px; }
        .upload-box p { font-size: 13px; color: var(--text-muted); margin-bottom: 20px; }
        .upload-box span { color: white; }
        .btn-outline { background: transparent; border: 1px solid var(--border); color: white; padding: 10px 20px; border-radius: 20px; font-size: 13px; cursor: pointer; }

        .warning-box { background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 20px; display: flex; gap: 15px; margin-bottom: 20px; }
        .warning-icon { color: var(--red); font-size: 24px; }
        .warning-text h4 { color: #fca5a5; margin-bottom: 5px; font-size: 14px; }
        .warning-text p { color: #fecaca; font-size: 12px; line-height: 1.5; }

        .checklist-box { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 20px; }
        .checklist-title { font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: bold; margin-bottom: 15px; }
        .checklist ul { list-style: none; }
        .checklist li { font-size: 13px; color: #d1d5db; margin-bottom: 10px; display: flex; align-items: center; gap: 10px; }
        .checklist li::before { content: '✓'; color: var(--purple); font-weight: bold; }

        /* Right Panel */
        .queue-box { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 25px; display: flex; flex-direction: column; height: 100%; }
        .queue-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
        .queue-header h3 { font-size: 20px; margin-bottom: 5px; }
        .queue-header p { font-size: 12px; color: var(--text-muted); }
        .status-text { font-size: 9px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }

        .queue-list { flex: 1; overflow-y: auto; margin-bottom: 20px; }
        .queue-item { display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(0,0,0,0.2); border-radius: 8px; margin-bottom: 10px; }
        .queue-info { display: flex; align-items: center; gap: 15px; }
        .avatar-wrap { position: relative; }
        .avatar { width: 35px; height: 35px; background: #333; border-radius: 50%; }
        .cross-badge { position: absolute; bottom: -2px; right: -2px; background: var(--red); width: 14px; height: 14px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 10px; font-weight: bold; }
        .user-name { font-size: 13px; font-weight: bold; margin-bottom: 3px; }
        .user-meta { font-size: 10px; color: var(--text-muted); }
        .role-badge { font-size: 9px; font-weight: bold; letter-spacing: 1px; color: var(--pink); text-transform: uppercase; }

        .queue-footer { border-top: 1px solid var(--border); padding-top: 20px; display: flex; justify-content: space-between; align-items: center; }
        .checkbox-wrap { font-size: 12px; color: var(--text-muted); display: flex; align-items: center; gap: 10px; }
        .btn-danger { background: linear-gradient(to right, #dc2626, #db2777); border: none; padding: 12px 24px; border-radius: 8px; color: white; font-weight: bold; cursor: pointer; box-shadow: 0 0 15px rgba(225,29,72,0.3); }

        /* Footer Stats */
        .footer-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--border); }
        .f-stat { border-left: 2px solid; padding-left: 15px; }
        .f-stat-title { font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .f-stat-value { font-size: 24px; font-weight: bold; }
        .f-stat-value span { font-size: 12px; font-weight: normal; color: var(--text-muted); margin-left: 5px;}
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Campus<span>Admin</span></div>
        <div class="user-title">Nocturnal Curator</div>
        <div class="user-subtitle">System Administrator</div>
        <ul class="nav-menu">
            <a href="/admin/dashboard.blade.php"><li class="nav-item active">Dashboard</li></a>
            <a href="/admin/users/index.blade.php"><li class="nav-item">User Management</li></a>
            <a href="/admin/events/index.blade.php"><li class="nav-item">Event Management</li></a>
            <a href="/admin/users/bulk.blade.php"><li class="nav-item">Bulk Operations</li></a>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Bulk Account Removal</h1>
            <p>Streamline your administrative workflow. Import Excel or CSV files to decommission multiple student and staff accounts simultaneously.</p>
        </div>

        <div class="layout-grid">
            <div class="col-left">
                <div class="upload-box">
                    <div class="upload-icon">☁</div>
                    <h3>Import Removal List</h3>
                    <p>Drag and drop your <span>.xlsx</span> or <span>.csv</span> file here to begin the parsing process.</p>
                    <button class="btn-outline">Select File</button>
                </div>

                <div class="warning-box">
                    <div class="warning-icon">⚠</div>
                    <div class="warning-text">
                        <h4>Destructive Action</h4>
                        <p>Deleting accounts is irreversible. This will purge all associated academic records, event logs, and metadata for both Panitia and Peserta roles. Ensure you have a local backup.</p>
                    </div>
                </div>

                <div class="checklist-box">
                    <div class="checklist-title">Requirement Checklist</div>
                    <ul class="checklist">
                        <li>Column A: Unique User ID (NIM/NIP)</li>
                        <li>Valid Role: Panitia or Peserta only</li>
                        <li>Maximum 500 records per batch</li>
                    </ul>
                </div>
            </div>

            <div class="col-right">
                <div class="queue-box">
                    <div class="queue-header">
                        <div>
                            <h3>Removal Queue</h3>
                            <p>5 accounts detected in last_import.csv</p>
                        </div>
                        <div class="status-text">Pending Verification</div>
                    </div>

                    <div class="queue-list">
                        <!-- Ulangi div ini sesuai jumlah user -->
                        <div class="queue-item">
                            <div class="queue-info">
                                <div class="avatar-wrap">
                                    <div class="avatar"></div>
                                    <div class="cross-badge">×</div>
                                </div>
                                <div>
                                    <div class="user-name">Aditya Pratama</div>
                                    <div class="user-meta">NIM: 2021081024 • Batch 2021</div>
                                </div>
                            </div>
                            <div class="role-badge">PESERTA</div>
                        </div>
                        <div class="queue-item">
                            <div class="queue-info">
                                <div class="avatar-wrap">
                                    <div class="avatar"></div>
                                    <div class="cross-badge">×</div>
                                </div>
                                <div>
                                    <div class="user-name">Siti Rahmawati</div>
                                    <div class="user-meta">NIM: 2019082210 • Batch 2019</div>
                                </div>
                            </div>
                            <div class="role-badge">PANITIA</div>
                        </div>
                    </div>

                    <div class="queue-footer">
                        <label class="checkbox-wrap">
                            <input type="checkbox"> I confirm these accounts are correct for deletion.
                        </label>
                        <button class="btn-danger">Execute Batch Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-stats">
            <div class="f-stat" style="border-color: var(--purple);">
                <div class="f-stat-title">Total Deletion Capacity</div>
                <div class="f-stat-value">2,500 <span>per day</span></div>
            </div>
            <div class="f-stat" style="border-color: var(--pink);">
                <div class="f-stat-title">Deleted This Month</div>
                <div class="f-stat-value">412 <span>users purged</span></div>
            </div>
            <div class="f-stat" style="border-color: var(--red);">
                <div class="f-stat-title">Recovery Window</div>
                <div class="f-stat-value">0Hr <span style="color:var(--red);">Permanent</span></div>
            </div>
        </div>
    </div>
</body>
</html>