<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Curated Events</title>
    <style>
        :root {
            --bg-base: #050505; --bg-main: #121214; --bg-card: #1c1c21;
            --border: #27272a; --text-main: #ffffff; --text-muted: #9ca3af;
            --purple: #a855f7; --pink: #ec4899;
            --gradient: linear-gradient(to right, var(--purple), var(--pink));
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

        /* Header Area */
        .top-section { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
        .title h4 { font-size: 11px; color: var(--purple); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 5px; }
        .title h1 { font-size: 36px; font-weight: bold; }
        .btn-add { background: var(--gradient); border: none; padding: 12px 24px; border-radius: 25px; color: white; font-weight: bold; cursor: pointer; box-shadow: 0 0 15px rgba(168,85,247,0.3); }

        .layout-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }

        /* Tabs & List */
        .tabs-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); margin-bottom: 20px; }
        .tabs { display: flex; gap: 30px; }
        .tab { padding: 15px 0; font-size: 14px; color: var(--text-muted); cursor: pointer; border-bottom: 2px solid transparent; }
        .tab.active { color: white; border-bottom-color: var(--purple); font-weight: bold; }
        .tab-info { font-size: 11px; color: var(--text-muted); }

        .event-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 15px; display: flex; gap: 20px; margin-bottom: 15px; position: relative;}
        .event-img { width: 180px; height: 110px; background: #333; border-radius: 8px; }
        .event-badge { position: absolute; top: 15px; right: 15px; font-size: 9px; font-weight: bold; letter-spacing: 1px; padding: 4px 8px; border-radius: 4px; background: var(--bg-base); color: var(--text-muted); }
        .event-info { flex: 1; display: flex; flex-direction: column; justify-content: space-between; padding: 5px 0;}
        .event-title { font-size: 20px; font-weight: bold; margin-bottom: 8px; }
        .event-meta { font-size: 12px; color: var(--text-muted); display: flex; gap: 15px; }
        .event-bottom { display: flex; justify-content: space-between; align-items: flex-end; }
        .price-wrap { display: flex; align-items: center; gap: 10px; }
        .price { font-size: 22px; font-weight: bold; }
        .price-badge { font-size: 9px; font-weight: bold; color: var(--pink); background: rgba(236,72,153,0.1); padding: 4px 8px; border-radius: 4px; border: 1px solid rgba(236,72,153,0.3);}
        .actions { color: var(--text-muted); font-size: 16px; letter-spacing: 10px; }

        /* Form Right Side */
        .form-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 16px; padding: 25px; }
        .f-title { font-size: 20px; font-weight: bold; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;}
        .f-title span { color: var(--purple); }
        
        .dropzone { border: 2px dashed var(--border); border-radius: 12px; padding: 30px; text-align: center; margin-bottom: 25px; }
        .dropzone p { font-size: 13px; color: var(--text-muted); margin-bottom: 5px;}
        .dropzone p span { color: var(--purple); cursor: pointer; }
        .dropzone small { font-size: 9px; color: #666; letter-spacing: 1px; }

        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 10px; font-weight: bold; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .form-input { width: 100%; background: var(--bg-base); border: 1px solid var(--border); border-radius: 8px; padding: 10px 15px; color: white; font-size: 13px; outline: none;}
        .form-input:focus { border-color: var(--purple); }
        
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; }

        .btn-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 30px; }
        .btn-publish { background: var(--gradient); border: none; padding: 12px; border-radius: 8px; color: white; font-weight: bold; cursor: pointer; }
        .btn-draft { background: var(--bg-base); border: 1px solid var(--border); padding: 12px; border-radius: 8px; color: white; font-weight: bold; cursor: pointer; }
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
        <div class="top-section">
            <div class="title">
                <h4>Management</h4>
                <h1>Curated Events</h1>
            </div>
            <button class="btn-add">+ Create New Event</button>
        </div>

        <div class="layout-grid">
            <div class="col-list">
                <div class="tabs-header">
                    <div class="tabs">
                        <div class="tab active">All Events</div>
                        <div class="tab">Upcoming</div>
                        <div class="tab">Finished</div>
                    </div>
                    <div class="tab-info">Showing 24 Events</div>
                </div>

                <div class="event-card">
                    <div class="event-badge">UPCOMING</div>
                    <div class="event-img" style="background: #4c1d95;"></div>
                    <div class="event-info">
                        <div>
                            <div class="event-title">Neo-Retro Synthwave Night</div>
                            <div class="event-meta">
                                <span>📅 Oct 24, 2024</span>
                                <span>📍 Main Auditorium</span>
                                <span>👥 450/500 Quota</span>
                            </div>
                        </div>
                        <div class="event-bottom">
                            <div class="price-wrap">
                                <div class="price">$25.00</div>
                                <div class="price-badge">PAID ENTRY</div>
                            </div>
                            <div class="actions">✎ 🗑</div>
                        </div>
                    </div>
                </div>

                <div class="event-card" style="opacity: 0.7;">
                    <div class="event-badge">FINISHED</div>
                    <div class="event-img"></div>
                    <div class="event-info">
                        <div>
                            <div class="event-title">Global Tech Symposium</div>
                            <div class="event-meta">
                                <span>📅 Sep 12, 2024</span>
                                <span>📍 Hall B</span>
                                <span>👥 120/120 Quota</span>
                            </div>
                        </div>
                        <div class="event-bottom">
                            <div class="price">FREE</div>
                            <div class="actions">👁</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-form">
                <div class="form-card">
                    <div class="f-title"><span>✨</span> Event Curator</div>
                    
                    <div class="dropzone">
                        <div style="font-size: 24px; margin-bottom:10px; color:var(--text-muted)">🖼</div>
                        <p>Drop event poster or <span>browse</span></p>
                        <small>RECOMMENDED: 1200X800PX</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Event Title</label>
                        <input type="text" class="form-input" placeholder="Enter a cinematic title...">
                    </div>

                    <div class="grid-2 form-group">
                        <div>
                            <label class="form-label">Date</label>
                            <input type="text" class="form-input" placeholder="mm/dd/yyyy">
                        </div>
                        <div>
                            <label class="form-label">Location</label>
                            <input type="text" class="form-input" placeholder="Venue Hall">
                        </div>
                    </div>

                    <div class="grid-3 form-group">
                        <div>
                            <label class="form-label">Quota</label>
                            <input type="text" class="form-input" placeholder="50">
                        </div>
                        <div>
                            <label class="form-label">Price ($)</label>
                            <input type="text" class="form-input" placeholder="0.00">
                        </div>
                        <div>
                            <label class="form-label">Payment</label>
                            <select class="form-input" style="appearance: none;">
                                <option>Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="btn-row">
                        <button class="btn-publish">Publish Event</button>
                        <button class="btn-draft">Draft</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>