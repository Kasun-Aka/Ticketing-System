<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Management Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
    <div class="container bg-white p-4 rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Admin Management Dashboard</h2>
            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
            </form>
        </div>
        <p class="text-muted">Overview of all customer tickets across system levels</p>
        <hr>
        
        <table class="table table-striped border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Subject</th>
                    <th>Type</th>
                    <th>SLA Target</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="adminTicketTable">

            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', fetchAdminTickets);

        async function fetchAdminTickets() {
            try {
                const response = await fetch('/api/tickets', {
                    headers: { 'Accept': 'application/json' }
                });
                if (response.ok) {
                    const tickets = await response.json();
                    const tbody = document.getElementById('adminTicketTable');
                    tbody.innerHTML = '';
                    tickets.forEach(ticket => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${ticket.id}</td>
                            <td>${ticket.user ? ticket.user.name : 'Unknown'}</td>
                            <td>${ticket.subject}</td>
                            <td>${ticket.type}</td>
                            <td>${ticket.sla_hours} Hours</td>
                            <td>${ticket.status}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                }
            } catch (error) {
                console.error('Failed to fetch tickets:', error);
            }
        }
    </script>
</body>
</html>