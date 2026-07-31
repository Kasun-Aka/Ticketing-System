<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Ticket Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
    <div class="container bg-white p-4 rounded shadow-sm">
        <h2>Customer Portal</h2>
        <div class="d-flex justify-content-between align-items-center">
            @auth
            <p class="mb-0">Logged in as: <strong id="userRole">{{ auth()->user()->role }}</strong></p>
            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
            </form>
            @else
            <p class="mb-0">Status: <strong class="text-warning">Guest (Not Logged In)</strong></p>
            @endauth
        </div>

    <hr>

        <h4>Create New Support Ticket</h4>
        <form id="ticketForm" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" id="subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea id="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
            <label class="form-label">Ticket Priority Level</label>
            <select id="type" class="form-select">
                <option value="standard">Standard Ticket (24-Hour SLA)</option>
                
                {{-- Safe check using optional chaining --}}
                @if(auth()->user()?->role === 'premium_customer' || auth()->user()?->role === 'admin')
                    <option value="priority">Priority Ticket (4-Hour SLA)</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit Ticket</button>
        </form>

        <h4>My Support Tickets</h4>
        <ul id="ticketList" class="list-group"></ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchTickets();

            document.getElementById('ticketForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const data = {
                    subject: document.getElementById('subject').value,
                    description: document.getElementById('description').value,
                    type: document.getElementById('type').value
                };

                try {
                    const response = await fetch('/api/tickets', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        alert('Ticket created successfully!');
                        document.getElementById('ticketForm').reset();
                        fetchTickets();
                    } else {
                        const err = await response.json();
                        alert('Error: ' + (err.error || err.message));
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        async function fetchTickets() {
            try {
                const response = await fetch('/api/tickets', {
                    headers: { 'Accept': 'application/json' }
                });
                if (response.ok) {
                    const tickets = await response.json();
                    const list = document.getElementById('ticketList');
                    list.innerHTML = '';
                    tickets.forEach(ticket => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item';
                        li.innerHTML = `<strong>${ticket.subject}</strong> (${ticket.type}) - ${ticket.status} <br> <small>${ticket.description}</small>`;
                        list.appendChild(li);
                    });
                }
            } catch (error) {
                console.error('Failed to fetch tickets:', error);
            }
        }
    </script>
</body>
</html>