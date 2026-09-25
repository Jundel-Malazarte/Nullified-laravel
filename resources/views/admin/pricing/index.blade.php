<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Pricing | Admin - Nullified Solutions</title>
    <link rel="icon" href="{{ asset('images/Nullified_Logo.png') }}" type="image/png" />
    <style>
        :root {
            --bg: #07111f;
            --card: #101c2d;
            --card-2: #15263d;
            --text: #edf3ff;
            --muted: #a9b7d1;
            --primary: #4f7cff;
            --danger: #ff5a5a;
            --success: #22c55e;
            --border: rgba(255, 255, 255, 0.08);
            --shadow: 0 18px 40px rgba(4, 9, 18, 0.42);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #06111d 0%, #0d1b2a 100%);
            color: var(--text);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        table { border-collapse: collapse; width: 100%; }
        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            vertical-align: middle;
        }
        th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .admin-shell { max-width: 1480px; margin: 0 auto; padding: 24px 16px 48px; }
        .topbar {
            display: flex; justify-content: space-between; align-items: center;
            gap: 16px; background: rgba(13, 25, 40, 0.9);
            border: 1px solid var(--border); border-radius: 18px;
            padding: 18px 22px; box-shadow: var(--shadow); margin-bottom: 24px;
        }
        .brand-wrap { display: flex; align-items: center; gap: 14px; }
        .brand-icon {
            width: 42px; height: 42px; border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            display: grid; place-items: center; font-weight: 700;
        }
        .brand-wrap h1 { margin: 0; font-size: 1.2rem; }
        .logout-btn {
            display: inline-block; padding: 10px 14px; border-radius: 10px;
            background: rgba(255, 90, 90, 0.12); color: #ffd7d7;
            border: 1px solid rgba(255, 90, 90, 0.25); cursor: pointer;
        }
        .nav { display: flex; flex-wrap: wrap; gap: 10px; margin: 20px 0 26px; }
        .nav a {
            padding: 10px 15px; border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border); color: var(--muted);
            transition: 0.2s ease;
        }
        .nav a.active, .nav a:hover {
            color: var(--text); background: rgba(255, 255, 255, 0.06);
            border-color: rgba(79, 124, 255, 0.4);
        }
        .panel {
            background: rgba(16, 28, 45, 0.96); border: 1px solid var(--border);
            border-radius: 18px; padding: 18px; margin-bottom: 22px;
            box-shadow: var(--shadow);
        }
        input, select {
            background: rgba(255, 255, 255, 0.04); color: var(--text);
            border: 1px solid var(--border); border-radius: 6px;
            padding: 6px 10px; font-family: inherit;
        }
        .btn-small {
            padding: 6px 12px; font-size: 12px; border-radius: 6px;
            border: 0; background: var(--primary); color: white;
            cursor: pointer; font-weight: 600;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="admin-shell">
        <div class="topbar">
            <div class="brand-wrap">
                <div class="brand-icon">N</div>
                <h1>Repair Pricing</h1>
            </div>
            <div class="topbar-actions">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Log out</button>
                </form>
            </div>
        </div>

        <nav class="nav">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.bookings.index') }}">All Bookings</a>
            <a href="{{ route('admin.users.index') }}">Manage Users</a>
            <a href="{{ route('admin.pricing.index') }}" class="active">Pricing</a>
        </nav>

        <div class="panel">
            <h2>Services & Pricing List</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Service Name</th>
                            <th>Current Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->category }}</td>
                                <td><strong>{{ $service->service_name }}</strong></td>
                                <td>{{ $service->price_range }}</td>
                                <td><span style="color: var(--success);">Active</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: var(--muted); padding: 24px;">No services listed</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
