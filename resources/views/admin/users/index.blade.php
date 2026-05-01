<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Identity Matrix</title>
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
        .main-content { flex: 1; padding: 40px; background-color: var(--bg-main); overflow-y: auto; position: relative;}
        
        .logo { font-size: 20px; font-weight: bold; color: var(--pink); letter-spacing: 1px; margin-bottom: 40px; }
        .logo span { color: var(--text-main); }
        .user-title { color: var(--purple); font-weight: bold; font-size: 14px; }
        .user-subtitle { color: var(--text-muted); font-size: 11px; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px;}
        .nav-menu { list-style: none; display: flex; flex-direction: column; gap: 15px; }
        .nav-item { color: var(--text-muted); font-size: 14px; cursor: pointer; padding: 10px; border-radius: 8px; transition: 0.3s; }
        .nav-item.active { background-color: rgba(255,255,255,0.05); color: var(--purple); border-left: 3px solid var(--purple); border-radius: 0 8px 8px 0; }

        /* Header Area */
        .top-section { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; }
        .title h1 { font-size: 48px; font-weight: 800; margin-bottom: 10px; letter-spacing: -1px; }
        .title h1 span { color: var(--purple); font-style: italic; font-weight: normal; font-family: Georgia, serif;}
        .title p { color: var(--text-muted); font-size: 14px; max-width: 500px; line-height: 1.5; }
        
        .stat-blocks { display: flex; gap: 15px; }
        .stat-box { background: var(--bg-card); border: 1px solid var(--border); padding: 15px 20px; border-radius: 12px; text-align: center; min-width: 130px;}
        .stat-box.gradient-box { background: linear-gradient(to bottom, rgba(168,85,247,0.2), transparent); border-color: rgba(168,85,247,0.3); }
        .s-title { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; font-weight: bold; margin-bottom: 5px; }
        .s-val { font-size: 26px; font-weight: bold; }

        /* Controls */
        .controls { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .tabs { background: var(--bg-card); border: 1px solid var(--border); border-radius: 30px; padding: 5px; display: flex; gap: 5px; }
        .tab-btn { background: transparent; border: none; color: var(--text-muted); padding: 8px 20px; border-radius: 20px; font-size: 13px; font-weight: bold; cursor: pointer; }
        .tab-btn.active { background: var(--bg-base); color: white; }
        .btn-add { background: var(--gradient); border: none; padding: 10px 24px; border-radius: 20px; color: white; font-weight: bold; cursor: pointer; box-shadow: 0 0 15px rgba(168,85,247,0.3); }

        /* Table Area */
        .table-container { background: var(--bg-card); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
        .t-row { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; align-items: center; padding: 15px 25px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .t-head { font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: bold; letter-spacing: 1px; }
        
        .t-row:not(.t-head):hover { background-color: rgba(255,255,255,0.02); }
        .t-row.selected { background-color: rgba(0,0,0,0.3); border-left: 3px solid var(--purple); }

        .user-col { display: flex; align-items: center; gap: 15px; }
        .u-initial { width: 40px; height: 40px; border-radius: 8px; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 14px; }
        .bg-p { background: rgba(168,85,247,0.2); color: #d8b4fe; }
        .bg-img { background: #333; }
        .u-name { font-size: 14px; font-weight: bold; margin-bottom: 2px; }
        .u-email { font-size: 11px; color: var(--text-muted); }

        .role-tag { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; letter-spacing: 1px; display: inline-block;}
        .r-admin { background: var(--bg-base); color: var(--text-muted); border: 1px solid var(--border); }
        .r-panitia { background: rgba(236,72,153,0.1); color: var(--pink); border: 1px solid rgba(236,72,153,0.3); }

        .status-col { font-size: 13px; color: #d1d5db; display: flex; align-items: center; gap: 8px; }
        .dot { width: 8px; height: 8px; border-radius: 50%; background: #22c55e; }
        .dot.offline { background: var(--border); }
        .dot.deactivated { background: var(--red); }

        .action-col { text-align: right; color: var(--text-muted); font-size: 16px; letter-spacing: 10px; cursor: pointer;}
        
        /* Popup Insight */
        .insight-popup { position: absolute; bottom: 40px; right: 40px; width: 300px; background: var(--bg-card); border: 1px solid rgba(168,85,247,0.5); border-radius: 12px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 20px rgba(168,85,247,0.1); }
        .ip-header { display: flex; justify-content: space-between; font-size: 10px; color: var(--purple); font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;}
        .ip-user { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .ip-details { border-bottom: 1px solid var(--border); padding-bottom: 10px; margin-bottom: 15px; }
        .ip-row { display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px; }
        .ip-row span:first-child { color: var(--text-muted); }
        .progress-bg { width: 100%; height: 6px; background: var(--bg-base); border-radius: 3px; margin-bottom: 5px; }
        .progress-bar { width: 85%; height: 100%; background: var(--gradient); border-radius: 3px; }
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
                <h1>Identity <span>Matrix</span></h1>
                <p>Orchestrate campus roles and permissions from a single atmospheric nexus. Managing 2,491 active digital entities across the network.</p>
            </div>
            <div class="stat-blocks">
                <div class="stat-box">
                    <div class="s-title" style="color: var(--purple);">Network Health</div>
                    <div class="s-val">99.2<span style="font-size:14px;">%</span></div>
                </div>
                <div class="stat-box gradient-box">
                    <div class="s-title" style="color: var(--pink);">Growth Metric</div>
                    <div class="s-val">+124</div>
                    <div style="font-size: 10px; color: var(--text-muted);">Active this wk</div>
                </div>
            </div>
        </div>

        <div class="controls">
            <div class="tabs">
                <button class="tab-btn active">All Roles</button>
                <button class="tab-btn">Admin</button>
                <button class="tab-btn">Panitia</button>
                <button class="tab-btn">Peserta</button>
            </div>
            <button class="btn-add">+ Onboard New User</button>
        </div>

        <div class="table-container">
            <div class="t-row t-head">
                <div>Entity Name</div>
                <div>Current Role</div>
                <div>Access Status</div>
                <div style="text-align: right;">Operational Actions</div>
            </div>
            
            <div class="t-row">
                <div class="user-col">
                    <div class="u-initial bg-p">BS</div>
                    <div>
                        <div class="u-name">Bastian Setya</div>
                        <div class="u-email">bastian.s@campus.edu</div>
                    </div>
                </div>
                <div><span class="role-tag r-admin">ADMIN</span></div>
                <div class="status-col"><span class="dot"></span> Active</div>
                <div class="action-col">✎ ⊘ 🗑</div>
            </div>

            <div class="t-row selected">
                <div class="user-col">
                    <div class="u-initial bg-img"></div>
                    <div>
                        <div class="u-name">Lestari Ananta</div>
                        <div class="u-email">lestari.a@event.com</div>
                    </div>
                </div>
                <div><span class="role-tag r-panitia">PANITIA</span></div>
                <div class="status-col"><span class="dot"></span> Active</div>
                <div class="action-col" style="color: white;">✎ <span style="color:var(--text-muted)">⊘ 🗑</span></div>
            </div>

            <div class="t-row">
                <div class="user-col">
                    <div class="u-initial" style="background:rgba(255,255,255,0.1); color:#ccc;">DK</div>
                    <div>
                        <div class="u-name">Dini Kartika</div>
                        <div class="u-email">dkartika99@student.univ.id</div>
                    </div>
                </div>
                <div><span class="role-tag r-admin">PESERTA</span></div>
                <div class="status-col"><span class="dot offline"></span> Offline</div>
                <div class="action-col">✎ ⊘ 🗑</div>
            </div>
        </div>
        <div style="font-size: 11px; color: var(--text-muted); margin-top: 15px;">Showing 1 to 4 of 2,491 identities</div>

        <!-- Floating Insight Box -->
        <div class="insight-popup">
            <div class="ip-header">
                <span>Selected Insight</span>
                <span style="color:var(--text-muted); cursor:pointer;">×</span>
            </div>
            <div class="ip-user">
                <div class="u-initial bg-img" style="border-radius: 50%;"></div>
                <div>
                    <div class="u-name">Lestari Ananta</div>
                    <div class="u-email" style="color: var(--pink);">Active Panitia</div>
                </div>
            </div>
            <div class="ip-details">
                <div class="ip-row"><span>Last Login</span><span>2 Mins ago</span></div>
                <div class="ip-row"><span>Auth Level</span><span>Tier 2 Manager</span></div>
            </div>
            <div>
                <div class="progress-bg"><div class="progress-bar"></div></div>
                <div style="text-align: right; font-size: 9px; color: var(--text-muted);">Quota Usage: 85%</div>
            </div>
        </div>
    </div>
</body>
</html>