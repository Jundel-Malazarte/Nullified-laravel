<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking #{{ $booking->id }} | Admin - Nullified Solutions</title>
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
        .admin-shell { max-width: 900px; margin: 0 auto; padding: 24px 16px 48px; }
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
        .panel {
            background: rgba(16, 28, 45, 0.96); border: 1px solid var(--border);
            border-radius: 18px; padding: 24px; margin-bottom: 22px;
            box-shadow: var(--shadow);
        }
        .detail-row {
            display: flex; justify-content: space-between; padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }
        .detail-label { color: var(--muted); font-size: 14px; }
        .detail-val { font-weight: 600; }
        .form-group { margin-top: 16px; }
        label { display: block; margin-bottom: 6px; font-size: 13px; color: var(--muted); }
        select, textarea, input {
            width: 100%; background: rgba(255, 255, 255, 0.04);
            color: var(--text); border: 1px solid var(--border);
            border-radius: 8px; padding: 10px 12px; font-family: inherit;
        }
        button.btn-primary {
            background: linear-gradient(135deg, var(--primary), #6d5efc);
            color: white; border: 0; padding: 12px 20px; border-radius: 10px;
            font-weight: 600; cursor: pointer; margin-top: 16px;
        }
        .back-link { display: inline-block; margin-bottom: 16px; color: var(--primary); }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="admin-shell">
        <a href="{{ route('admin.bookings.index') }}" class="back-link">← Back to All Bookings</a>

        <div class="panel">
            <h2>Booking #{{ $booking->id }}</h2>
            <div class="detail-row">
                <span class="detail-label">Customer Name</span>
                <span class="detail-val">{{ $booking->user->full_name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Customer Email</span>
                <span class="detail-val">{{ $booking->user->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Customer Phone</span>
                <span class="detail-val">{{ $booking->user->phone ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Device</span>
                <span class="detail-val">{{ $booking->device_name }} ({{ $booking->device_brand }} {{ $booking->device_model }})</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Service</span>
                <span class="detail-val">{{ $booking->service->service_name ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Preferred Date & Time</span>
                <span class="detail-val">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('F j, Y') }} {{ $booking->preferred_time ? 'at '.$booking->preferred_time : '' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Issue Description</span>
                <span class="detail-val">{{ $booking->issue_description }}</span>
            </div>

            <form method="POST" action="{{ route('admin.bookings.update-status', $booking->id) }}" style="margin-top: 24px;">
                @csrf
                @method('PATCH')

                <h3>Update Booking Status</h3>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="in_progress" {{ $booking->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Priority</label>
                    <select name="priority">
                        <option value="low" {{ $booking->priority === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="normal" {{ $booking->priority === 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="high" {{ $booking->priority === 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="admin_notes" rows="4">{{ $booking->admin_notes }}</textarea>
                </div>

                <button type="submit" class="btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
