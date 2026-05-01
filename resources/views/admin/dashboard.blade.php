<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        :root {
            --bg-base: #050505; --bg-main: #121214; --bg-card: #1c1c21;
            --border: #27272a; --text-main: #ffffff; --text-muted: #9ca3af;
            --purple: #a855f7; --pink: #ec4899;
            --gradient: linear-gradient(to right, var(--purple), var(--pink));
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; background-color: var(--bg-base); color: var(--text-main); overflow: hidden; }
        
        /* Layout */
        .sidebar { width: 260px; padding: 30px 20px; border-right: 1px solid var(--border); display: flex; flex-direction: column; }
        .main-content { flex: 1; padding: 40px; background-color: var(--bg-main); overflow-y: auto; }
        
        /* Sidebar Styles */
        .logo { font-size: 20px; font-weight: bold; color: var(--pink); letter-spacing: 1px; margin-bottom: 40px; }
        .logo span { color: var(--text-main); }
        .user-title { color: var(--purple); font-weight: bold; font-size: 14px; }
        .user-subtitle { color: var(--text-muted); font-size: 11px; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px;}
        .nav-menu { list-style: none; display: flex; flex-direction: column; gap: 15px; }
        .nav-item { color: var(--text-muted); font-size: 14px; cursor: pointer; padding: 10px; border-radius: 8px; transition: 0.3s; }
        .nav-item.active { background-color: rgba(255,255,255,0.05); color: var(--purple); border-left: 3px solid var(--purple); border-radius: 0 8px 8px 0; }
        
        /* Header */
        .header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; }
        .title h1 { font-size: 32px; margin-bottom: 5px; }
        .title p { color: var(--text-muted); font-size: 14px; }
        .btn-group { display: flex; gap: 15px; }
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: bold; cursor: pointer; border: none; color: white; }
        .btn-dark { background-color: var(--bg-card); border: 1px solid var(--border); }
        .btn-gradient { background: var(--gradient); box-shadow: 0 0 15px rgba(168,85,247,0.4); }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: var(--bg-card); border: 1px solid var(--border); padding: 20px; border-radius: 12px; }
        .stat-title { font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; font-weight: bold; }
        .stat-value { font-size: 28px; font-weight: bold; margin-bottom: 5px; }
        .stat-desc { font-size: 12px; color: var(--purple); }

        /* Main Grid */
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
        
        /* Cards */
        .card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 20px; margin-bottom: 20px;}
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .card-title { font-size: 18px; font-weight: bold; }
        .link { color: var(--purple); font-size: 12px; text-decoration: none; }
        
        /* List Items */
        .list-item { display: flex; justify-content: space-between; align-items: center; padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; background: #333; }
        .name { font-size: 14px; font-weight: bold; }
        .meta { font-size: 11px; color: var(--text-muted); }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; letter-spacing: 1px;}
        .badge-verified { border: 1px solid var(--border); color: var(--text-muted); }
        .badge-pending { border: 1px solid rgba(236,72,153,0.3); color: var(--pink); background: rgba(236,72,153,0.1); }
        
        /* Banner */
        .banner { background: linear-gradient(135deg, #2a0845 0%, #6441A5 100%); padding: 30px; border-radius: 12px; position: relative; overflow: hidden; }
        .banner h2 { color: #d8b4fe; margin-bottom: 10px; }
        .banner p { color: #e9d5ff; font-size: 13px; max-width: 70%; margin-bottom: 20px; }
        .btn-outline { background: transparent; border: 1px solid #d8b4fe; color: #d8b4fe; padding: 8px 16px; border-radius: 20px; cursor: pointer; }

        /* Chart/Insights */
        .chart-bar { width: 100%; height: 4px; background: var(--bg-base); border-radius: 2px; margin-top: 15px; }
        .chart-fill { width: 70%; height: 100%; background: var(--purple); border-radius: 2px; }
        
        /* Feed */
        .feed-item { margin-bottom: 15px; padding-left: 15px; border-left: 2px solid var(--border); position: relative; }
        .feed-item::before { content: ''; position: absolute; left: -5px; top: 0; width: 8px; height: 8px; border-radius: 50%; background: var(--purple); }
        .feed-item.error::before { background: var(--pink); }
        .feed-text { font-size: 12px; color: #ddd; }
        .feed-time { font-size: 10px; color: var(--text-muted); margin-top: 5px; }
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
            <div class="title">
                <h1>System Overview</h1>
                <p>Welcome back, Curator. Here is your nocturnal report.</p>
            </div>
            <div class="btn-group">
                <button class="btn btn-dark">Download Report</button>
                <button class="btn btn-gradient">+ New Operation</button>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Users</div>
                <div class="stat-value">14,282</div>
                <div class="stat-desc">↗ +12.5% vs last month</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Active Events</div>
                <div class="stat-value">84</div>
                <div class="stat-desc" style="color:var(--text-muted)">📅 12 starting today</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Pending Payments</div>
                <div class="stat-value">$12,450</div>
                <div class="stat-desc" style="color:var(--pink)">🕒 Avg. 4.2 days overdue</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #1c1c21 0%, #2a1b3d 100%);">
                <div class="stat-title">System Health</div>
                <div class="stat-value">Optimal</div>
                <div class="stat-desc" style="color:var(--text-muted)">✓ All nodes functional</div>
            </div>
        </div>

        <div class="content-grid">
            <div class="col-left">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Recent Registrations</div>
                        <a href="#" class="link">View All</a>
                    </div>
                    <div class="list-item">
                        <div class="user-info">
                            <div class="avatar"></div>
                            <div>
                                <div class="name">Julianna Velez</div>
                                <div class="meta">M.S. Cybernetics • 2 mins ago</div>
                            </div>
                        </div>
                        <div class="badge badge-verified">VERIFIED</div>
                    </div>
                    <div class="list-item">
                        <div class="user-info">
                            <div class="avatar"></div>
                            <div>
                                <div class="name">Marcus Sterling</div>
                                <div class="meta">B.A. Digital Arts • 14 mins ago</div>
                            </div>
                        </div>
                        <div class="badge badge-pending">PENDING</div>
                    </div>
                    <div class="list-item" style="border:none;">
                        <div class="user-info">
                            <div class="avatar"></div>
                            <div>
                                <div class="name">Elena Kostic</div>
                                <div class="meta">Ph.D Quantum Physics • 1 hour ago</div>
                            </div>
                        </div>
                        <div class="badge badge-verified">VERIFIED</div>
                    </div>
                </div>

                <div class="banner">
                    <h2>Automated Archiving</h2>
                    <p>The nocturnal curator is scheduled to archive logs in 4 hours. Ensure all manual overrides are resolved.</p>
                    <button class="btn-outline">Review Schedule</button>
                </div>
            </div>

            <div class="col-right">
                <div class="card">
                    <div class="card-header" style="margin-bottom: 5px;">
                        <div class="card-title">System Insights</div>
                    </div>
                    <div style="text-align: right; font-size: 9px; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 15px;">REAL-TIME</div>
                    <div class="name" style="font-size: 16px; margin-bottom: 5px;">Peak Activity Predicted</div>
                    <div class="meta" style="line-height: 1.4;">Engagement is expected to spike between 20:00 and 22:00 for the 'Midnight Hackathon'.</div>
                    <div class="chart-bar"><div class="chart-fill"></div></div>
                </div>

                <div class="card" style="background: var(--bg-base);">
                    <div class="stat-title" style="margin-bottom: 20px;">Live System Feed</div>
                    <div class="feed-item">
                        <div class="feed-text">API Endpoint 'v2/events' successfully scaled</div>
                        <div class="feed-time">4s ago</div>
                    </div>
                    <div class="feed-item error">
                        <div class="feed-text">Failed login attempt - IP: 192.168.1.45</div>
                        <div class="feed-time">12m ago</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>