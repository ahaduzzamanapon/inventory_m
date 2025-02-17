<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4 rounded" style="max-width: 600px; width: 100%;">
        <div class="text-center">
            <!-- Profile Image -->
            <img src="{{ asset($users->image) }}" class="rounded-circle img-fluid border"
                 style="width: 120px; height: 120px; border: 3px solid #3819e7;" alt="User Image">
            <h3 class="mt-3">{{ $users->name }} {{ $users->last_name }}</h3>
            <p class="text-muted">{{ $users->email }}</p>
        </div>

        <hr>

        <!-- Profile Details -->
        <div class="px-3">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-id-badge text-primary me-2"></i>
                <span><strong>Employee ID:</strong> {{ $users->emp_id }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-birthday-cake text-danger me-2"></i>
                <span><strong>Birth Date:</strong> {{ $users->date_of_birth }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-calendar-check text-success me-2"></i>
                <span><strong>Joining Date:</strong> {{ $users->date_of_join }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-venus-mars text-info me-2"></i>
                <span><strong>Gender:</strong> {{ ucfirst($users->gender) }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-map-marker-alt text-warning me-2"></i>
                <span><strong>Address:</strong> {{ $users->address }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-phone text-secondary me-2"></i>
                <span><strong>Phone:</strong> {{ $users->phone_number }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-hand-holding-usd text-success me-2"></i>
                <span><strong>Salary:</strong> {{ number_format($users->salary, 2) }} BDT</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-id-card text-dark me-2"></i>
                <span><strong>NID:</strong> {{ $users->nid }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-tint text-danger me-2"></i>
                <span><strong>Blood Group:</strong> {{ $users->blood_group }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-graduation-cap text-primary me-2"></i>
                <span><strong>Education:</strong> {{ $users->education }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-user-check text-success me-2"></i>
                <span><strong>Marital Status:</strong> {{ ucfirst($users->marital_status) }}</span>
            </div>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-briefcase text-info me-2"></i>
                <span><strong>Experience:</strong> {{ $users->experience }} years</span>
            </div>
        </div>

        <!-- Buttons -->
        <div class="text-center mt-3">
            <a href="{{ route('users.edit', $users->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
            {{-- <button type="button" class="btn btn-secondary" onclick="printDiv()"><i class="fas fa-print"></i> Print</button> --}}
        </div>
    </div>
</div>
<script>
    function printDiv() {
        var divToPrint = document.getElementById('profile');
        var newWin = window.open('');
        newWin.document.write(divToPrint.outerHTML);
        newWin.document.close();
        newWin.print();
        newWin.close();
    }
</script>
