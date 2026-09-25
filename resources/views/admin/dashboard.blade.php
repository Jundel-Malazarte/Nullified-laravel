<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Nullified Solutions</title>
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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #06111d 0%, #0d1b2a 100%);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            vertical-align: top;
        }

        th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .admin-shell {
            max-width: 1480px;
            margin: 0 auto;
            padding: 24px 16px 48px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            background: rgba(13, 25, 40, 0.9);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px 22px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            display: grid;
            place-items: center;
            font-weight: 700;
        }

        .brand-wrap h1 {
            margin: 0;
            font-size: 1.2rem;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tag {
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(79, 124, 255, 0.12);
            border: 1px solid rgba(79, 124, 255, 0.18);
            color: #dfe9ff;
            font-size: 12px;
        }

        .logout-btn {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            background: rgba(255, 90, 90, 0.12);
            color: #ffd7d7;
            border: 1px solid rgba(255, 90, 90, 0.25);
            cursor: pointer;
        }

        .logout-btn:hover {
            background: rgba(255, 90, 90, 0.18);
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0 26px;
        }

        .nav a {
            padding: 10px 15px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            color: var(--muted);
            transition: 0.2s ease;
        }

        .nav a:hover {
            color: var(--text);
            background: rgba(255, 255, 255, 0.06);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: linear-gradient(180deg, var(--card) 0%, #122338 100%);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
            box-shadow: var(--shadow);
        }

        .stat-label {
            color: var(--muted);
            display: block;
            font-size: 12px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .panel {
            background: rgba(16, 28, 45, 0.96);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
            margin-bottom: 22px;
            box-shadow: var(--shadow);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 1.35rem;
        }

        .panel-header p {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.12);
            color: #ffd54f;
            border: 1px solid rgba(255, 193, 7, 0.25);
        }

        .status-in-progress {
            background: rgba(79, 124, 255, 0.12);
            color: #adc8ff;
            border: 1px solid rgba(79, 124, 255, 0.25);
        }

        .status-completed {
            background: rgba(34, 197, 94, 0.12);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.25);
        }

        .table-actions {
            display: flex;
            gap: 8px;
        }

        .btn-small {
            padding: 6px 10px;
            font-size: 11px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.03);
            color: var(--text);
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-small:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        @media (max-width: 768px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 8px 6px;
            }
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="admin-shell">
        <div class="topbar">
            <div class="brand-wrap">
                <div class="brand-icon">N</div>
                <h1>Admin Dashboard</h1>
            </div>
            <div class="topbar-actions">
                <span class="tag">Administrator</span>
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
            <a href="{{ route('admin.pricing.index') }}">Pricing</a>
        </nav>

        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-label">Total Users</span>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-label">Total Bookings</span>
                <div class="stat-value">{{ $stats['total_bookings'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-label">Pending Bookings</span>
                <div class="stat-value">{{ $stats['pending_bookings'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-label">In Progress</span>
                <div class="stat-value">{{ $stats['in_progress'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-label">Completed</span>
                <div class="stat-value">{{ $stats['completed'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-label">Unread Messages</span>
                <div class="stat-value">{{ $stats['unread_messages'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-label">Premium Members</span>
                <div class="stat-value">{{ $stats['premium_members'] }}</div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2>Recent Bookings</h2>
                    <p>Latest repair requests submitted by customers</p>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Device</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->user->full_name }}</td>
                                <td>{{ $booking->device_name }}</td>
                                <td>{{ $booking->service->service_name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M j, Y') }}</td>
                                <td>
                                    @if($booking->status === 'pending')
                                        <span class="status-badge status-pending">Pending</span>
                                    @elseif($booking->status === 'in_progress')
                                        <span class="status-badge status-in-progress">In Progress</span>
                                    @elseif($booking->status === 'completed')
                                        <span class="status-badge status-completed">Completed</span>
                                    @else
                                        <span class="status-badge">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn-small">View</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--muted);">No bookings yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2>Recent Messages</h2>
                    <p>Latest contact form submissions from visitors</p>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentMessages as $message)
                            <tr>
                                <td>#{{ $message->id }}</td>
                                <td>{{ $message->full_name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ Str::limit($message->message, 50) }}</td>
                                <td>{{ $message->created_at->format('M j, Y') }}</td>
                                <td>
                                    @if($message->is_read)
                                        <span class="status-badge status-completed">Read</span>
                                    @else
                                        <span class="status-badge status-pending">Unread</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--muted);">No messages yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
