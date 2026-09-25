<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | Nullified Solutions</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <link rel="icon" href="{{ asset('images/Nullified_Logo.png') }}" type="image/png" style="border-radius: 50%;" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="dash-body">
    <div class="dash-layout">
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <aside class="sidebar" id="sidebar">
            <a class="sidebar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/Nullified_Logo.png') }}" alt="Nullified Solutions" />
                <span>Nullified Solutions</span>
            </a>

            <p class="sidebar-label">MENU</p>
            <nav class="sidebar-nav" id="sidebarNav">
                <a href="#overview" class="active" data-target="overview"><span class="ic">🏠</span> Dashboard</a>
                <a href="#book" data-target="book"><span class="ic">🗓️</span> Book a Repair</a>
                <a href="#bookings" data-target="bookings"><span class="ic">🧾</span> My Bookings</a>
                <a href="#pricing" data-target="pricing"><span class="ic">💵</span> Repair Pricing</a>
                <a href="#settings" data-target="settings"><span class="ic">⚙️</span> Account Settings</a>
            </nav>

            <div class="sidebar-foot">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-logout">
                        <span class="ic">↩️</span> Log out
                    </button>
                </form>
            </div>
        </aside>

        <div class="dash-main">
            <header class="dash-topbar">
                <div class="dash-topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">☰</button>
                    <div class="dash-topbar-title">
                        <p>Welcome back!</p>
                        <h1 id="pageTitle">Dashboard</h1>
                    </div>
                </div>

                <div class="dash-user">
                    <div class="dash-user-info">
                        <span class="dash-user-name" id="userName">{{ $user->full_name }}</span>
                        <span class="dash-user-email" id="userEmail">{{ $user->email }}</span>
                    </div>
                    <div class="dash-avatar" id="userAvatar">{{ strtoupper(substr($user->full_name, 0, 1)) }}</div>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="dash-logout">Log out</button>
                    </form>
                </div>
            </header>

            <main class="dash-content">
                <section class="dash-section active" id="overview">
                    <div class="dash-section-head">
                        <h2>Your overview</h2>
                        <p>Here's what's happening with your repairs and account today.</p>
                    </div>

                    @if(session('success'))
                        <div class="form-message success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="form-message error">{{ session('error') }}</div>
                    @endif

                    <div class="stat-grid">
                        <div class="stat-card">
                            <p class="stat-label">Active Bookings</p>
                            <p class="stat-value">{{ $stats['active_bookings'] ?? 0 }}</p>
                            <p class="stat-sub">Currently in progress</p>
                        </div>
                        <div class="stat-card">
                            <p class="stat-label">Completed Repairs</p>
                            <p class="stat-value">{{ $stats['completed_bookings'] ?? 0 }}</p>
                            <p class="stat-sub">All time</p>
                        </div>
                        <div class="stat-card">
                            <p class="stat-label">Premium Status</p>
                            <p class="stat-value">{{ $user->is_premium ? 'Active' : 'None' }}</p>
                            <p class="stat-sub">{{ $user->is_premium ? 'Premium member' : 'Standard account' }}</p>
                        </div>
                        <div class="stat-card">
                            <p class="stat-label">Next Appointment</p>
                            <p class="stat-value" style="font-size: 18px;">{{ $stats['next_date'] ?? 'TBD' }}</p>
                            <p class="stat-sub">{{ $stats['next_service'] ?? 'No booking' }}</p>
                        </div>
                    </div>

                    <div class="quick-actions">
                        <button type="button" data-target="book" class="nav-jump">Book a repair</button>
                        <button type="button" class="ghost nav-jump" data-target="bookings">View my bookings</button>
                        <button type="button" class="ghost nav-jump" data-target="pricing">See pricing</button>
                    </div>

                    <div class="dash-panel">
                        <h3>Recent activity</h3>
                        <p>Your latest bookings and orders.</p>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Device</th>
                                        <th>Service</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentBookings->take(5) as $booking)
                                        <tr>
                                            <td>#{{ $booking->id }}</td>
                                            <td>{{ $booking->device_name }}</td>
                                            <td>{{ $booking->service->service_name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M j, Y') }}</td>
                                            <td><span class="status-badge status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center; padding: 24px;">No bookings yet. Book your first repair to get started!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="dash-section" id="book">
                    <div class="dash-section-head">
                        <h2>Book a repair</h2>
                        <p>Tell us about your device and we'll confirm a time that works for you.</p>
                    </div>

                    <div class="dash-panel">
                        <form class="booking-form" method="POST" action="{{ route('bookings.store') }}">
                            @csrf

                            <label>Device type
                                <select name="device_name" required>
                                    <option value="">Select device</option>
                                    <option value="Laptop">Laptop / Computer</option>
                                    <option value="Phone">Mobile Phone</option>
                                    <option value="Tablet">Tablet</option>
                                </select>
                            </label>

                            <label>Brand
                                <input type="text" name="device_brand" placeholder="e.g. Dell, Samsung" required />
                            </label>

                            <label>Model
                                <input type="text" name="device_model" placeholder="e.g. XPS 13, Galaxy A52" required />
                            </label>

                            <label>Issue type
                                <select name="service_id" required>
                                    <option value="">Select issue</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <label>Preferred date
                                <input type="date" name="preferred_date" min="{{ date('Y-m-d') }}" required />
                            </label>

                            <label>Preferred time
                                <input type="time" name="preferred_time" required />
                            </label>

                            <label class="full">Describe the problem
                                <textarea name="issue_description" rows="4" placeholder="What's happening with your device?" required></textarea>
                            </label>

                            <div class="form-actions">
                                <button type="submit">Confirm booking <span aria-hidden="true">↗</span></button>
                            </div>
                        </form>
                    </div>
                </section>

                <section class="dash-section" id="bookings">
                    <div class="dash-section-head">
                        <h2>My bookings</h2>
                        <p>Track the status of every repair you've booked with us.</p>
                    </div>

                    <div class="dash-panel">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Device</th>
                                        <th>Issue</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentBookings as $booking)
                                        <tr>
                                            <td>#{{ $booking->id }}</td>
                                            <td>{{ $booking->device_name }} ({{ $booking->device_brand }})</td>
                                            <td>{{ $booking->issue_description ? Str::limit($booking->issue_description, 40) : 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M j, Y') }}</td>
                                            <td><span class="status-badge status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center; padding: 24px;">No bookings yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="dash-section" id="pricing">
                    <div class="dash-section-head">
                        <h2>Repair pricing</h2>
                        <p>View our standard repair pricing for common services.</p>
                    </div>

                    <div class="pricing-grid">
                        @foreach($services->groupBy('category') as $category => $categoryServices)
                            <div class="price-card">
                                <h3>{{ $category }}</h3>
                                <ul>
                                    @foreach($categoryServices as $service)
                                        <li>
                                            <span>{{ $service->service_name }}</span>
                                            <strong>{{ $service->price_range }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="dash-section" id="settings">
                    <div class="dash-section-head">
                        <h2>Account settings</h2>
                        <p>Keep your contact details up to date so we can reach you about your repairs.</p>
                    </div>

                    <div class="dash-panel" style="max-width: 640px;">
                        <div class="avatar-lg">{{ strtoupper(substr($user->full_name, 0, 2)) }}</div>
                        <form class="booking-form" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <label>Full name
                                <input type="text" name="full_name" value="{{ $user->full_name }}" required />
                            </label>

                            <label>Email address
                                <input type="email" value="{{ $user->email }}" disabled />
                                <small style="color: var(--muted); font-size: 12px;">Email cannot be changed</small>
                            </label>

                            <label>Phone number
                                <input type="tel" name="phone" value="{{ $user->phone ?? '' }}" placeholder="09xx xxx xxxx" />
                            </label>

                            <label>New password
                                <input type="password" name="password" placeholder="Leave blank to keep current password" />
                            </label>

                            <label>Confirm password
                                <input type="password" name="password_confirmation" placeholder="Confirm new password" />
                            </label>

                            <div class="form-actions">
                                <button type="submit">Save changes</button>
                            </div>
                        </form>
                    </div>
                </section>
            </main>

            <footer><p>© 2026 Nullified Solutions</p></footer>
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
