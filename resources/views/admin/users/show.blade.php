<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User: {{ $user->full_name }} | Admin - Nullified Solutions</title>
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
        <a href="{{ route('admin.users.index') }}" class="back-link">← Back to Manage Users</a>

        <div class="panel">
            <h2>User Details: {{ $user->full_name }}</h2>
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-val">{{ $user->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Phone</span>
                <span class="detail-val">{{ $user->phone ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Joined</span>
                <span class="detail-val">{{ $user->created_at->format('F j, Y') }}</span>
            </div>

            <form method="POST" action="{{ route('admin.users.update-status', $user->id) }}" style="margin-top: 24px;">
                @csrf
                @method('PATCH')

                <h3>Update User Status & Role</h3>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" required>
                        <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="technician" {{ $user->role === 'technician' ? 'selected' : '' }}>Technician</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ $user->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Premium Account Status</label>
                    <select name="is_premium" required>
                        <option value="0" {{ !$user->is_premium ? 'selected' : '' }}>Standard (No Premium)</option>
                        <option value="1" {{ $user->is_premium ? 'selected' : '' }}>Active Premium Member</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Save User Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
